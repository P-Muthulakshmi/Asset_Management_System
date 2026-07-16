<?php
include('../DB_Config/Config.php');
$db = new dbconfig();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ticketNo = isset($_POST['ticket_no']) ? trim($_POST['ticket_no']) : '';
    $status   = isset($_POST['status']) ? trim($_POST['status']) : '';
    $fixedOn  = isset($_POST['fixed_on']) && !empty($_POST['fixed_on']) ? trim($_POST['fixed_on']) : null;

    if (empty($ticketNo) || empty($status)) {
        echo "<script>
                alert('Ticket number and status are required.');
                window.history.back();
              </script>";
        exit();
    }


    if (in_array(strtolower($status), ['open', 'in-progress'])) {
        $fixedOnFormatted = null;
    } elseif (strtolower($status) === 'completed') {
        if (empty($fixedOn)) {
            echo "<script>
                    alert('Fixed On date is required when status is Completed.');
                    window.history.back();
                  </script>";
            exit();
        }
        $fixedOnFormatted = date('Y-m-d', strtotime($fixedOn));
    } else {
        echo "<script>
                alert('Unknown status: " . htmlspecialchars($status) . "');
                window.history.back();
              </script>";
        exit();
    }

    $sql = "UPDATE xxits_ams_tck_det_t 
            SET status = ?, fixed_on = ? 
            WHERE ticket_no = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "<script>
                alert('❌ SQL Prepare failed: " . htmlspecialchars($conn->error) . "');
                window.history.back();
              </script>";
        exit();
    }

    $stmt->bind_param("sss", $status, $fixedOnFormatted, $ticketNo);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
                alert('✅ Ticket updated successfully.');
                window.location.href='../Pages/Ticket_Details.php';
              </script>";
    } else {
        echo "<script>
                alert('⚠️ No ticket updated. Ticket number may be incorrect or no changes were made.');
                window.location.href='../Pages/Ticket_Details.php';
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>
            alert('Invalid request method.');
            window.location.href='../Pages/Ticket_Details.php';
          </script>";
}
?>
