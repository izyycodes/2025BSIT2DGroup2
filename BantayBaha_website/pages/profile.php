<?php
  session_start();
  require 'conn.php';

  // Check if user is logged in
  if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit;
  }

  $user_id = $_SESSION['user']['id'];

  // Fetch latest user data from database
  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $user = $stmt->get_result()->fetch_assoc();

  // Assign values to variables for displaying
  $firstName  = $user['first_name'];
  $lastName   = $user['last_name'];
  $email      = $user['email_address'];
  $phone      = $user['phone_number'];
  $role       = $user['role'];
  $age        = $user['age'] ?? '';
  $gender     = $user['gender'] ?? 'Select gender';
  $address    = $user['address'] ?? '';
  $bloodType  = $user['blood_type'] ?? 'Select blood type';
  $conditions = $user['conditions'] ?? '';
  $medications = $user['medications'] ?? '';

  $initials = strtoupper($firstName[0] . $lastName[0]);

  /* --- Update Personal Info --- */
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-personal'])) {
      $fullName = trim($_POST['fullName']);
      $nameParts = explode(' ', $fullName, 2);
      $firstName = $nameParts[0];
      $lastName = $nameParts[1] ?? '';
      $age = $_POST['age'];
      $gender = $_POST['gender'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];

      $update = $conn->prepare("UPDATE users SET first_name=?, last_name=?, age=?, gender=?, address=?, phone_number=?, email_address=? WHERE id=?");
      $update->bind_param("ssissssi", $firstName, $lastName, $age, $gender, $address, $phone, $email, $user_id);
      $update->execute();

      $_SESSION['user']['first_name'] = $firstName;
      $_SESSION['user']['last_name'] = $lastName;
      $_SESSION['user']['email_address'] = $email;
      $_SESSION['user']['phone_number'] = $phone;

      header("Location: profile.php?personalinfo=saved");
      exit;
  }

  /* --- Update Medical Info --- */
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-medical'])) {
      $bloodType = $_POST['bloodType'];
      $conditions = $_POST['conditions'];
      $medications = $_POST['medications'];

      $update = $conn->prepare("UPDATE users SET blood_type=?, conditions=?, medications=? WHERE id=?");
      $update->bind_param("sssi", $bloodType, $conditions, $medications, $user_id);
      $update->execute();

      header("Location: profile.php?medicalinfo=saved");
      exit;
  }

  /* --- Add Contact --- */
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-contact'])) {
      $name = trim($_POST['contact_name']);
      $relationship = trim($_POST['relationship']);
      $contact = trim($_POST['contact_number']);

      if ($name && $relationship && $contact) {
          $insert = $conn->prepare("INSERT INTO emergency_contacts (user_id, name, relationship, contact) VALUES (?, ?, ?, ?)");
          $insert->bind_param("isss", $user_id, $name, $relationship, $contact);
          $insert->execute();
      }

      header("Location: profile.php?added=success");
      exit;
  }

  /* --- Update Contact --- */
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-contact'])) {
      $id = $_POST['contact_index'];
      $name = $_POST['contact_name'];
      $relationship = $_POST['relationship'];
      $contact = $_POST['contact_number'];

      $update = $conn->prepare("UPDATE emergency_contacts SET name=?, relationship=?, contact=? WHERE id=? AND user_id=?");
      $update->bind_param("sssii", $name, $relationship, $contact, $id, $user_id);
      $update->execute();

      header("Location: profile.php?edited=success");
      exit;
  }

  /* --- Delete Contact --- */
  if (isset($_GET['delete'])) {
      $id = $_GET['delete'];

      $delete = $conn->prepare("DELETE FROM emergency_contacts WHERE id=? AND user_id=?");
      $delete->bind_param("ii", $id, $user_id);
      $delete->execute();

      header("Location: profile.php?deleted=success");
      exit;
  }

  /* --- Update Profile Photo --- */
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change-photo'])) {
      if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
          $targetDir = "../assets/images/uploads/";
          if (!is_dir($targetDir)) {
              mkdir($targetDir, 0777, true);
          }

          $fileName = uniqid() . "_" . basename($_FILES['profile_photo']['name']);
          $targetFile = $targetDir . $fileName;
          $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

          $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

          if (in_array($fileType, $allowedTypes)) {
              if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $targetFile)) {
                  // Save to database
                  $stmt = $conn->prepare("UPDATE users SET profile_photo = ? WHERE id = ?");
                  $stmt->bind_param("si", $fileName, $user_id);
                  $stmt->execute();

                  header("Location: profile.php?photo=updated");
                  exit;
              } else {
                  echo "<script>alert('Error uploading file.');</script>";
              }
          } else {
              echo "<script>alert('Invalid file type. Only JPG, PNG, GIF allowed.');</script>";
          }
      }
  }

  /* --- Fetch Contacts --- */
  $contactsQuery = $conn->prepare("SELECT * FROM emergency_contacts WHERE user_id=?");
  $contactsQuery->bind_param("i", $user_id);
  $contactsQuery->execute();
  $contacts = $contactsQuery->get_result()->fetch_all(MYSQLI_ASSOC);
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
      <?php if (isset($_GET['photo']) && $_GET['photo'] === 'updated'): ?>
          <div style="background:#d4edda; color:#155724; padding:10px 15px; margin-bottom:15px; border-radius:5px; border:1px solid #c3e6cb; display:flex; align-items:center; justify-content:space-between; font-size:15px;">
            ✅ Profile photo updated successfully!
            <button 
              style="background:none; border:none; color:#155724; font-size:20px; cursor:pointer; line-height:1;" 
              onclick="this.parentElement.style.display='none'">
              ×
            </button>
          </div>
        <?php endif; ?>

      <!-- Profile Header -->
      <div class="profile-header">
        <div class="profile-pic">
          <div class="avatar">
            <?php if (!empty($user['profile_photo'])): ?>
              <img src="../assets/images/uploads/<?php echo htmlspecialchars($user['profile_photo']); ?>">
            <?php else: ?>
              <?php echo htmlspecialchars($initials); ?>
            <?php endif; ?>
          </div>
    
          <form method="POST" enctype="multipart/form-data" style="margin-top:10px;">
            <input type="file" name="profile_photo" accept="image/*" id="profile_photo" style="display:none;" onchange="this.form.submit()">
            <button type="button" class="change-photo-btn" onclick="document.getElementById('profile_photo').click()">Change Photo</button>
            <input type="hidden" name="change-photo" value="1">
          </form>
        </div> 
      
        <div class="profile-info">
          <h3>
            <?php echo htmlspecialchars($firstName) . " " . htmlspecialchars($lastName); ?>
            <span class="badge"><?php echo htmlspecialchars($role); ?></span>
          </h3>
          <div class="profile-stats">
            <div class="stats-item">
              <p style="font-weight:700; font-size:18px;">7</p>
              <p style="color:#666; font-size:14px;">Help Requests</p>
            </div>
            <div class="stats-item">
              <p style="font-weight:700; font-size:18px;">0</p>
              <p style="color:#666; font-size:14px;">Responses Given</p>
            </div>
            <div class="stats-item">
              <p style="font-weight:700; font-size:18px;">2</p>
              <p style="color:#666; font-size:14px;">Years Member</p>
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

          <?php if (isset($_GET['personalinfo']) && $_GET['personalinfo'] === 'saved'): ?>
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
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

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

            <?php foreach ($contacts as $contact): ?>
              <div class="contact-card">
                <div class="edit-card" id="display-<?php echo $contact['id']; ?>">
                  <p><b><?php echo $contact['name']; ?></b><br>
                  <?php echo $contact['relationship']; ?> - <?php echo $contact['contact']; ?></p>
                  <div style="display:flex; gap: 10px; font-size: 20px; color: #3d5a91;">
                    <a onclick="showEditForm(<?php echo $contact['id']; ?>)"><i class="ri-edit-2-fill"></i></i></a>
                    <a href="?delete=<?php echo $contact['id']; ?>" onclick="return confirm('Delete this contact?')"><i class="ri-delete-bin-6-fill"></i></a>
                  </div>
                </div>

                <!-- Hidden edit form -->
                <form method="POST" id="editForm-<?php echo $contact['id']; ?>" style="display:none; margin-top:10px;">
                  <input type="hidden" name="contact_index" value="<?php echo $contact['id']; ?>">
                  <label>Full Name:</label>
                  <input type="text" name="contact_name" value="<?php echo htmlspecialchars($contact['name']); ?>" required style="width:100%; margin-bottom:5px; padding:6px;">

                  <label>Relationship:</label>
                  <input type="text" name="relationship" value="<?php echo htmlspecialchars($contact['relationship']); ?>" required style="width:100%; margin-bottom:5px; padding:6px;">

                  <label>Contact Number:</label>
                  <input type="tel" pattern="^09[0-9]{9}$" name="contact_number" value="<?php echo htmlspecialchars($contact['contact']); ?>" required style="width:100%; margin-bottom:10px; padding:6px;">

                  <button type="submit" name="update-contact" class="save-btn">Save</button>
                  <button type="button" onclick="cancelEdit(<?php echo $contact['id']; ?>)" class="cancel-btn">Cancel</button>
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

      <?php if (isset($_GET['medicalinfo']) && $_GET['medicalinfo'] === 'saved'): ?>
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

      <!-- Scroll to top button -->
      <section>
          <i class="ri-arrow-drop-up-line scroll-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"></i>
      </section>

      <!-- Footer -->
      <?php require "../views/footer.php" ?>
  </div>

  <script src="../assets/js/profile.js"></script>
</body>
</html>