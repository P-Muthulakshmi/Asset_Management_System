<?php
session_start();

if (!isset($_SESSION['emp_id'])) {
    header("Location: Login.php");
    exit;
}

include('../DB_Config/Config.php');

$db = new dbconfig();
$conn = $db->getConnection();

$emp_name   = $_SESSION['emp_name'];
$access_key = $_SESSION['access_key'];

$sql = "
SELECT t.asset_ref_no, d.asset_name, d.serial_number, d.category, t.assign_date, t.return_date 
FROM xxits_ams_asset_trans_hist_t t
JOIN xxits_ams_asset_det_t d 
  ON t.asset_ref_no = d.asset_ref_no
WHERE t.emp_name = ?
ORDER BY t.assign_date DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $emp_name);
$stmt->execute();
$result = $stmt->get_result();

$assets = [];
while ($row = $result->fetch_assoc()) {
    $assets[] = $row;
}

$stmt->close();
$conn->close();
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Assets</title>
<link rel="stylesheet" href="../CSS/Style_My_Assets.php">
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
    <h2>             </h2>
    <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" />
</div>

<div class="content">
    <div style="text-align: center; margin-top: 20px;">
      <div class="page-title">My Assets</div>
    </div>
    <h3>Hello, <?php echo htmlspecialchars($emp_name); ?>! Here are your assigned and returned assets:</h3>

    <?php if (count($assets) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Asset Ref No</th>
                <th>Asset Name</th>
                <th>Serial Number</th>
                <th>Category</th>
                <th>Assigned On</th>
                <th>Returned On</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($assets as $asset): ?>
            <tr>
                <td><?php echo htmlspecialchars($asset['asset_ref_no']); ?></td>
                <td><?php echo htmlspecialchars($asset['asset_name']); ?></td>
                <td><?php echo htmlspecialchars($asset['serial_number']); ?></td>
                <td><?php echo htmlspecialchars($asset['category']); ?></td>
                <td><?php echo date('d-M-Y', strtotime($asset['assign_date'])); ?></td>
                <td>
                    <?php
                    $returnDate = $asset['return_date'];
                    echo (!empty($returnDate) && $returnDate !== '0000-00-00') 
                        ? date('d-M-Y', strtotime($returnDate)) 
                        : '-';
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p> You have no asset transactions yet. </p>
    <?php endif; ?>
</div>

</body>
</html>