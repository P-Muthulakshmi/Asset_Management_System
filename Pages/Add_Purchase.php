<?php
session_start();
include('../DB_Config/Config.php');
$db   = new dbconfig();
$conn = $db->getConnection();

if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit;
}

$db = new dbconfig();
$conn = $db->getConnection();
$emp_id     = $_SESSION['emp_id'] ?? '';
$emp_name   = $_SESSION['emp_name'] ?? '';
$access_key = $_SESSION['access_key'] ?? '';
$query = "SELECT MAX(prod_ref_no) AS last_ref FROM xxits_ams_purchase_det_t WHERE prod_ref_no LIKE 'Ref - %'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row && $row['last_ref']) {
    preg_match('/Ref - (\d+)/', $row['last_ref'], $matches);
    $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
    $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
} else {
    $nextNumber = "001";
}

$nextRefNo = "Ref - " . $nextNumber;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Purchase</title>
  <link rel="stylesheet" href="../CSS/Style_addpurchase.php">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

<div class="header">
  <h2></h2>
  <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" class="logo" />
</div>

<div class="content">
  <form method="POST" action="../Main/Add_Purchase_Backend.php">
    <div class="page-title"> Add Purchase</div>

    <div class="buttons">
      <button type="button" onclick="location.href='./Purchase_Record.php'">Back</button>
      <button type="button" onclick="addRow()">Add</button>
      <button type="submit">Save</button>

      <b>Reference No:</b> 
      <input type="text" class="medium-input" name="prod_ref_no" value="<?php echo $nextRefNo; ?>" readonly>

      <b>Order Date: <span style="color: red;">*</span></b>
      <div class="date-picker-wrapper">
        <input type="text" class="medium-input" id="order_date" name="order_date" placeholder="Select Date" required>
        <span class="calendar-icon">📅</span>
      </div>
    </div>

    <input type="hidden" name="approval_status" value="Pending">
    <input type="hidden" name="payment_status" value="Not Paid">
    <input type="hidden" id="gst_amount_hidden" name="gst_amount">
    <input type="hidden" id="qty_price_hidden" name="qty_price">
    <input type="hidden" id="total_hidden" name="total">
    <div class="table-scroll">
    <table id="purchaseTable">
     <thead>
  <tr>
    <th>Name <span style="color: red;">*</span></th>
    <th>Category <span style="color: red;">*</span></th>
    <th>Serial Number <span style="color: red;">*</span></th>
    <th>Warranty <span style="color: red;">*</span></th>
    <th>Model Details <span style="color: red;">*</span></th>
    <th>Vendor Name <span style="color: red;">*</span></th>
    <th>Mobile No. <span style="color: red;">*</span></th>
    <th>Quantity <span style="color: red;">*</span></th>
    <th>Price<span style="color: red;">*</span></th>
    <th>GST(%)<span style="color: red;">*</span></th>
    <th>Qty Price</th>
    <th>GST Amount</th>
    <th>Total</th>
    <th>Action</th>
  </tr>
</thead>

      <tbody></tbody>
    </table>
    </div>
    <div class="summary">
      <label>Taxable Amount: <input type="text" id="taxable" readonly></label>
      <label>GST Amount: <input type="text" id="gst" readonly></label>
      <label>Grand Total: <input type="text" id="grand" readonly></label>
    </div>
  </form>
</div>

<script>
function addRow() {
  const tableBody = document.querySelector("#purchaseTable tbody");
  const rows = tableBody.querySelectorAll("tr");

  if (rows.length >= 1) {
    alert("Only one purchase row is allowed.");
    return;
  }

  if (rows.length > 0) {
    const lastRow = rows[rows.length - 1];
    const inputs = lastRow.querySelectorAll("input, select");

    for (let input of inputs) {
      if (input.tagName === 'SELECT' && input.value === "-- Select --") {
        alert("Null values are not accepted. Please fill all fields.");
        input.style.border = "1px solid red";
        return;
      } else if (input.tagName !== 'SELECT' && input.value.trim() === "") {
        alert("Null values are not accepted. Please fill all fields.");
        input.style.border = "1px solid red";
        return;
      } else {
        input.style.border = "";
      }
    }

    const mobileInput = lastRow.querySelector('input[name="mobile[]"]');
    if (mobileInput) {
      const mobileVal = mobileInput.value.trim();
      if (!/^[5-9]\d{9}$/.test(mobileVal)) {
        alert("Mobile number invalid...!");
        mobileInput.style.border = "1px solid red";
        return;
      } else {
        mobileInput.style.border = "";
      }
    }
  }

  const row = tableBody.insertRow();
  const cols = [
  '<input type="text" name="name[]" class="capitalize-input">',  
  `<select name="category[]" class="capitalize-input">
    <option>-- Select --</option>
    <option>Computing Devices</option>
    <option>Networking</option>
    <option>Security and Access</option>
    <option>Furniture</option>
  </select>`, 
  '<input type="text" name="serial[]" class="capitalize-input">' ,                         
  '<input type="text" name="warranty[]" class="capitalize-input">', 
  '<input type="text" name="model[]" class="capitalize-input">',    
  '<input type="text" name="vendor[]" class="capitalize-input">',   
  '<input type="text" name="mobile[]">',                        
  '<input type="number" name="quantity[]" value="0" min="0" onchange="calculateTotal(this)">',
  '<input type="number" name="price[]" value="0" min="0" onchange="calculateTotal(this)">',
  '<input type="number" name="gst_percent[]" value="0" min="0" onchange="calculateTotal(this)">',
  '<input type="text" name="qty_price[]" readonly>',
  '<input type="text" name="gst_amount[]" readonly>',
  '<input type="text" name="total[]" readonly>',
  '<button type="button" onclick="deleteRow(this)">🗑</button>'
];

  cols.forEach(col => {
    const cell = row.insertCell();
    cell.innerHTML = col;
  });
}

function deleteRow(btn) {
  btn.closest("tr").remove();
  updateSummary();
}

function calculateTotal(input) {
  const row = input.closest("tr");
  const qty = parseFloat(row.querySelector('[name="quantity[]"]').value) || 0;
  const price = parseFloat(row.querySelector('[name="price[]"]').value) || 0;
  const gstPercent = parseFloat(row.querySelector('[name="gst_percent[]"]').value) || 0;

  const qtyPrice = qty * price;
  const gstAmount = qtyPrice * (gstPercent / 100);
  const total = qtyPrice + gstAmount;

  row.querySelector('[name="qty_price[]"]').value = qtyPrice.toFixed(2);
  row.querySelector('[name="gst_amount[]"]').value = gstAmount.toFixed(2);
  row.querySelector('[name="total[]"]').value = total.toFixed(2);

  updateSummary();
}

function updateSummary() {
  let taxable = 0, gst = 0, grand = 0;
  const rows = document.querySelectorAll("#purchaseTable tbody tr");
  rows.forEach(row => {
    taxable += parseFloat(row.querySelector('[name="qty_price[]"]').value) || 0;
    gst += parseFloat(row.querySelector('[name="gst_amount[]"]').value) || 0;
    grand += parseFloat(row.querySelector('[name="total[]"]').value) || 0;
  });
  document.getElementById("taxable").value = taxable.toFixed(2);
  document.getElementById("gst").value = gst.toFixed(2);
  document.getElementById("grand").value = grand.toFixed(2);

  document.getElementById("gst_amount_hidden").value = gst.toFixed(2);
  document.getElementById("qty_price_hidden").value = taxable.toFixed(2);
  document.getElementById("total_hidden").value = grand.toFixed(2);
}

document.querySelector("form").addEventListener("submit", function(e) {
  const rows = document.querySelectorAll("#purchaseTable tbody tr");
  if (rows.length === 0) {
    e.preventDefault();
    alert("Please add at least one purchase row.");
    return false;
  }

  let hasEmptyFields = false;
  let mobileInvalid = false;

  rows.forEach(row => {
    const requiredFields = [
      'name[]',
      'category[]',
      'serial[]',
      'warranty[]',
      'model[]',
      'vendor[]',
      'mobile[]',
      'quantity[]',
      'price[]',
      'gst_percent[]'
    ];

    requiredFields.forEach(field => {
       const input = row.querySelector(`[name="${field}"]`);  
      if (input && (input.value.trim() === '' || parseFloat(input.value) === 0)) {

        hasEmptyFields = true;
        input.style.border = "1px solid red";
      } else if (input) {
        input.style.border = "";
      }
    });

    const mobileInput = row.querySelector('input[name="mobile[]"]');
    if (mobileInput && !/^[5-9]\d{9}$/.test(mobileInput.value.trim())) {
      mobileInvalid = true;
      mobileInput.style.border = "1px solid red";
    }

    calculateTotal(row.querySelector('[name="quantity[]"]'));
  });

  if (hasEmptyFields) {
    e.preventDefault();
    alert("Null values are not accepted. Please fill all fields.");
    return false;
  }

  if (mobileInvalid) {
    e.preventDefault();
    alert("Invalid Mobile Number...!");
    return false;
  }

  const confirmSave = confirm("Are you sure you want to save this purchase?");
  if (!confirmSave) {
    e.preventDefault();
    return false;
  }

  alert("Purchased Successfully!");
  updateSummary();
});

flatpickr("#order_date", {
  dateFormat: "d-M-Y",
  altInput: false,
  allowInput: true
});
</script>

</body>
</html>