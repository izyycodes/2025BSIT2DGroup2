<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">
    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" 
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://kit.fontawesome.com/c835d6c14b.js" crossorigin="anonymous"></script>    
    
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

    <div class="signup-container">

    <form id="signup-form" method="POST" action="signup_process.php">
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
                    <label for="firstName">First Name <span style="color: #dc3545;"> *</span></label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-column">
                    <label for="lastName">Last Name <span style="color: #dc3545;"> *</span></label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    <label for="email">Email Address <span style="color: #dc3545;"> *</span></label>
                    <input type="email" id="signup-email" name="signup-email" required>
                </div>
                <div class="form-column">
                    <label for="phone">Phone Number <span style="color: #dc3545;"> *</span></label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
            </div>
        </div>

        <div class="form-button"> 
            <button type="submit">Sign Up</button>
        </div>

                <div class="login-text">
                    <p>Already have an account?</p> 
                    <a href="../pages/login.php">Login</a>
                </div>
            <div class="form-row">
                <div class="form-column">
                    <label for="password">Password <span style="color: #dc3545;"> *</span></label>
                    <div class="password-box">
                        <input type="password" id="signup-password" name="signup-password" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword(this)"></i>
                    </div>
                </div>
                <div class="form-column">
                    <label for="role">Select Role <span style="color: #dc3545;"> *</span></label>
                    <select name="role" id="role">
                        <option value="resident">Resident</option>
                        <option value="volunteer">Volunteer</option>
                        <option value="barangayOfficial">Barangay Official</option>
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

    <?php require "../views/footer.php" ?>

    <script src="../assets/js/sign_up.js"></script>
</body>
</html>