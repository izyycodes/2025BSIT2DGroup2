<?php
session_start();
// var_dump($_POST);
// var_dump($_SESSION);

// When personal info form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-personal'])) {
  $_SESSION['age']     = $_POST['age'];
  $_SESSION['gender']  = $_POST['gender'];
  $_SESSION['address'] = $_POST['address'];
  $_SESSION['phone']   = $_POST['phone'];
  $_SESSION['signup-email']   = $_POST['signup-email'];

  // Handle full name input
    if (!empty($_POST['fullName'])) {
        $fullName = trim($_POST['fullName']);
        $nameParts = explode(' ', $fullName, 2); // split into two parts only

        $_SESSION['firstName'] = $nameParts[0]; // first word = first name
        $_SESSION['lastName']  = $nameParts[1] ?? ''; // rest = last name (optional)
    }

  $personalSaved = true; // flag to show success message
}

// When medical info form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-medical'])) {
  $_SESSION['bloodType']   = $_POST['bloodType'];
  $_SESSION['conditions']  = $_POST['conditions'];
  $_SESSION['medications'] = $_POST['medications'];

  $medicalSaved = true; // flag to show success message
}

// Retrieve all session data (keep after reload)
$firstName  = $_SESSION['firstName'] ?? 'Juan';
$lastName   = $_SESSION['lastName'] ?? 'Dela Cruz';
$email      = $_SESSION['signup-email'] ?? 'juan@gmail.com';
$phone      = $_SESSION['phone'] ?? '09123456789';
$role       = $_SESSION['role'] ?? 'Resident';
$age        = $_SESSION['age'] ?? '';
$gender     = $_SESSION['gender'] ?? 'Select gender';
$address    = $_SESSION['address'] ?? '';

$bloodType  = $_SESSION['bloodType'] ?? 'Select blood type';
$conditions = $_SESSION['conditions'] ?? '';
$medications = $_SESSION['medications'] ?? '';

// Get the first letter of each name and make them uppercase
$initials = strtoupper($firstName[0] . $lastName[0]);

// Initialize the contacts array if it doesn’t exist
if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [
        ['name' => 'Maria Dela Cruz', 'relationship' => 'Spouse', 'contact' => '09182345678'],
        ['name' => 'Pedro Dela Cruz', 'relationship' => 'Father', 'contact' => '09193456789']
    ];
}

// Adds new contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-contact'])) {
    $name = trim($_POST['contact_name']);
    $relationship = trim($_POST['relationship']);
    $contact = trim($_POST['contact_number']);

    // Save into session (append)
    if ($name && $relationship && $contact) {
        $_SESSION['contacts'][] = [
            'name' => htmlspecialchars($name),
            'relationship' => htmlspecialchars($relationship),
            'contact' => htmlspecialchars($contact)
        ];
    }

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?') . "?added=success");
    exit;
}

// Edits existing contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-contact'])) {
    $index = $_POST['contact_index'];
    $name = trim($_POST['contact_name']);
    $relationship = trim($_POST['relationship']);
    $contact = trim($_POST['contact_number']);

    if (isset($_SESSION['contacts'][$index])) {
        $_SESSION['contacts'][$index] = [
            'name' => htmlspecialchars($name),
            'relationship' => htmlspecialchars($relationship),
            'contact' => htmlspecialchars($contact)
        ];
    }

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?') . "?edited=success");
    exit;
}

// Deletes contact
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];

    // Check if contact exists before deleting
    if (isset($_SESSION['contacts'][$index])) {
        array_splice($_SESSION['contacts'], $index, 1);
    }

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?') . "?deleted=success");
    exit;
}
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
        <div class="avatar"><?php echo htmlspecialchars($initials); ?></div>
        <div class="profile-info">
          <h3><?php echo htmlspecialchars($firstName). " " . htmlspecialchars($lastName); ?> <span class="badge"><?php echo htmlspecialchars($role); ?></span></h3>
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

          <?php if (isset($personalSaved) && $personalSaved): ?>
            <div style="background:#d4edda; color:#155724; padding:10px 15px; margin-bottom:10px; border-radius:5px; border:1px solid #c3e6cb; display:flex; align-items:center; justify-content:space-between; font-size:15px;">
              <span>✅ Personal information saved successfully!</span>
              <button 
                style="background:none; border:none; color:#155724; font-size:20px; cursor:pointer; line-height:1;" 
                onclick="this.parentElement.style.display='none'">
                ×
              </button>
            </div>  
          <?php endif; ?>

          <form id="personal-information" method="POST" action="profile.php">
            <label for="fullName">Full Name <span style="color: #dc3545;"> *</span></label>
            <input type="text" name="fullName" value="<?php echo htmlspecialchars($firstName) . " " . htmlspecialchars($lastName); ?>" required>

            <div class="row">
              <div>
                <label for="age">Age <span style="color: #dc3545;"> *</span></label>
                <input type="number" id="age" name="age" min="1" max="100" placeholder="Enter age" value="<?php echo htmlspecialchars($age); ?>" required>
              </div>
              <div>
                <label for="gender">Gender <span style="color: #dc3545;"> *</span></label>
                <select id="gender" name="gender" required>
                  <option value="" disabled selected <?php echo ($gender =="Select gender") ? "selected" : ""; ?>>Select gender</option>
                  <option value="Male" <?php if($gender == "Male") echo 'selected'; ?>>Male</option>
                  <option value="Female" <?php if($gender == "Female") echo 'selected'; ?>>Female</option>
                  <option value="Others" <?php if($gender == "Others") echo 'selected'; ?>>Others</option>
                </select>
              </div>
            </div>

            <label for="phone">Phone Number <span style="color: #dc3545;"> *</span></label>
            <input type="tel" pattern="^09[0-9]{9}$" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>

            <label for="email">Email Address <span style="color: #dc3545;"> *</span></label>
            <input type="email" name="signup-email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="address">Home Address <span style="color: #dc3545;"> *</span></label>
            <textarea id="address" name="address" rows="2" placeholder="Enter home address" required><?php echo htmlspecialchars($address); ?></textarea>

            <div class="btn-container">
              <button class="save-btn" type="submit" name="save-personal">Save</button>
            </div>
          </form>
        </div>

        <!-- Emergency Contacts -->
          <div class="card">
            <h4><i class="ri-contacts-fill"></i> Emergency Contacts</h4>

            <?php foreach ($_SESSION['contacts'] as $i => $contact): ?>
              <div class="contact-card">
                <div class="edit-card" id="display-<?php echo $i; ?>">
                  <p><b><?php echo $contact['name']; ?></b><br>
                  <?php echo $contact['relationship']; ?> - <?php echo $contact['contact']; ?></p>
                  <div style="display:flex; gap: 10px; font-size: 20px; color: #3d5a91;">
                    <a onclick="showEditForm(<?php echo $i; ?>)"><i class="ri-edit-2-fill"></i></i></a>
                    <a href="?delete=<?php echo $i; ?>" onclick="return confirm('Delete this contact?')"><i class="ri-delete-bin-6-fill"></i></a>
                  </div>
                </div>

                <!-- Hidden edit form -->
                <form method="POST" id="editForm-<?php echo $i; ?>" style="display:none; margin-top:10px;">
                  <input type="hidden" name="contact_index" value="<?php echo $i; ?>">
                  <label>Full Name:</label>
                  <input type="text" name="contact_name" value="<?php echo htmlspecialchars($contact['name']); ?>" required style="width:100%; margin-bottom:5px; padding:6px;">

                  <label>Relationship:</label>
                  <input type="text" name="relationship" value="<?php echo htmlspecialchars($contact['relationship']); ?>" required style="width:100%; margin-bottom:5px; padding:6px;">

                  <label>Contact Number:</label>
                  <input type="tel" pattern="^09[0-9]{9}$" name="contact_number" value="<?php echo htmlspecialchars($contact['contact']); ?>" required style="width:100%; margin-bottom:10px; padding:6px;">

                  <button type="submit" name="update-contact" class="save-btn">Save</button>
                  <button type="button" onclick="cancelEdit(<?php echo $i; ?>)" class="cancel-btn">Cancel</button>
                </form>
              </div>
            <?php endforeach; ?>

            <!-- Add Contact Button -->
            <div class="btn-container" style="text-align:center;">
              <button class="add-btn" id="showFormBtn">+ Add Emergency Contact</button>
            </div>

            <!-- Hidden Add Form -->
            <form method="POST" id="addContactForm" style="display:none; margin-top:15px;">
              <label for="contact_name">Full Name <span style="color: #dc3545;"> *</span></label>
              <input type="text" name="contact_name" required style="width:100%; margin-bottom:8px; padding:6px;">

              <label for="relationship">Relationship <span style="color: #dc3545;"> *</span></label>
              <input type="text" name="relationship" required style="width:100%; margin-bottom:8px; padding:6px;">

              <label for="contact_number">Contact Number <span style="color: #dc3545;"> *</span></label>
              <input type="tel" pattern="^09[0-9]{9}$" name="contact_number" required style="width:100%; margin-bottom:12px; padding:6px;">

              <div class="btn-container">
                <button type="submit" name="save-contact" class="save-btn">Save</button>
              </div>
            </form>
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

      <?php if (isset($medicalSaved) && $medicalSaved): ?>
        <div style="background:#d4edda; color:#155724; padding:10px 15px; margin-bottom:10px; border-radius:5px; border:1px solid #c3e6cb; display:flex; align-items:center; justify-content:space-between; font-size:15px;">
          <span>✅ Medical information saved successfully!</span>
          <button 
            style="background:none; border:none; color:#155724; font-size:20px; cursor:pointer; line-height:1;" 
            onclick="this.parentElement.style.display='none'">
            ×
          </button>
        </div>  
      <?php endif; ?>


      <form method="POST" action="">
        <label>Blood Type</label>
        <select name="bloodType">
          <option value="" disabled selected <?php echo ($bloodType=="Select blood type") ? "selected" : ""; ?>>Select blood type</option>
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

            <div class="btn-container">
              <button class="save-btn" type="submit" name="save-medical">Save</button>
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