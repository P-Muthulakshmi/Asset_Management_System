<?php
session_start();
include('../DB_Config/Config.php');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="purchase_records_' . date('Ymd_His') . '.csv"');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');

fwrite($output, "\xEF\xBB\xBF");

fputcsv($output, [
    'S.No.', 'Reference No.', 'Ordered Date', 'Taxable Amount', 'GST Amount', 
    'Total Amount', 'Approval Status', 'Payment Status', 'Delivery Date', 'Delivery Status', 'Action'
]);

$db = new dbconfig();
$conn = $db->getConnection();

$query = "SELECT * FROM xxits_ams_purchase_det_t GROUP BY prod_ref_no ORDER BY prod_ref_no ASC";
$result = mysqli_query($conn, $query);

$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $refNo = $row['prod_ref_no'];

    $checkAsset = mysqli_query($conn, "SELECT 1 FROM xxits_ams_asset_det_t WHERE asset_ref_no = '$refNo' LIMIT 1");
    $isMoved = mysqli_num_rows($checkAsset) > 0;
    
    $actionText = $isMoved ? "✔" : ""; 

    $orderedDate = '-';
    if (!empty($row['order_date']) && $row['order_date'] !== '0000-00-00') {
        $orderedDate = date('d-M-Y', strtotime($row['order_date']));
    }

    $deliveryDate = '-';
    if (!empty($row['delivery_date']) && $row['delivery_date'] !== '0000-00-00') {
        $deliveryDate = date('d-M-Y', strtotime($row['delivery_date']));
    }

    $deliveryStatus = $row['delivery_status'] ?? 'Pending';

    fputcsv($output, [
        $i,
        $refNo,
        $orderedDate,
        $row['qty_price'],
        $row['gst_amount'],
        $row['total'],
        $row['approval_status'],
        $row['payment_status'],
        $deliveryDate,
        $deliveryStatus,
        $actionText  
    ]);

    $i++;
}

fclose($output);
exit();
?>
