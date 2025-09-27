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
        <div class="avatar">JD</div>
        <div class="profile-info">
          <h3>Juan Dela Cruz <span class="badge">Resident</span></h3>
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
          <form>
            <label>Full Name *</label>
            <input type="text" value="<?php echo $firstName . ' ' . $lastName; ?>">
          <form id="personal-information">
            <label for="fullName">Full Name <span style="color: #dc3545;"> *</span></label>
            <input type="text" id="fullName" name="fullName" placeholder="Enter full name" required>

            <div class="row">
              <div>
                <label for="age">Age <span style="color: #dc3545;"> *</span></label>
                <input type="number" id="age" name="age" min="1" placeholder="Enter age" required>
              </div>
              <div>
                <label for="gender">Gender <span style="color: #dc3545;"> *</span></label>
                <select id="gender" name="gender" required>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="others">Others</option>
                </select>
              </div>
            </div>

            <label>Phone Number *</label>
            <input type="text" value="<?php echo $phone; ?>">

            <label>Email Address *</label>
            <input type="email" value="<?php echo $email; ?>">
            <label for="number">Phone Number <span style="color: #dc3545;"> *</span></label>
            <input type="text" id="number" name="number" placeholder="Enter phone number" required>

            <label for="email">Email Address <span style="color: #dc3545;"> *</span></label>
            <input type="email" id="email" name="email" placeholder="Enter email address" required>

            <label for="address">Home Address <span style="color: #dc3545;"> *</span></label>
            <textarea id="address" name="address" rows="2" placeholder="Enter home address"></textarea>

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
          <form id="medical-information"> 
            <label for="bloodType">Blood Type <span style="color: #dc3545;"> *</span></label>
            <select id="bloodType" name="bloodType" required> 
              <option value="">Select blood type</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
            </select>

            <label for="medcon">Medical Conditions</label>
            <textarea id="medcon" name="medcon" rows="2" placeholder="List any medical conditions..."></textarea>

            <label for="medications">Current Medications</label>
            <textarea id="medications" name="medications" rows="2" placeholder="List medications and dosages..."></textarea>
          
            <div class="btn-container">
              <button class="save-btn" type="submit">Save</button>
            </div>
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