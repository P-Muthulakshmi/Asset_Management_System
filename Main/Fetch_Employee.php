<?php
include('../DB_Config/Config.php');
$db = new dbconfig();
$conn = $db->getConnection();

$search = $_GET['q'] ?? '';

$sql = "SELECT emp_id, emp_name FROM xxits_ams_emp_det_t WHERE emp_name LIKE ? OR emp_id LIKE ? LIMIT 10";
$stmt = $conn->prepare($sql);
$like = '%' . $search . '%';
$stmt->bind_param("ss", $like, $like);
$stmt->execute();
$result = $stmt->get_result();

$employees = [];
while ($row = $result->fetch_assoc()) {
    $employees[] = [
        'id'   => $row['emp_id'], 
        'text' => $row['emp_name'] . ' - ' . $row['emp_id'] 
    ];
}

echo json_encode($employees);
$conn->close();
?>
