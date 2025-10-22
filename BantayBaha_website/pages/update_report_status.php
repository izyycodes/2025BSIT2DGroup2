<?php
require 'conn.php';

if (isset($_POST['report_id']) && isset($_POST['status'])) {
    $reportId = $_POST['report_id'];
    $newStatus = $_POST['status'];

    $sql = "UPDATE community_reports SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newStatus, $reportId);

    if ($stmt->execute()) {
        header("Location: community_reports.php?update=success");
        exit();
    } else {
        echo "Error updating status: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}
?>
