<?php
// Get POST values
$firstName = $_POST['firstName'] ?? '';
$lastName  = $_POST['lastName'] ?? '';
$email     = $_POST['signup-email'] ?? '';
$phone     = $_POST['phone'] ?? '';
$role      = $_POST['role'] ?? '';

// Redirect to profile.php with GET parameters
header("Location: profile.php?firstName=" . urlencode($firstName) .
                     "&lastName=" . urlencode($lastName) .
                     "&signup-email=" . urlencode($email) .
                     "&phone=" . urlencode($phone) .
                     "&role=" . urlencode($role));
exit;
?>