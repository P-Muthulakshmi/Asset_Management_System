<?php
session_start();
include('../DB_Config/Config.php');

if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit;
}

$db = new dbconfig();
$conn = $db->getConnection();

$ref = $_GET['ref'] ?? '';

$emp_id     = $_SESSION['emp_id'] ?? '';
$emp_name   = $_SESSION['emp_name'] ?? '';
$access_key = $_SESSION['access_key'] ?? '';

$assetInfo = [
    'name' => '',
    'serial' => '',
    'type' => '',
    'status' => '',
    'available' => 0,
    'total' => 0
];

$remaining_qty = 0;
$can_lend = false;

if ($ref !== '') {
    
    $sql = "SELECT asset_name, serial_number, category, status FROM xxits_ams_asset_det_t WHERE asset_ref_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ref);
    $stmt->execute();
    $stmt->bind_result($name, $serial, $type, $status);
    if ($stmt->fetch()) {
        $assetInfo['name'] = $name;
        $assetInfo['serial'] = $serial;
        $assetInfo['type'] = $type;
        $assetInfo['status'] = $status;
    }
    $stmt->close();

    
    $qty_sql = "SELECT quantity FROM xxits_ams_purchase_det_t WHERE prod_ref_no = ?";
    $stmt = $conn->prepare($qty_sql);
    $stmt->bind_param("s", $ref);
    $stmt->execute();
    $stmt->bind_result($total_qty);
    $stmt->fetch();
    $stmt->close();

    $assetInfo['total'] = $total_qty ?: 0;

    
    $assigned_sql = "SELECT COUNT(*) FROM xxits_ams_asset_trans_hist_t WHERE asset_ref_no = ? AND action = 'Assigned' AND (return_date IS NULL OR return_date = '0000-00-00')";
    $stmt = $conn->prepare($assigned_sql);
    $stmt->bind_param("s", $ref);
    $stmt->execute();
    $stmt->bind_result($assigned_qty);
    $stmt->fetch();
    $stmt->close();

    $remaining_qty = $assetInfo['total'] - $assigned_qty;
    $assetInfo['available'] = $remaining_qty;

    $can_lend = ($remaining_qty > 0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Transaction History</title>
<link rel="stylesheet" href="../CSS/Style.php">
<style>
button[disabled] {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>
</head>
<body>

<div class="sidebar">
  <p>Welcome, <?php echo htmlspecialchars($emp_name); ?>!</p>
    <?php if ($access_key === 'a' || $access_key === 's'): ?>
        <a href="./Asset_List.php">💼 Asset List</a>
    <?php endif; ?>

    <a href="./Ticket_Details.php">🛠 Ticket Details</a>

    <?php if ($access_key === 'a' || $access_key === 's'): ?>
        <a href="./Purchase_Record.php">🛒 Purchase Record</a>
    <?php endif; ?>

    <a href="./My_Assets.php">📋 My Assets</a>
    <a href="../Main/Logout.php" onclick="return confirm('Are you sure you want to logout?')">🚪 Logout</a>
</div>

<div class="header">
    <h2>   </h2>
    <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" />
</div>

<div class="content" >
    <div style="text-align: center; margin-top: 20px;">
      <div class="page-title">Transaction History</div>
    </div>

    <div class="buttons">
        <button onclick="navigateTo('Asset_List.php')">Back</button>

        <?php if ($can_lend): ?>
            <button onclick="lendAsset()">Lend</button>
        <?php else: ?>
            <button disabled>Lend</button>
        <?php endif; ?>

        <button onclick="returnAsset()">Return</button>
    </div>

    <div class="asset-info">
        <h4>Asset Ref No: <?php echo htmlspecialchars($ref ?? ''); ?></h4>
        <div id="assetInfoBox">
            <p><strong>Asset Name:</strong> <?php echo htmlspecialchars($assetInfo['name'] ?? ''); ?></p>
            <p><strong>Serial Number:</strong> <?php echo htmlspecialchars($assetInfo['serial'] ?? ''); ?></p>
            <p><strong>Asset Type:</strong> <?php echo htmlspecialchars($assetInfo['type'] ?? ''); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($assetInfo['status'] ?? ''); ?></p>
            <p><strong>Available Units:</strong> <?php echo htmlspecialchars((string)$assetInfo['available']); ?></p>
            <p><strong>Total Units:</strong> <?php echo htmlspecialchars((string)$assetInfo['total']); ?></p>
        </div>
    </div>

    <div class="history">
        <h3>History</h3>
        <div id="historyContent">
            <?php
            if ($ref !== '') {
                $hist_sql = "SELECT emp_name, assign_date, return_date, action 
                             FROM xxits_ams_asset_trans_hist_t 
                             WHERE asset_ref_no = ? 
                             ORDER BY trans_id DESC";
                $stmt = $conn->prepare($hist_sql);
                $stmt->bind_param("s", $ref);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<p><strong>Action:</strong> " . htmlspecialchars($row['action'] ?? '') . "</p>";
                        echo "<p><strong>Employee Name:</strong> " . htmlspecialchars($row['emp_name'] ?? '') . "</p>";

                        $assignDate = $row['assign_date'] ?? '';
                        $assignDateFormatted = (!empty($assignDate) && $assignDate !== '0000-00-00') ?
                            date('d-M-Y', strtotime($assignDate)) : '-';
                        echo "<p><strong>Issued On:</strong> " . htmlspecialchars($assignDateFormatted) . "</p>";

                        $returnDate = $row['return_date'] ?? '';
                        $returnDateFormatted = (!empty($returnDate) && $returnDate !== '0000-00-00') ?
                            date('d-M-Y', strtotime($returnDate)) : '-';
                        echo "<p><strong>Returned On:</strong> " . htmlspecialchars($returnDateFormatted) . "</p>";
                        echo "<hr>";
                    }
                } else {
                    echo "<p>No transaction history available.</p>";
                }
                $stmt->close();
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>

<script>
function navigateTo(page) {
    window.location.href = page;
}

function lendAsset() {
    const ref = "<?php echo htmlspecialchars($ref ?? ''); ?>";
    if (!ref) {
        alert("No asset reference found.");
        return;
    }
    window.location.href = `Asset_Assign.php?ref=${ref}`;
}

function returnAsset() {
    const ref = "<?php echo htmlspecialchars($ref ?? ''); ?>";
    if (!ref) {
        alert("No asset reference found.");
        return;
    }
    window.location.href = `Asset_Edit_Page.php?ref=${ref}`;
}
</script>

<?php if (isset($_GET['status'])): ?>
<script>
<?php if ($_GET['status'] === 'success'): ?>
    alert("🎉 Asset successfully assigned!");
<?php elseif ($_GET['status'] === 'returned'): ?>
    alert("🔄 Asset successfully returned!");
<?php endif; ?>
</script>
<?php endif; ?>

</body>
</html>
