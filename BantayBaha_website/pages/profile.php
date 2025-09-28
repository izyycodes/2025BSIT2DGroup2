<?php
  session_start();
  // var_dump($_POST);
  // var_dump($_SESSION);

  $firstName   = $_SESSION['firstName']   ?? '';
  $lastName    = $_SESSION['lastName']    ?? '';
  $email       = $_SESSION['signup-email']?? '';
  $phoneNumber = $_SESSION['phone']       ?? '';
  $role        = $_SESSION['role']        ?? '';
  $age = $_POST['age'] ?? '';
  $gender = $_POST['gender'] ?? '';
  $address = $_POST['address'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Profile</title>
  <link rel="icon" type="image/ico" href="../assets/images/logo.png">

  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">

  <link rel="stylesheet" href="../assets/css/profile.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/sidebar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
  <?php require "../views/dashboard_navbar.php" ?>
  <?php require "../views/sidebar.php" ?>

  <div class="main-content">
    <section class="content">
      <!-- Profile Header -->
      <div class="profile-header">
        <div class="avatar">JD</div>
        <div class="profile-info">
          <h3><?php echo $firstName . " " . $lastName; ?> <span class="badge"><?php echo $role; ?></span></h3>
          <div class="profile-stats">
            <div class="stats-item">
              <p style="font-weight: 700; font-size: 18px;">7</p>
              <p style="color: #666; font-size: 14px;">Help Requests</p>
            </div>
            <div class="stats-item">
              <p style="font-weight: 700; font-size: 18px;">0</p>
              <p style="color: #666; font-size: 14px;">Responses Given</p>
            </div>
            <div class="stats-item">
              <p style="font-weight: 700; font-size: 18px;">2</p>
              <p style="color: #666; font-size: 14px;">Years Member</p>
            </div>
          </div>
          <span class="status online"><i class="ri-checkbox-blank-circle-fill"></i> Online & Available</span>
        </div>
      </div>

      <!-- Profile Sections -->
      <div class="grid-container">
        <!-- Personal Information -->
        <div class="card">
          <h4><i class="ri-user-3-fill"></i> Personal Information</h4>
          <form id="personal-information" method="POST" action="profile.php">
            <label>Full Name <span style="color: #dc3545;"> *</span></label>
            <input type="text" value="<?php echo $firstName . " " . $lastName; ?>" required>

            <div class="row">
              <div>
                <label for="age">Age <span style="color: #dc3545;"> *</span></label>
                <input type="number" id="age" name="age" min="1" placeholder="Enter age" value="<?php echo $age; ?>" required>
              </div>
              <div>
                <label for="gender">Gender <span style="color: #dc3545;"> *</span></label>
                <select id="gender" name="gender" value="<?php echo $gender; ?>" required>
                  <option value="" disabled selected>Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Others">Others</option>
                </select>
              </div>
            </div>

            <label for="phone">Phone Number <span style="color: #dc3545;"> *</span></label>
            <input type="text" name="phone" value="<?php echo $phoneNumber; ?>" required>

            <label for="email">Email Address <span style="color: #dc3545;"> *</span></label>
            <input type="email" name="email" value="<?php echo $email; ?>" required>

            <label for="address">Home Address <span style="color: #dc3545;"> *</span></label>
            <textarea id="address" name="address" rows="2" value="<?php echo $address; ?>" placeholder="Enter home address"></textarea>

            <div class="btn-container">
              <button class="save-btn" type="submit">Save</button>
            </div>
          </form>
        </div>

        <!-- Emergency Contacts -->
          <div class="card">
            <h4><i class="ri-contacts-fill"></i> Emergency Contacts</h4>
            <div class="contact-card">
              <p><b>Maria Dela Cruz</b><br>Spouse - +63 918 234 5678</p>
            </div>
            <div class="contact-card">
              <p><b>Pedro Dela Cruz</b><br>Father - +63 919 345 6789</p>
            </div>
            <div class="btn-container">
              <button class="add-btn">+ Add Emergency Contact</button>
            </div>
          </div>   
      </div>

      <!-- Medical Information + Notifications -->
      <div class="grid-container">
        <!-- Medical Info -->
        <div class="card">
          <h4><i class="ri-first-aid-kit-fill"></i> Medical Information</h4>
          <div class="alert-box">
            ⚠️ Important medical information for emergency responders
          </div>
          <form>
            <label>Blood Type</label>
            <select>
              <option>Select blood type</option>
              <option>A+</option><option>A-</option>
              <option>B+</option><option>B-</option>
              <option>AB+</option><option>AB-</option>
              <option>O+</option><option>O-</option>
            </select>

            <label>Medical Conditions</label>
            <textarea rows="2" placeholder="List any medical conditions..."></textarea>

            <label>Current Medications</label>
            <textarea rows="2" placeholder="List medications and dosages..."></textarea>
          </form>
        </div>

        <!-- Notifications -->
        <div class="card margin" id="notif-settings">
          <h4><i class="ri-notification-3-fill"></i> Notification Settings</h4>
          <div class="toggle-row">
            <div class="notif-settings">
              <p style="font-weight: 600; font-size: 16px;">Emergency Alerts</p>
              <p style="color: #666; font-size: 13px;">Critical flood warnings in your area</p>
            </div>
            <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
          </div>
          <div class="toggle-row">
            <div class="notif-settings">
              <p style="font-weight: 600; font-size: 16px;">Help Request Updates</p>
              <p style="color: #666; font-size: 13px;">Status updates on your help requests</p>
            </div>
            <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
          </div>
          <div class="toggle-row">
            <div class="notif-settings">
              <p style="font-weight: 600; font-size: 16px;">Weather Updates</p>
              <p style="color: #666; font-size: 13px;">Daily weather and flood forecasts</p>
            </div>
            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
          </div>
          <div class="toggle-row">
            <div class="notif-settings">
              <p style="font-weight: 600; font-size: 16px;">System Maintenance</p>
              <p style="color: #666; font-size: 13px;">Planned maintenance notifications</p>
            </div>
            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer -->
  <?php require "../views/footer.php" ?>
  </div>

  <script src="../assets/js/profile.js"></script>
</body>
</html>