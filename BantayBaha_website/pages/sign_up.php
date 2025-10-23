<?php
    session_start();
    require 'conn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email_address'];
        $phone = $_POST['phone_number'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        // Check if email already exists
        $checkEmail = $conn->prepare("SELECT * FROM users WHERE email_address = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $result = $checkEmail->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email already exists! Try logging in.'); window.location.href='login.php';</script>";
            exit;
        }

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email_address, phone_number, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $password, $role);

        if ($stmt->execute()) {
            // Retrieve the new user record
            $newUserId = $stmt->insert_id;
            $getUser = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $getUser->bind_param("i", $newUserId);
            $getUser->execute();
            $userResult = $getUser->get_result();
            $user = $userResult->fetch_assoc();

            // Set session with user data
            $_SESSION['user'] = [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email_address' => $user['email_address'],
                'phone_number' => $user['phone_number'],
                'role' => $user['role']
            ];

            header("Location: dashboard.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c835d6c14b.js" crossorigin="anonymous"></script>    
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

    <div class="signup-container">
        <form method="POST" action="sign_up.php" id="signup-form">
            <h2>Sign Up</h2>

            <div class="form-row">
                <div class="form-column">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-column">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    <label for="email_address">Email Address</label>
                    <input type="email" id="email_address" name="email_address" required>
                </div>
                <div class="form-column">
                    <label for="phone_number">Phone Number</label>
                    <input type="tel" pattern="^09[0-9]{9}$" id="phone_number" name="phone_number" required>
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
                    <select name="role" id="role" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="Resident">Resident</option>
                        <option value="Volunteer">Volunteer</option>
                        <option value="Barangay Official">Barangay Official</option>
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

    <!-- Scroll to top button -->
    <section>
        <i class="ri-arrow-drop-up-line scroll-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"></i>
    </section>

    <?php require "../views/footer.php" ?>

    <script>
        // Toggle password 
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
    </script>
</body>
</html>