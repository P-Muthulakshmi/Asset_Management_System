<?php
include('../DB_Config/Config.php');
$db = new dbconfig();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ref         = $_POST['asset_ref_no'] ?? '';
    $emp_name    = $_POST['employee_name'] ?? '';
    $assign_date_input = $_POST['assign_date'] ?? '';

    if ($ref && $emp_name && $assign_date_input) {

        if (preg_match('/^(.*?)\s+ITS\s+-\s+\d+$/', $emp_name, $matches)) {
            $emp_name = trim($matches[1]); 
        }

        $date_obj = DateTime::createFromFormat('d-M-Y', $assign_date_input);
        if ($date_obj) {
            $assign_date = $date_obj->format('Y-m-d');
        } else {
            $assign_date = date('Y-m-d');
        }

        $sql = "UPDATE xxits_ams_asset_det_t 
                SET emp_name = ?, assign_date = ?, status = 'Assigned',
                    last_updated_by = -1, last_update_date = CURDATE(), last_update_login = 1001 
                WHERE asset_ref_no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $emp_name, $assign_date, $ref);

        if ($stmt->execute()) {

            $sql_hist = "INSERT INTO xxits_ams_asset_trans_hist_t (
                asset_ref_no, emp_name, assign_date, action,
                attribute_category, attribute1, attribute2, attribute3, attribute4, attribute5,
                attribute6, attribute7, attribute8, attribute9, attribute10,
                attribute11, attribute12, attribute13, attribute14, attribute15,
                created_by, creation_date, last_updated_by, last_update_date, last_update_login
            ) VALUES (
                ?, ?, ?, 'Assigned',
                '', 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0,
                0, 0, 0, 0, 0,
                -1, CURDATE(), -1, CURDATE(), 1001
            )";

            $stmt_hist = $conn->prepare($sql_hist);
            $stmt_hist->bind_param("sss", $ref, $emp_name, $assign_date);
            $stmt_hist->execute();

            header("Location: ../Pages/Transaction_History.php?ref=" . urlencode($ref) . "&status=success");
            exit();

        } else {
            echo "Error assigning asset: " . $conn->error;
        }

    } else {
        echo "Missing required fields.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
