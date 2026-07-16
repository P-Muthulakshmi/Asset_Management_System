<?php
session_start();
include('../DB_Config/Config.php');
 
if (!isset($_SESSION['emp_id'])) {
    header("Location: ../Login.php");
    exit();
}

$emp_id     = $_SESSION['emp_id'];
$emp_name   = $_SESSION['emp_name'];
$access_key = $_SESSION['access_key'];

$db = new dbconfig();
$conn = $db->getConnection();

 
$sql = "SELECT MAX(ticket_no) AS max_ticket FROM xxits_ams_tck_det_t";
$result = $conn->query($sql);
$nextNum = 1;
if ($result && $row = $result->fetch_assoc()) {
    if (!empty($row['max_ticket'])) {
        $num = intval(substr($row['max_ticket'], 4));
        $nextNum = $num + 1;
    }
}
$new_ticket_no = "TCK-" . str_pad($nextNum, 3, "0", STR_PAD_LEFT);

$today_date = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Raise Ticket</title>
  <link rel="stylesheet" href="../CSS/Style_Raise_Ticket.php">
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
  <h2>        </h2>
  <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" />
</div>

<div class="content"> 
    <div style="text-align: center; margin-top: 20px;">
      <div class="page-title">Raise Ticket</div>
    </div>
    

<div class="form-container">
  
    <form action="../Main/Insert_Ticket.php" method="POST">
       
      <input type="hidden" name="emp_id" value="<?php echo htmlspecialchars($emp_id); ?>">
      <input type="hidden" name="created_by" value="<?php echo htmlspecialchars($emp_id); ?>">
      <input type="hidden" name="creation_date" value="<?php echo date('Y-m-d H:i:s'); ?>">

       
      <div class="form-group">
        <label>Ticket No <span class="required">*</span></label>
        <input type="text" name="ticket_no" value="<?php echo htmlspecialchars($new_ticket_no); ?>" readonly>
      </div>

      <div class="form-group">
  <label>Asset Name <span class="required">*</span></label>
  <select name="asset_name" required>
    <option value="">-- Select Asset --</option>
    <?php
    $asset_sql = "
      SELECT d.asset_name 
      FROM xxits_ams_asset_trans_hist_t t
      JOIN xxits_ams_asset_det_t d 
        ON t.asset_ref_no = d.asset_ref_no
      WHERE t.emp_name = ? AND t.return_date = '0000-00-00'
    ";
    $stmt = $conn->prepare($asset_sql);
    $stmt->bind_param("s", $emp_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $formatted = ucwords(strtolower($row['asset_name']));
        echo '<option value="' . htmlspecialchars($formatted) . '">' . htmlspecialchars($formatted) . '</option>';

    }
    $stmt->close();
    ?>
  </select>
</div>


      <div class="form-group">
        <label>Date <span class="required">*</span></label>
        <input type="text" name="date" value="<?php echo date('d-M-Y'); ?>" readonly>
      </div>

      <div class="form-group">
        <label>Issue Type <span class="required">*</span></label>
        <select name="issue_type" required>
          <option value="">-- Select Issue --</option>
          <option value="Damage">Damage</option>
          <option value="Installation">Installation</option>
        </select>
      </div>

      <div class="form-group description-box">
        <label>Description <span class="required">*</span></label>
        <textarea name="description" required></textarea>
      </div>

      <div class="form-footer">
  <button class="btn" type="button" onclick="location.href='Ticket_Details.php'">Back</button>
  <button class="btn" type="submit">Raise Ticket</button>
</div>



    </form>
  </div>
</div>


</body>
<script>
  // Function to convert string to InitCap
  function toInitCap(str) {
    return str
      .toLowerCase()
      .split(' ')
      .map(word => word.charAt(0).toUpperCase() + word.slice(1))
      .join(' ');
  }

  document.querySelector('form').addEventListener('submit', function (e) {
    // Capitalize all text input fields and textareas
    const fields = this.querySelectorAll('input[type="text"], textarea, select');
    fields.forEach(field => {
      if (field.value) {
        field.value = toInitCap(field.value);
      }
    });
  });
</script>

</html>