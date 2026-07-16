<?php
include('../DB_Config/Config.php');
$db = new dbconfig();
$conn = $db->getConnection();

$ticket_no   = $_POST['ticket_no'];
$emp_id      = $_POST['emp_id'];
$asset_name  = $_POST['asset_name'];
$date_input  = $_POST['date'];  
$issue_type  = $_POST['issue_type'];
$description = $_POST['description'];


$date_obj = DateTime::createFromFormat('d-M-Y', $date_input);
if ($date_obj) {
    $date = $date_obj->format('Y-m-d'); 
} else {
    
    $date = date('Y-m-d');
}

$status             = 'Open';
$created_by         = -1;
$creation_date      = date('Y-m-d');
$last_updated_by    = -1;
$last_update_date   = date('Y-m-d');
$last_update_login  = 1001;

$sql = "INSERT INTO xxits_ams_tck_det_t 
(ticket_no, emp_id, asset_name, date, issue_type, description, status, created_by, creation_date, last_updated_by, last_update_date, last_update_login) 
VALUES 
('$ticket_no', '$emp_id', '$asset_name', '$date', '$issue_type', '$description', '$status', $created_by, '$creation_date', '$last_updated_by', '$last_update_date', '$last_update_login')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('✅ Ticket raised successfully!');
        window.location.href = '../Pages/Ticket_Details.php?status=raised';
    </script>";
    exit();
    }else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>