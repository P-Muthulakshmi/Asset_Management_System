<?php
include('../DB_Config/Config.php');
$db   = new dbconfig();
$conn = $db->getConnection();

$prod_ref_no     = $_POST['prod_ref_no'];
$order_date      = $_POST['order_date'];
$approval_status = $_POST['approval_status'];


$last_updated_by    = -1;
$last_update_date   = date("Y-m-d");
$last_update_login  = 1001;


for ($i = 0; $i < count($approval_status); $i++) {
    $status = mysqli_real_escape_string($conn, $approval_status[$i]);

    $sql = "UPDATE xxits_ams_purchase_det_t 
            SET approval_status = '$status',
                last_updated_by = $last_updated_by,
                last_update_date = '$last_update_date',
                last_update_login = $last_update_login
            WHERE prod_ref_no = '$prod_ref_no' 
            LIMIT 1";

    if (!mysqli_query($conn, $sql)) {
        echo "Error updating approval: " . mysqli_error($conn);
        $conn->close();
        exit();
    }
}

header("Location: ../Pages/Purchase_Record.php");
exit();
?>
