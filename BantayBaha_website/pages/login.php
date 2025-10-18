<?php 
    session_start();

    if (isset($_GET['redirect'])) {
        $_SESSION['redirectAfterLogin'] = $_GET['redirect'];
    }
    require 'conn.php';

    $error = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email_address'];
        $password = $_POST['password'];

        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email_address = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if email exists
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password using password_verify()
            if (password_verify($password, $user['password'])) {
                // Store user info in session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email_address' => $user['email_address'],
                    'phone_number' => $user['phone_number'],
                    'password' => $user['password'],
                    'role' => $user['role']
                ];

                // Get redirect target from session or default
                $redirectPage = $_SESSION['redirectAfterLogin'] ?? 'dashboard.php';

                // Clear the redirect value to prevent loops
                unset($_SESSION['redirectAfterLogin']);

                // Prevent redirecting to login/signup pages
                if (strpos($redirectPage, 'login.php') !== false || strpos($redirectPage, 'signup.php') !== false) {
                    $redirectPage = 'dashboard.php';
                }

                // Redirect
                header("Location: $redirectPage");
                exit;
            } else {
                $error = "Wrong password! Try again or <span id='forgot-password-link' style='color:#1386b3; cursor:pointer; text-decoration:underline;'>Forgot password</span> to reset it.";
            }
        } else {
            echo "<script>alert('Account not found! Please sign up.'); window.location.href='sign_up.php';</script>";
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" 
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>

    <?php require "../views/index_navbar.php" ?>

    <button class="back-button">
        <a href="../pages/index.php">
            <i class="ri-arrow-left-line"></i>
            Back
        </a>
    </button>
    
    <div class="login-container">
        <form id="login-form" method="POST" action="">

            <h2>LOGIN</h2>

            <div class="form-group">
                <label for="email_address">Email Address <span style="color: #dc3545;"> *</span></label>
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email_address" name="email_address" placeholder="example@gmail.com" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password <span style="color: #dc3545;"> *</span></label>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword(this)"></i>
                </div>
            </div>

            <!-- Error message -->
            <p id="error-msg"></p>

            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a onclick="resetPassword()" id="forgot-pass">Forgot Password?</a>
            </div>

            <div class="form-button">
                <button type="submit">Login</button>
            </div>

            <div class="register-text">
                <p>Don’t have an account?</p>
                <a href="../pages/sign_up.php">Register Now!</a>
            </div>
        </form>
    </div>

    <?php require "../views/footer.php" ?>

    <script>
        const errorMessage = document.getElementById("error-msg");
        const forgotPassword = document.getElementById("forgot-pass");

        // Handle password toggle
        function togglePassword(icon) {
            const passwordField = icon.previousElementSibling;
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        // Handle forgot password click
        function resetPassword() {
            alert("Your password has been reset! Enter your new password now.");
            document.getElementById("login-form").reset();
            errorMessage.style.display = "none";
        }

        // Get PHP error message (if any)
        <?php if (!empty($error)) : ?>
            errorMessage.style.display = "block";
            errorMessage.innerHTML = `<?= $error ?>`;
            const forgotLink = document.getElementById("forgot-password-link");
            if (forgotLink) {
                forgotLink.addEventListener("click", resetPassword);
            }
        <?php endif; ?>
        </script>
</body>
</html>
