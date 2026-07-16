<?php
session_start();
include('../DB_Config/Config.php');


if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit;
}

$db = new dbconfig();
$conn = $db->getConnection();
$emp_id     = $_SESSION['emp_id'] ?? '';
$emp_name   = $_SESSION['emp_name'] ?? '';
$access_key = $_SESSION['access_key'] ?? '';

$ref = $_GET['ref'] ?? '';

$assignments = [];
if ($ref !== '') {
  $sql = "SELECT trans_id, emp_name, assign_date 
          FROM xxits_ams_asset_trans_hist_t 
          WHERE asset_ref_no = ? AND return_date = '0000-00-00'";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $ref);
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
    $assignments[] = $row;
  }

  $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Asset Edit</title>
<link rel="stylesheet" href="../CSS/Style_AssetAssign.php">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  <h2>       </h2>
  <div><img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" /></div>
</div>

<div class="content">
  <div style="text-align: center; margin-top: 20px;">
      <div class="page-title">Asset List</div>
    </div>
  <div class="form-card">
    <form method="post" action="../Main/Update_Asset_Return.php">

      <div class="form-group">
        <label>Asset Ref No <span class="required">*</span></label>
        <input type="text" name="asset_ref_no" value="<?php echo htmlspecialchars($ref); ?>" readonly>
      </div>

      <div class="form-group">
        <label>Select Employee to Return <span class="required">*</span></label>
        <select name="trans_id" required>
          <?php foreach ($assignments as $assign): ?>
            <option value="<?php echo $assign['trans_id']; ?>">
              <?php echo htmlspecialchars($assign['emp_name']) . " (Assigned: " . date('d-M-Y', strtotime($assign['assign_date'])) . ")"; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Date of Return <span class="required">*</span></label>
        <input type="text" name="return_date" value="<?php echo date('d-M-Y'); ?>" readonly>
      </div>

      <div class="button-group">
        <button type="button" class="btn" onclick="history.back()">Back</button>
        <button type="submit" class="btn">Submit</button>
      </div>

    </form>
  </div>
</div>

</body>
</html>
