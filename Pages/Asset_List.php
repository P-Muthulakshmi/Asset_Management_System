<?php
session_start();
include('../DB_Config/Config.php');

if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit;
}

$access_key = $_SESSION['access_key'] ?? '';

if ($access_key === 'e') {
    
    header("Location: My_Assets.php"); 
    exit;
}
$db = new dbconfig();
$conn = $db->getConnection();

$emp_name = $_SESSION['emp_name'];
$access_key = $_SESSION['access_key'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Asset List</title>
<link rel="stylesheet" href="../CSS/Style_Asset_List.php">
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
    <h2>    </h2>
    <div><img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" /></div>
</div>

<div class="content">
  <div style="text-align: center; margin-top: 20px;">
      <div class="page-title">Asset List</div>
    </div>
<div class="asset-info">
<table border="1" cellpadding="8" cellspacing="0">
<thead>
<tr>
<th>S.No.</th>
<th>Reference No.</th>
<th>Name</th>
<th>Category</th>
<th>Serial Number</th>
<th>Model Details</th>
<th>Warranty</th>
<th>Total Qty</th>
<th>Available Qty</th>
<th>Status</th>

</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM xxits_ams_asset_det_t ORDER BY asset_ref_no ASC";
$result = mysqli_query($conn, $sql);
$i = 1;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ref = $row['asset_ref_no'];
        $status = strtolower($row['status']);
        $statusText = htmlspecialchars($row['status']);
        $assetRef = urlencode($ref);

        if ($status === 'active') {
            $statusColor = 'green';
            $displayText = 'Available';
        } else {
            $statusColor = 'red';
            $displayText = $statusText;
        }

        if ($access_key === 'a' || $access_key === 's') {
            $statusDisplay = "<a href='transaction_history.php?ref={$assetRef}' style='color:{$statusColor}; font-weight:bold; text-decoration:none;'>{$displayText}</a>";
        } else {
            $statusDisplay = "<span style='color:{$statusColor}; font-weight:bold;'>{$displayText}</span>";
        }

       
        $total_qty = 0;
        $available_qty = 0;

        $qty_sql = $conn->prepare("SELECT quantity FROM xxits_ams_purchase_det_t WHERE prod_ref_no = ?");
        $qty_sql->bind_param("s", $ref);
        $qty_sql->execute();
        $qty_sql->bind_result($total_qty);
        $qty_sql->fetch();
        $qty_sql->close();

        if (!$total_qty) $total_qty = 0;

       
        $assigned_qty = 0;

        $assigned_sql = $conn->prepare("SELECT COUNT(*) FROM xxits_ams_asset_trans_hist_t WHERE asset_ref_no = ? AND action = 'Assigned' AND (return_date IS NULL OR return_date = '0000-00-00')");
        $assigned_sql->bind_param("s", $ref);
        $assigned_sql->execute();
        $assigned_sql->bind_result($assigned_qty);
        $assigned_sql->fetch();
        $assigned_sql->close();

        $available_qty = $total_qty - $assigned_qty;

        echo "<tr>
        <td>{$i}</td>
        <td>{$row['asset_ref_no']}</td>
        <td>{$row['asset_name']}</td>
        <td>{$row['category']}</td>
        <td>{$row['serial_number']}</td>
        <td>{$row['model_details']}</td>
        <td>{$row['warranty']}</td>
        <td>{$total_qty}</td>
        <td>{$available_qty}</td>
        <td>{$statusDisplay}</td>
        
        </tr>";

        $i++;
    }
} else {
    echo "<tr><td colspan='10'>No assets found.</td></tr>";
}

mysqli_close($conn);
?>
</tbody>
</table>
</div>
</div>

</body>
</html>
