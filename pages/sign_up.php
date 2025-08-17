<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" 
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>

    <?php require "../views/index_navbar.php" ?>

    <div class="signup-container">
        <form action="../pages/home.php" id="signup-form">

            <h2>Sign Up</h2>

            <div class="form-row">
                <div class="form-column">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-column">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-column">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    <label for="password">Password</label>
                    <div class="password-box">
                        <input type="password" id="password" name="password" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword(this)"></i>
                    </div>
                </div>
                <div class="form-column">
                    <label for="role">Select Role</label>
                    <select name="role" id="role">
                        <option value="resident">Resident</option>
                        <option value="resident">Volunteer</option>
                        <option value="resident">Barangay Official</option>
                    </select>
                </div>
            </div>

            <div class="form-button"> 
                <button type="submit">Sign Up</button>
            </div>

            <div class="login-text">
                <p>Already have an account?</p> 
                <a href="../pages/login.php">Login</a>
            </div>
        </form>
    </div>

    <?php require "../views/footer.php" ?>

    <script src="../js/script.js"></script>
</body>
</html>