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
 
$asset_sql = "
  SELECT COUNT(*) AS asset_count 
  FROM xxits_ams_asset_trans_hist_t 
  WHERE emp_name = ? AND return_date = '0000-00-00'
";
$stmt = $conn->prepare($asset_sql);
$stmt->bind_param("s", $emp_name);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$asset_count = (int) $row['asset_count'];
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ticket Details</title>
<link rel="stylesheet" href="../CSS/Style_Ticket_list.php">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
  <h2>          </h2>
  <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" />
</div>

<div class="content"> 
    <div style="text-align: center; margin-top: 20px;">
      <div class="page-title">Ticket Details</div>
    </div>
<div class="top-bar-container">
  <form action="Raise_Ticket.php" method="get" style="margin: 0;">
  <button 
    type="submit" 
    class="btn-raise-ticket" 
    id="raiseTicketBtn"
    <?php if ($asset_count == 0): ?>
      disabled
    <?php endif; ?>
  >
    ➕ Raise Ticket
  </button>
</form>

  <div class="search-bar-container">
    <input type="text" id="searchInput" placeholder="Search...">
    <button><i class="fa fa-search"></i></button>
  </div>
</div>

<table class="ticket-table">
<thead>
<tr>
  <th>S.No</th>
  <th>Ticket No</th>
  <th>Employee</th>
  <th>Asset Name</th>
  <th>Raised On</th>
  <th>Issue Type</th>
  <th>Description</th>
  <th>Status</th>
  <th>Fixed On</th>
</tr>
</thead>
<tbody>
<?php
$whereClause = "";
$params = [];
$types = "";

if ($access_key === 's') {
    $whereClause = "";
} elseif ($access_key === 'a') {
    $whereClause = "WHERE (T.emp_id = ? OR E.access_key = 'e')";
    $params[] = $emp_id;
    $types .= "s";
} else {
    $whereClause = "WHERE T.emp_id = ?";
    $params[] = $emp_id;
    $types .= "s";
}

$sql = "
    SELECT 
      T.ticket_no, T.emp_id, T.asset_name, T.date, T.issue_type, T.description, T.status, T.fixed_on,
      E.emp_name, E.access_key
    FROM xxits_ams_tck_det_t T
    LEFT JOIN xxits_ams_emp_det_t E ON T.emp_id = E.emp_id
    $whereClause
    ORDER BY T.ticket_no ASC


";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$sno = 1;
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $empDisplay = htmlspecialchars($row['emp_id']);
        if (!empty($row['emp_name'])) {
            $empDisplay .= " - " . htmlspecialchars($row['emp_name']);
        }

        echo "<tr>";
        echo "<td>{$sno}</td>";
        echo "<td>" . htmlspecialchars($row['ticket_no']) . "</td>";
        echo "<td>{$empDisplay}</td>";
        echo "<td>" . htmlspecialchars($row['asset_name']) . "</td>";

        $raised = (!empty($row['date']) && $row['date'] !== '0000-00-00') 
                    ? date('d-M-Y', strtotime($row['date'])) 
                    : '-';
        echo "<td>{$raised}</td>";

        echo "<td>" . htmlspecialchars($row['issue_type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";

        $status = strtolower($row['status']);
        echo "<td>";
        if (($status === 'open' || $status === 'in-progress') && ($access_key === 'a' || $access_key === 's')) {
            echo '<a href="Ticket_Update.php?ticket_no=' . urlencode($row['ticket_no']) . '">' . htmlspecialchars($row['status']) . '</a>';
        } else {
            echo htmlspecialchars($row['status']);
        }
        echo "</td>";

        $fixedOn = $row['fixed_on'];
        if ($status === 'open' || $status === 'in-progress') {
            $fixed = '-';
        } elseif ($status === 'completed' && !empty($fixedOn) && $fixedOn !== '0000-00-00') {
            $fixed = date('d-M-Y', strtotime($fixedOn));
        } else {
            $fixed = '-';
        }
        echo "<td>{$fixed}</td>";

        echo "</tr>";
        $sno++;
    }
} else {
    echo "<tr><td colspan='9'>No tickets found.</td></tr>";
}
?>
</tbody>
</table>
</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    const input = this.value.toLowerCase();
    const rows = document.querySelectorAll(".ticket-table tbody tr");

    rows.forEach(row => {
      const cols = row.querySelectorAll("td");
      const searchable = [1, 2, 3, 4, 5, 7];
      const match = searchable.some(i =>
        cols[i] && cols[i].textContent.toLowerCase().includes(input)
      );
      row.style.display = match ? "" : "none";
    });
});
</script>

</body>
<?php if ($asset_count == 0): ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById("raiseTicketBtn");
  if (btn) {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      alert("❗ No assets assigned to you. You cannot raise a ticket.");
    });
  }
});
</script>
<?php endif; ?>

</html>