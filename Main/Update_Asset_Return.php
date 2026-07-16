<?php
include('../DB_Config/Config.php');
$db = new dbconfig();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trans_id = $_POST['trans_id'] ?? '';
    $asset_ref_no = $_POST['asset_ref_no'] ?? '';

    if ($trans_id && $asset_ref_no) {
        
        $update_hist = "UPDATE xxits_ams_asset_trans_hist_t 
                        SET return_date = CURDATE(), last_updated_by = -1, 
                            last_update_date = CURDATE(), last_update_login = 1001 
                        WHERE trans_id = ?";
        $updateStmt = $conn->prepare($update_hist);
        $updateStmt->bind_param("i", $trans_id);
        $updateStmt->execute();
        $updateStmt->close();

        
        $check = "SELECT COUNT(*) AS cnt FROM xxits_ams_asset_trans_hist_t 
                  WHERE asset_ref_no = ? AND return_date = '0000-00-00'";
        $stmt = $conn->prepare($check);
        $stmt->bind_param("s", $asset_ref_no);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($result['cnt'] == 0) {
            $sql = "UPDATE xxits_ams_asset_det_t 
                    SET return_date = CURDATE(), status = 'Available', 
                        last_updated_by = -1, last_update_date = CURDATE(), last_update_login = 1001 
                    WHERE asset_ref_no = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $asset_ref_no);
            $stmt->execute();
            $stmt->close();
        }

        header("Location: ../Pages/Transaction_History.php?ref=" . urlencode($asset_ref_no) . "&status=returned");
exit();

    } else {
        echo "❌ Missing required fields.";
    }
} else {
    echo "❌ Invalid request.";
}
$conn->close();
?>