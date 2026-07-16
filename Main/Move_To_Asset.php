<?php
include('../DB_Config/Config.php');
$db = new dbconfig();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ref_no'])) {
    $ref_no = $_POST['ref_no'];

    $sql = "SELECT * FROM xxits_ams_purchase_det_t WHERE prod_ref_no = '$ref_no' AND approval_status = 'Approved' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $asset_ref_no   = $row['prod_ref_no'];
        $emp_name       = '';
        $assign_date    = date('Y-m-d');
        $return_date    = date('Y-m-d');
        $asset_name     = $row['product_name'];
        $category       = $row['category'];
        $serial_number  = $row['serial_number'];
        $model_details  = $row['model_detail'];
        $warranty       = $row['warranty'];
       $status = 'Available';


        $created_by         = -1;
        $creation_date      = date('Y-m-d');
        $last_updated_by    = -1;
        $last_update_date   = date('Y-m-d');
        $last_update_login  = 1001;

        $sql_insert = "INSERT INTO xxits_ams_asset_det_t (
            asset_ref_no, emp_name, assign_date, return_date, asset_name, category, serial_number,
            model_details, warranty, status,
            attribute_category, attribute1, attribute2, attribute3, attribute4,
            attribute5, attribute6, attribute7, attribute8, attribute9,
            attribute10, attribute11, attribute12, attribute13, attribute14, attribute15,
            created_by, creation_date, last_updated_by, last_update_date, last_update_login
        ) VALUES (
            '$asset_ref_no', '$emp_name', '$assign_date', '$return_date', '$asset_name', '$category', '$serial_number',
            '$model_details', '$warranty', '$status',
            '', '', '', '', '',
            '', '', '', '', '',
            '', '', '', '', '', '',
            $created_by, '$creation_date', $last_updated_by, '$last_update_date', $last_update_login
        )";

        if ($conn->query($sql_insert) === TRUE) {
            header("Location: ../Pages/Asset_List.php");
            exit();
        } else {
            echo "Error inserting asset: " . $conn->error;
        }

    } else {
        echo "No purchase record found for ref_no: $ref_no";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
