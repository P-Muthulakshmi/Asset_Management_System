<?php
session_start();
include('../DB_Config/Config.php'); 

if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit;
}

$db = new dbconfig();
$conn = $db->getConnection();

$emp_id     = $_SESSION['emp_id'];
$emp_name   = $_SESSION['emp_name'];
$access_key = $_SESSION['access_key'];
$ticketNo = isset($_GET['ticket_no']) ? $_GET['ticket_no'] : '';

$assetName = $raisedOn = $issueType = $description = $status = $fixedOn = "";

if (!empty($ticketNo)) {
  $sql = "SELECT * FROM xxits_ams_tck_det_t WHERE ticket_no = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $ticketNo);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    $assetName   = $row['asset_name'];
    $raisedOn    = date('d-M-Y', strtotime($row['date']));
    $issueType   = $row['issue_type'];
    $description = $row['description'];
    $status      = $row['status'];
    $fixedOn     = (!empty($row['fixed_on']) && $row['fixed_on'] !== '0000-00-00')
                    ? date('d-M-Y', strtotime($row['fixed_on'])) 
                    : '';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ticket Update</title>
<link rel="stylesheet" href="../CSS/Style.php">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
.calendar-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.calendar-wrapper input[type="text"] {
  width: 100%;
  padding-right: 30px;
}

.calendar-icon {
  position: absolute;
  right: 10px;
  pointer-events: none;
  font-size: 18px;
  color: #333;
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
  <h2>           </h2>
  <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" />
</div>

<div class="content">
  <div style="text-align: center; margin-top: 20px;">
      <div class="page-title">Ticket Update</div>
    </div>
<div class="ticket-box">
<form action="../Main/Update_Ticket_Save.php" method="POST">
<div class="ticket-grid">

  <div class="input-box">
    <label for="ticket_no">Ticket No</label>
    <input type="text" id="ticket_no" name="ticket_no" value="<?php echo htmlspecialchars($ticketNo); ?>" readonly>
  </div>

  <div class="input-box">
    <label for="assetName">Asset Name</label>
    <input type="text" id="assetName" name="assetName" value="<?php echo htmlspecialchars($assetName); ?>" readonly>
  </div>

  <div class="input-box">
    <label for="raisedOn">Raised On</label>
    <input type="text" id="raisedOn" name="raisedOn" value="<?php echo htmlspecialchars($raisedOn); ?>" readonly>
  </div>

  <div class="input-box">
    <label for="issueType">Issue Type</label>
    <input type="text" id="issueType" name="issueType" value="<?php echo htmlspecialchars($issueType); ?>" readonly>
  </div>

  <div class="input-box" style="grid-column: span 2;">
    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="2" readonly><?php echo htmlspecialchars($description); ?></textarea>
  </div>

  <div class="input-box">
    <label for="status">Status</label>
    <select id="status" name="status" required>
      <option value="">--Select--</option>
      <option value="Open"        <?php if ($status == 'Open') echo 'selected'; ?>>Open</option>
      <option value="In-progress" <?php if ($status == 'In-progress') echo 'selected'; ?>>In-progress</option>
      <option value="Completed"   <?php if ($status == 'Completed') echo 'selected'; ?>>Completed</option>
    </select>
  </div>

  <div class="input-box">
    <label for="fixed_on">Issue Fixed On</label>
    <div class="calendar-wrapper">
      <input type="text" id="fixed_on" name="fixed_on" placeholder="Select Date" value="<?php echo htmlspecialchars($fixedOn); ?>">
      <span class="calendar-icon">📅</span>
    </div>
  </div>

</div>

<div class="btn-group">
  <button type="button" onclick="location.href='./Ticket_Details.php'">Back</button>
  <button type="submit">Submit</button>
</div>

</form>
</div>
</div>

<script>
flatpickr("#fixed_on", {
    dateFormat: "d-M-Y",
    altInput: false,
    allowInput: true,
    minDate: (function() {
        const today = new Date();
        const raisedOnStr = document.getElementById("raisedOn").value;
        const parsedRaisedOn = Date.parse(raisedOnStr.replace(/-/g, ' ')); 
        if (!isNaN(parsedRaisedOn)) {
            const raisedOnDate = new Date(parsedRaisedOn);
            return (raisedOnDate > today) ? raisedOnDate : today;
        }
        return today;
    })()
});

const statusField = document.getElementById("status");
const fixedOnField = document.getElementById("fixed_on");

function toggleFixedOn() {
    const value = statusField.value.toLowerCase();
    if (value === "open" || value === "in-progress") {
        fixedOnField.disabled = true;
        fixedOnField.removeAttribute("required");
        fixedOnField.value = "";
    } else if (value === "completed") {
        fixedOnField.disabled = false;
        fixedOnField.setAttribute("required", "required");
    } else {
        fixedOnField.disabled = true;
        fixedOnField.removeAttribute("required");
        fixedOnField.value = "";
    }
}

statusField.addEventListener("change", toggleFixedOn);
toggleFixedOn();
</script>

</body>
</html>