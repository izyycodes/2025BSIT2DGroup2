<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="icon" type="image/ico" href="../assets/images/logo.png">

  <!-- Remix Icon -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../assets/css/profile.css">
  <link rel="stylesheet" href="../assets/css/navbar.css">
  <link rel="stylesheet" href="../assets/css/sidebar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
  <!-- Navbar & Sidebar -->
  <?php require "../views/dashboard_navbar.php" ?>
  <?php require "../views/sidebar.php" ?>

  <?php
  $firstName = $_GET['firstName'] ?? "Juan";
  $lastName  = $_GET['lastName'] ?? "Dela Cruz";
  $email     = $_GET['signup-email'] ?? "juan@email.com";
  $phone     = $_GET['phone'] ?? "09123456789";
  $role      = $_GET['role'] ?? "Resident";
  ?>


  <div class="main-content">
    <section class="content">
      <!-- Profile Header -->
      <div class="profile-header">
  <div class="avatar">
    <?php echo strtoupper(substr($firstName,0,1) . substr($lastName,0,1)); ?>
  </div>
  <div class="profile-info">
    <h3><?php echo $firstName . " " . $lastName; ?> 
      <span class="badge"><?php echo ucfirst($role); ?></span>
    </h3>
    <p><b>0</b> Help Requests | <b>0</b> Responses Given | <b>New</b> Member</p>
    <span class="status online"><i class="ri-checkbox-blank-circle-fill"></i> Online & Available</span>
  </div>
</div>

      <!-- Profile Sections -->
      <div class="grid-container">
        <!-- Personal Information -->
        <div class="card">
          <h4><i class="ri-user-3-fill"></i> Personal Information</h4>
          <form>
            <label>Full Name *</label>
            <input type="text" value="<?php echo $firstName . ' ' . $lastName; ?>">

            <div class="row">
              <div>
                <label>Age *</label>
                <input type="number" placeholder="Enter age">
              </div>
              <div>
                <label>Gender *</label>
                <select>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>
              </div>
            </div>

            <label>Phone Number *</label>
            <input type="text" value="<?php echo $phone; ?>">

            <label>Email Address *</label>
            <input type="email" value="<?php echo $email; ?>">

            <label>Home Address *</label>
            <textarea rows="2" placeholder="Enter home address"></textarea>
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
          <button class="add-btn">+ Add Emergency Contact</button>
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

     <?php
        // Default values (before submit)
        $bloodType  = $_POST['bloodType'] ?? ($_GET['bloodType'] ?? "Select blood type");
        $conditions = $_POST['conditions'] ?? ($_GET['conditions'] ?? "");
        $medications = $_POST['medications'] ?? ($_GET['medications'] ?? "");

        // Show confirmation if saved
      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['save-medical'])) {
          echo "<div style='background:#d4edda; color:#155724; padding:10px; margin-bottom:10px; border-radius:5px;'>
              ✅ Medical information saved successfully!
                </div>";
        }
      ?>

      <form method="POST" action="">
        <label>Blood Type</label>
        <select name="bloodType">
          <option <?php echo ($bloodType=="Select blood type") ? "selected" : ""; ?>>Select blood type</option>
          <option value="A+" <?php if($bloodType=="A+") echo "selected"; ?>>A+</option>
          <option value="A-" <?php if($bloodType=="A-") echo "selected"; ?>>A-</option>
          <option value="B+" <?php if($bloodType=="B+") echo "selected"; ?>>B+</option>
          <option value="B-" <?php if($bloodType=="B-") echo "selected"; ?>>B-</option>
          <option value="AB+" <?php if($bloodType=="AB+") echo "selected"; ?>>AB+</option>
          <option value="AB-" <?php if($bloodType=="AB-") echo "selected"; ?>>AB-</option>
          <option value="O+" <?php if($bloodType=="O+") echo "selected"; ?>>O+</option>
          <option value="O-" <?php if($bloodType=="O-") echo "selected"; ?>>O-</option>
        </select>

        <label>Medical Conditions</label>
        <textarea name="conditions" rows="2" placeholder="List any medical conditions..."><?php echo htmlspecialchars($conditions); ?></textarea>

        <label>Current Medications</label>
        <textarea name="medications" rows="2" placeholder="List medications and dosages..."><?php echo htmlspecialchars($medications); ?></textarea>

        <br>
        <button type="submit" name="save-medical">💾 Save Medical Info</button>
      </form>
    </div>

        <!-- Notifications -->
        <div class="card">
          <h4><i class="ri-notification-3-fill"></i> Notification Settings</h4>
          <div class="toggle-row">
            <span>Emergency Alerts</span>
            <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
          </div>
          <div class="toggle-row">
            <span>Help Request Updates</span>
            <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
          </div>
          <div class="toggle-row">
            <span>Weather Updates</span>
            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
          </div>
          <div class="toggle-row">
            <span>System Maintenance</span>
            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer -->
  <?php require "../views/footer.php" ?>
  </div>
</body>
</html>