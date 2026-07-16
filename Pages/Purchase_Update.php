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
$prod_ref_no = $_GET['ref'] ?? '';

$query = "SELECT * FROM xxits_ams_purchase_det_t WHERE prod_ref_no = ?";
$stmt  = $conn->prepare($query);
$stmt->bind_param("s", $prod_ref_no);
$stmt->execute();
$result = $stmt->get_result();

$rows = [];
while ($r = $result->fetch_assoc()) {
    $rows[] = $r;
}
$order_date = !empty($rows) ? $rows[0]['order_date'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> Update Purchase — <?php echo htmlspecialchars($prod_ref_no); ?></title>
  <link rel="stylesheet" href="../CSS/Style_Update_Purchase.php">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="../CSS/Popup.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  
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
  <h2 style="margin: 0; font-size: 24px; color: #002366;">Update Purchase</h2>
  <hr style="width: 100%; border: none; border-top: 2px solid #002366; margin: 40px ;" />
</div>

<div class="content">
  <form method="POST" action="../Main/Purchase_Update_Backend.php">

    <?php if (!empty($rows)) : ?>
      <input type="hidden" name="approval_status" value="<?php echo htmlspecialchars($rows[0]['approval_status']); ?>">
    <?php endif; ?>

    <input type="hidden" name="prod_ref_no" value="<?php echo htmlspecialchars($prod_ref_no); ?>">
    <input type="hidden" name="order_date"   value="<?php echo htmlspecialchars($order_date); ?>">

    <table id="purchaseTable">
      <thead>
        <tr>
          <th class="sticky sticky-1">Name </th>
          <th class="sticky sticky-2">Category </th>
          <th class="sticky sticky-3">Serial Number</th>
          <th class="sticky sticky-4">Warranty</th>
          <th class="sticky sticky-5">Model</th>
          <th class="sticky sticky-6">Vendor</th>
          <th class="sticky sticky-7">Mobile</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>GST(%)</th>
          <th>Qty Price</th>
          <th>GST Amt</th>
          <th>Total</th>
          <th>Delivery Date<span style="color:red;" >*</span></th>
          <th>Payment Status<span style="color:red;" >*</span></th>
          <th>Delivery Status<span style="color:red;" >*</span></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $row): ?>
        <tr>
          <td class="sticky sticky-1"><input type="text" name="name[]" value="<?php echo htmlspecialchars($row['product_name']); ?>" readonly></td>

          <td class="sticky sticky-2">
            <select name="category_disabled[]" disabled>
              <?php
              $cats = ['Computing Devices','Networking','Security and Access','Furniture'];
              foreach ($cats as $c) {
                  $sel = $row['category'] == $c ? 'selected' : '';
                  echo "<option $sel>".htmlspecialchars($c)."</option>";
              }
              ?>
            </select>
            <input type="hidden" name="category[]" value="<?php echo htmlspecialchars($row['category']); ?>">
          </td>

          <td class="sticky sticky-3"><input type="text" name="serial[]" value="<?php echo htmlspecialchars($row['serial_number']); ?>" readonly></td>
          <td class="sticky sticky-4"><input type="text" name="warranty[]" value="<?php echo htmlspecialchars($row['warranty']); ?>" readonly></td>
          <td class="sticky sticky-5"><input type="text" name="model[]" value="<?php echo htmlspecialchars($row['model_detail']); ?>" readonly></td>
          <td class="sticky sticky-6"><input type="text" name="vendor[]" value="<?php echo htmlspecialchars($row['vendor_name']); ?>" readonly></td>
          <td class="sticky sticky-7"><input type="text" name="mobile[]" value="<?php echo htmlspecialchars($row['mobile_number']); ?>" readonly></td>

          <td><input type="number" name="quantity[]" value="<?php echo htmlspecialchars($row['quantity']); ?>" readonly></td>
          <td><input type="number" name="price[]" value="<?php echo htmlspecialchars($row['price']); ?>" readonly></td>
          <td><input type="number" name="gst_percent[]" value="<?php echo htmlspecialchars($row['gst']); ?>" readonly></td>
          <td><input type="text" name="qty_price[]" value="<?php echo htmlspecialchars($row['qty_price']); ?>" readonly></td>
          <td><input type="text" name="gst_amount[]" value="<?php echo htmlspecialchars($row['gst_amount']); ?>" readonly></td>
          <td><input type="text" name="total[]" value="<?php echo htmlspecialchars($row['total']); ?>" readonly></td>

          <td>
            <?php
              $delivery_raw = $row['delivery_date'];
              $delivery_val = ($delivery_raw && $delivery_raw !== '0000-00-00') ? date('Y-m-d', strtotime($delivery_raw)) : '';
            ?>
            <input type="text" name="delivery_date[]" class="delivery-date" placeholder="Delivery Date"
  value="<?php echo $delivery_val; ?>"
  <?php echo ($row['delivery_status'] === 'Delivered') ? '' : 'disabled'; ?>>

          </td>

          <td>
            <select name="payment_status[]">
            <?php
            $pays = ['--select--','Paid','Unpaid','Partially Paid'];
            $current_payment = empty($row['payment_status']) ? '--select--' : $row['payment_status'];

            foreach ($pays as $p) {
            $sel = ($current_payment === $p) ? 'selected' : '';
            echo "<option value=\"$p\" $sel>$p</option>";
            }
            ?>
            </select>
          </td>

          <td>
            <select name="delivery_status[]" onchange="toggleDeliveryDate(this)">

              <?php
              $statuses = ['--select--','Delivered', 'Pending', 'Delayed'];
              foreach ($statuses as $status) {
                  $sel = ($row['delivery_status'] ?? '') == $status ? 'selected' : '';
                  echo "<option value=\"$status\" $sel>$status</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div  class="action-bar-fixed" style="display: flex; justify-content: flex-end; margin-top: 100px;">
      <button type="submit" class="btn">Update</button>
      <a href="Purchase_Record.php" class="btn">Back</a>
    </div>

  </form>
</div>

<div id="popup" class="popup-box"></div>
<script>
  const orderDate = "<?php echo htmlspecialchars($order_date); ?>";

  flatpickr(".delivery-date", {
      dateFormat: "Y-m-d",
      altInput: true,
      altFormat: "d-M-Y",
      allowInput: true,
      minDate: orderDate 
  });

  document.querySelector("form").addEventListener("submit", function (event) {
    if (confirm("Are you sure you want to update the purchase details?")) {
        alert("✅ Purchase updated successfully!");
    } else {
        event.preventDefault();
    }
});
  function toggleDeliveryDate(selectElement) {
    const selectedValue = selectElement.value;
    const row = selectElement.closest("tr");
    const deliveryDateInput = row.querySelector(".delivery-date");

    if (selectedValue === "Delivered") {
        deliveryDateInput.disabled = false;

        // Re-initialize flatpickr when enabling
        flatpickr(deliveryDateInput, {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d-M-Y",
            allowInput: true,
            minDate: orderDate 
        });

    } else {
        deliveryDateInput.disabled = true;
        deliveryDateInput.value = "";
    }
}


</script>


</body>
</html>