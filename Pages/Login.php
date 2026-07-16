<?php
session_start();
include('../DB_Config/Config.php');

$db = new dbconfig();
$conn = $db->getConnection();

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emp_id = trim($_POST['email_id']);
    $password = trim($_POST['password']);

    $query = "SELECT email_id, emp_id, emp_name, password, access_key FROM xxits_ams_emp_det_t WHERE email_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $emp_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if ($password === $row['password']) {
        session_regenerate_id(true);
        $_SESSION['email_id']   = $row['email_id'];
        $_SESSION['emp_id']     = $row['emp_id'];
        $_SESSION['emp_name']   = $row['emp_name'];
        $_SESSION['access_key'] = $row['access_key'];

        header("Location: Asset_List.php");
        exit;
    } else {
        $errorMessage = "Invalid Employee ID or Password!";
    }
} else {
    $errorMessage = "Invalid Employee ID or Password!";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="../CSS/Style_login.php">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>
<body>
<div class="login-wrapper">
<p class="outside-text">🌟 Let your management shine — log in and take charge today 🌟</p>
<div class="login-container">
    <div class="logo">
        <img src="https://ilantechsolutions.com/assets/img/Logo/ITS-01.png" alt="Logo" width="100">
        <h3>Asset Management System</h3>
    </div>

    <h2 class="title">Login</h2>

    <form method="POST">
        <?php if (!empty($errorMessage)): ?>
            <div class="error"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
        <div class="form-group">
        <label>Employee Mail ID <span class="required">*</span></label>
        <input type="text" name="email_id" placeholder="Employee Mail ID" required 
               value="<?php echo htmlspecialchars($_POST['email_id'] ?? '') ?>">
        </div>
        <div class="form-group password-group">
    <label>Password <span class="required">*</span></label>
    <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <span class="toggle-password" onclick="togglePassword()">
            <i class="fas fa-eye" id="eyeIcon"></i>
        </span>
    </div>
</div>
        <p class="forgot-password">
            <a href="forgot_password.php">Forgot Password❔</a>
        </p>

        <button type="submit" class="submit-btn">Login</button>

        
    </form>
</div>
        </div>

</body>
<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");          
        eyeIcon.classList.add("fa-eye-slash");       
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
</script>


</html>