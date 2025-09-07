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
        <form id="login-form">

            <h2>LOGIN</h2>

            <div class="form-group">
                <label for="login-email">Email Address</label>
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="login-email" name="login-email" placeholder="example@gmail.com" required>
                </div>
            </div>

            <div class="form-group">
                <label for="login-password">Password</label>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="login-password" name="login-password" required>
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

    <script src="../assets/js/login.js"></script>
</body>
</html>
