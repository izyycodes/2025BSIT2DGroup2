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

  <div class="main-content">
    <section class="content">
      <!-- Profile Header -->
      <div class="profile-header">
        <div class="avatar">JD</div>
        <div class="profile-info">
          <h3>Juan Dela Cruz <span class="badge">Resident</span></h3>
          <p><b>7</b> Help Requests | <b>0</b> Responses Given | <b>2</b> Years Member</p>
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
            <input type="text" placeholder="Enter full name">

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
            <input type="text" placeholder="Enter phone number">

            <label>Email Address *</label>
            <input type="email" placeholder="Enter email address">

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
        <div class="card margin">
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