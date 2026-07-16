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
?>
<!DOCTYPE html>
<html>
<head>
  <title>Purchase Records</title>
  <link rel="stylesheet" href="../CSS/Style_PurRec.php">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

<div class="header" style="background-color: #002366; height: 60px; display: flex; justify-content: flex-end; align-items: center; padding: 0 20px;">
  <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" style="height: 40px;" />
</div>

<div style="margin-left: 220px; padding: 20px; text-align: center;">
  <h2 style="margin: 0; font-size: 24px; color: #002366;">Purchase List</h2>
  <hr style="width: 100%; border: none; border-top: 2px solid #002366; margin: 10px auto;" />
</div>

<div class="top-bar-container">
  <div class="search-wrapper">
    <input type="text" id="searchInput" name="search" placeholder="Search..." />
    <button type="submit" title="Search"><i class="fas fa-search"></i></button>
  </div>

  <div class="right-buttons">
    <form method="post" action="../Main/Export_purchase.php" style="margin: 0;">
      <button type="submit" class="btn-export">📤 Export</button>
    </form>
    <a href="Add_Purchase.php" class="btn-add">➕ Add Purchase</a>
  </div>
</div>

<div style="overflow-x:auto; margin-left:220px; width:calc(100% - 220px); box-sizing:border-box; padding:20px;">
  <table border="1" cellpadding="5" cellspacing="0">
    <thead>
      <tr>
        <th>S.No.</th>
        <th>Reference No.</th>
        <th>Ordered Date</th>  
        <th>Taxable Amount</th>
        <th>GST Amount</th>
        <th>Total Amount</th>
        <th>Approval Status</th>
        <th>Payment Status</th>
        <th>Delivery Date</th>      
        <th>Delivery Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="defaultResults">
      <?php
      $search = $_GET['search'] ?? '';
      $search = mysqli_real_escape_string($conn, $search);
      $sql = "SELECT * FROM xxits_ams_purchase_det_t";
      if (!empty($search)) {
          $sql .= " WHERE prod_ref_no LIKE '%$search%'";
      }
      $sql .= " GROUP BY prod_ref_no ORDER BY prod_ref_no ASC";
      $result = mysqli_query($conn, $sql);
      $i = 1;
      while ($row = mysqli_fetch_assoc($result)) {
        $refNo = $row['prod_ref_no'];
        $checkAsset = mysqli_query($conn, "SELECT 1 FROM xxits_ams_asset_det_t WHERE asset_ref_no = '$refNo' LIMIT 1");
        $isMoved = mysqli_num_rows($checkAsset) > 0;
        $orderedDate = (!empty($row['order_date']) && $row['order_date'] !== '0000-00-00') ? date('d-M-Y', strtotime($row['order_date'])) : '-';

        $deliveryStatus = $row['delivery_status'] ?? 'Pending';
        $deliveryDate = (strtolower($deliveryStatus) === 'delivered' && !empty($row['delivery_date']) && $row['delivery_date'] !== '0000-00-00') 
                        ? date('d-M-Y', strtotime($row['delivery_date'])) 
                        : '-';

        $checkSQL = "SELECT 
                      COUNT(*) AS total,
                      SUM(CASE WHEN payment_status IS NULL OR payment_status = '--select--' THEN 1 ELSE 0 END) AS payment_missing,
                      SUM(CASE WHEN delivery_status IS NULL OR delivery_status = '--select--' THEN 1 ELSE 0 END) AS delivery_missing,
                      SUM(CASE WHEN delivery_date IS NULL OR delivery_date = '0000-00-00' THEN 1 ELSE 0 END) AS date_missing
                    FROM xxits_ams_purchase_det_t
                    WHERE prod_ref_no = '$refNo'";
        $checkRes = mysqli_query($conn, $checkSQL);
        $checkRow = mysqli_fetch_assoc($checkRes);

        $canMove = (
          $row['approval_status'] === 'Approved' &&
          $checkRow['payment_missing'] == 0 &&
          $checkRow['delivery_missing'] == 0 &&
          $checkRow['date_missing'] == 0 &&
          strtolower($deliveryStatus) === 'delivered'
        );

        echo "<tr><td>{$i}</td>";
        $refLink = ($row['approval_status'] === 'Approved' && $orderedDate !== '-') 
           ? "<a href='Purchase_Update.php?ref={$refNo}'>{$refNo}</a>" 
           : $refNo;
        echo "<td>{$refLink}</td>";

        if ($access_key === 's') {
            if ($isMoved) {
                echo "<td><span style='color:gray; font-weight:bold;' title='Already moved to asset'>{$orderedDate}</span></td>";
            } else {
                echo "<td><a href='Purchase_Approval.php?ref={$refNo}' style='text-decoration:none;color:#0047ab;'>{$orderedDate}</a></td>";
            }
        } else {
            echo "<td><span style='color:#0047ab;font-weight:bold;'>{$orderedDate}</span></td>";
        }

        echo "<td>{$row['qty_price']}</td>
              <td>{$row['gst_amount']}</td>
              <td>{$row['total']}</td>
              <td>{$row['approval_status']}</td>
              <td>{$row['payment_status']}</td>
              <td>{$deliveryDate}</td>
              <td>{$deliveryStatus}</td>
              <td>";
        
        if ($isMoved && strtolower($deliveryStatus) === 'delivered') {
          echo "<span style='color:green;font-size:20px;'>&#10004;</span>";
        } else {
          echo "<form method='post' action='../Main/Move_To_Asset.php'>
                  <input type='hidden' name='ref_no' value='{$refNo}'>
                  <button type='submit' " . ($canMove ? '' : 'disabled style="background-color:lightgray;cursor:not-allowed;" title="Fill all required fields before moving"') . ">Move to Asset</button>
                </form>";
        }
        echo "</td></tr>";
        $i++;
      }
      ?>
    </tbody>
  </table>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const input = this.value.trim().toLowerCase();
    const rows = document.querySelectorAll('#defaultResults tr');
    let hasMatch = false;

    rows.forEach(function (row) {
        const cells = row.querySelectorAll('td');
        let match = false;

        const searchableCols = [1, 6, 7, 9, 10];
        searchableCols.forEach(index => {
            if (cells[index] && cells[index].textContent.toLowerCase().includes(input)) {
                match = true;
            }
        });

        if (match || input === '') {
            row.style.display = '';
            hasMatch = true;
        } else {
            row.style.display = 'none';
        }
    });

    let noRow = document.getElementById('noResultsRow');
    if (!hasMatch && input !== '') {
        if (!noRow) {
            noRow = document.createElement('tr');
            noRow.id = 'noResultsRow';
            noRow.innerHTML = '<td colspan="11" style="text-align:center; color:red;">No matching records found</td>';
            document.getElementById('defaultResults').appendChild(noRow);
        }
    } else {
        if (noRow) noRow.remove();
    }
});
</script>

</body>
</html>
