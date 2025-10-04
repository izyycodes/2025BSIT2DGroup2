<?php
session_start();       // Start the session
session_unset();       // Remove all session variables
session_destroy();     // Destroy the session completely

// Redirect to homepage or login page after logout
header("Location: index.php?logout=success");
exit();
?>


