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
$available = false;
$remaining_qty = 0;

if ($ref !== '') {
    $purchase_sql = "SELECT quantity FROM xxits_ams_purchase_det_t WHERE prod_ref_no = ?";
    $stmt = $conn->prepare($purchase_sql);
    $stmt->bind_param("s", $ref);
    $stmt->execute();
    $stmt->bind_result($total_qty);
    $stmt->fetch();
    $stmt->close();

    $assign_sql = "SELECT COUNT(*) FROM xxits_ams_asset_det_t WHERE asset_ref_no = ?";
    $stmt2 = $conn->prepare($assign_sql);
    $stmt2->bind_param("s", $ref);
    $stmt2->execute();
    $stmt2->bind_result($assigned_qty);
    $stmt2->fetch();
    $stmt2->close();

    $remaining_qty = $total_qty - $assigned_qty;

    if ($remaining_qty > 0) {
        $available = true;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Asset Assign</title>
  <link rel="stylesheet" href="../CSS/Style_AssetAssign.php">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
  <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" />
</div>

<div class="asset-assign-page" style="text-align: center; margin-top: 20px;">
<div class="page-title">Asset Assign</div>

  <div class="form-card">
    <form action="../Main/Insert_Asset_Assign.php" method="POST">
      <div class="form-group">
      <label>Asset Reference No <span class="required">*</span></label>
      <input type="text" name="asset_ref_no" value="<?php echo htmlspecialchars($ref); ?>" readonly>
    </div>
    <div class="form-group">
  <label>Employee Name <span class="required">*</span></label>
  <input list="employee_list" name="employee_name" placeholder="Search Employee" required>
  <datalist id="employee_list">
    <option value="Vasuki ITS - 001">
    <option value="Yuktha ITS - 002">
    <option value="Hema ITS - 003">
    <option value="Harini ITS - 004">
    <option value="Ranjith ITS - 005">
    <option value="Ranjini ITS - 006">
  </datalist>
</div>
    <div class="form-group">
      <label>Assigning Date <span class="required">*</span></label>
      <input type="text" id="assign_date" name="assign_date" placeholder="Select Date                                         📅" required>
    </div>
      <div class="button-group">
        <button type="button" onclick="history.back()">Back</button>
        <?php if ($available): ?>
  <button type="submit">Assign</button>
<?php else: ?>
  <button type="submit" enable>Assign</button>
<?php endif; ?>

      </div>
    </form>
  </div>
</div>

</body>
<script>
 $('#employee_name').select2({
  placeholder: "Select Employee",
  width: '100%'
});


  flatpickr("#assign_date", {
    dateFormat: "d-M-Y", 
    altInput: false,
    allowInput: true
  });


</script>



</html>