<?php
include('../DB_Config/Config.php');
$db = new dbconfig();
$conn = $db->getConnection();

$prod_ref_no     = $_POST['prod_ref_no'];
$order_date = date('Y-m-d', strtotime($_POST['order_date']));
$approval_status = $_POST['approval_status'];
$payment_status  = $_POST['payment_status'];

$created_by         = -1;
$creation_date      = date("Y-m-d");
$last_updated_by    = -1;
$last_update_date   = date("Y-m-d");
$last_update_login  = 1001;


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

 
for ($i = 0; $i < count($names); $i++) {
    
    $product_name    = mysqli_real_escape_string($conn, $names[$i]);
    $category        = mysqli_real_escape_string($conn, $categories[$i]);
    $serial_number   = mysqli_real_escape_string($conn, $serials[$i]);
    $warranty        = mysqli_real_escape_string($conn, $warranties[$i]);
    $model_detail    = mysqli_real_escape_string($conn, $models[$i]);
    $vendor_name     = mysqli_real_escape_string($conn, $vendors[$i]);
    $mobile_number = mysqli_real_escape_string($conn, $mobiles[$i]);


    $quantity        = (int)$quantities[$i];
    $price           = (int)$prices[$i];
    $gst             = (int)$gst_percents[$i];
    $qty_price       = (float)$qty_prices[$i];
    $gst_amount      = (float)$gst_amounts[$i];
    $total           = (float)$totals[$i];
 
    $sql = "INSERT INTO xxits_ams_purchase_det_t (
        product_name, category, serial_number, warranty, model_detail, vendor_name, mobile_number,
        quantity, price, gst, qty_price, gst_amount, total,
        approval_status, payment_status, prod_ref_no, order_date,
        created_by, creation_date, last_updated_by, last_update_date, last_update_login
    ) VALUES (
        '$product_name', '$category', '$serial_number', '$warranty', '$model_detail', '$vendor_name', '$mobile_number',
        $quantity, $price, $gst, $qty_price, $gst_amount, $total,
        '$approval_status', '$payment_status', '$prod_ref_no', '$order_date',
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