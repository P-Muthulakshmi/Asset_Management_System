<?php
include('../DB_Config/Config.php');
$db   = new dbconfig();
$conn = $db->getConnection();

$prod_ref_no     = $_POST['prod_ref_no'];
$order_date      = date('Y-m-d'); 

$payment_status  = $_POST['payment_status'] ?? [];  
$delivery_status = $_POST['delivery_status'] ?? [];  
$delivery_dates  = $_POST['delivery_date'] ?? []; 

$names        = $_POST['name'];
$categories   = $_POST['category'];
$serials      = $_POST['serial'];
$warranties   = $_POST['warranty'];
$models       = $_POST['model'];
$vendors      = $_POST['vendor'];
$mobiles      = $_POST['mobile'];
$quantities   = $_POST['quantity'];
$prices       = $_POST['price'];
$gst_percents = $_POST['gst_percent'];
$qty_prices   = $_POST['qty_price'];
$gst_amounts  = $_POST['gst_amount'];
$totals       = $_POST['total'];

$created_by        = -1;
$creation_date     = date("Y-m-d");
$last_updated_by   = -1;
$last_update_date  = date("Y-m-d");
$last_update_login = 1001;


$existing_approvals = [];
$sql_sel = "SELECT approval_status FROM xxits_ams_purchase_det_t WHERE prod_ref_no = ?";
$stmt = $conn->prepare($sql_sel);
$stmt->bind_param("s", $prod_ref_no);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $existing_approvals[] = $row['approval_status'];
}
$stmt->close();


$deleteSQL = "DELETE FROM xxits_ams_purchase_det_t WHERE prod_ref_no = ?";
$deleteStmt = $conn->prepare($deleteSQL);
$deleteStmt->bind_param("s", $prod_ref_no);
$deleteStmt->execute();
$deleteStmt->close();


for ($i = 0; $i < count($names); $i++) {
    $product_name   = mysqli_real_escape_string($conn, $names[$i]);
    $category       = mysqli_real_escape_string($conn, $categories[$i]);
    $serial_number  = mysqli_real_escape_string($conn, $serials[$i]);
    $warranty       = mysqli_real_escape_string($conn, $warranties[$i]);
    $model_detail   = mysqli_real_escape_string($conn, $models[$i]);
    $vendor_name    = mysqli_real_escape_string($conn, $vendors[$i]);
    $mobile_number  = mysqli_real_escape_string($conn, $mobiles[$i]);

    // ✅ FIXED delivery_date logic
    $delivery_date_input = isset($delivery_dates[$i]) ? trim($delivery_dates[$i]) : '';
    if (!empty($delivery_date_input)) {
        $delivery_date_obj = DateTime::createFromFormat('Y-m-d', $delivery_date_input);
        $delivery_date = $delivery_date_obj ? $delivery_date_obj->format('Y-m-d') : date('Y-m-d');
    } else {
        $delivery_date = date('Y-m-d'); // fallback default
    }

    $quantity       = (int)$quantities[$i];
    $price          = (int)$prices[$i];
    $gst            = (int)$gst_percents[$i];
    $qty_price      = (float)$qty_prices[$i];
    $gst_amount     = (float)$gst_amounts[$i];
    $total          = (float)$totals[$i];

    $payment_raw    = isset($payment_status[$i]) ? trim($payment_status[$i]) : '';
    $payment = "'" . mysqli_real_escape_string($conn, ($payment_raw === '--select--' || empty($payment_raw) ? 'Unpaid' : $payment_raw)) . "'";

    $delivery_raw   = isset($delivery_status[$i]) ? trim($delivery_status[$i]) : '';
    $delivery_stat = "'" . mysqli_real_escape_string($conn, ($delivery_raw === '--select--' || empty($delivery_raw) ? 'Pending' : $delivery_raw)) . "'";

    $approval_raw   = $existing_approvals[$i] ?? '--select--';
    $approval = "'" . mysqli_real_escape_string($conn, ($approval_raw === '--select--' || empty($approval_raw) ? 'Pending' : $approval_raw)) . "'";

    $sql = "INSERT INTO xxits_ams_purchase_det_t (
        product_name, category, serial_number, warranty, model_detail, vendor_name, mobile_number,
        quantity, price, gst, qty_price, gst_amount, total,
        delivery_status, payment_status, approval_status, prod_ref_no, order_date, delivery_date,
        created_by, creation_date, last_updated_by, last_update_date, last_update_login
    ) VALUES (
        '$product_name', '$category', '$serial_number', '$warranty', '$model_detail', '$vendor_name', '$mobile_number',
        $quantity, $price, $gst, $qty_price, $gst_amount, $total,
        $delivery_stat, $payment, $approval, '$prod_ref_no', '$order_date', '$delivery_date',
        $created_by, '$creation_date', $last_updated_by, '$last_update_date', $last_update_login
    )";

    if (!mysqli_query($conn, $sql)) {
        echo "❌ Error inserting row " . ($i + 1) . ": " . mysqli_error($conn);
        $conn->close();
        exit();
    }
}

header("Location: ../Pages/Purchase_Record.php");
exit();
?>
