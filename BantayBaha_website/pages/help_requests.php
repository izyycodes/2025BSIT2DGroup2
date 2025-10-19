<?php
session_start();

require 'conn.php'; // make sure database connection is included

if (isset($_POST['ajax']) && $_POST['ajax'] === '1') {
    $msg = trim($_POST['user-message'] ?? '');
    if ($msg !== '') {
        date_default_timezone_set('Asia/Manila');

        // Sanitize message
        $safeMsg = htmlspecialchars($msg);
        $time = date('Y-m-d H:i:s');

        // Optional: Get current logged in user ID (if available)
        $user_id = $_SESSION['user']['id'] ?? null;

        // Save message to DB
        $stmt = $conn->prepare("INSERT INTO help_messages (user_id, message, message_time) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $safeMsg, $time);
        $stmt->execute();

        // Also store temporarily in session (for instant feedback)
        $_SESSION['messages'][] = [
            'text' => $safeMsg,
            'time' => date('h:i A')
        ];

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'text' => $safeMsg,
            'time' => date('h:i A')
        ]);
        exit();
    }
    echo json_encode(['status' => 'error']);
    exit();
}

if (isset($_SESSION['user']['id'])) {
    $user_id = $_SESSION['user']['id'];
    $stmt = $conn->prepare("SELECT message, message_time FROM help_messages WHERE user_id = ? ORDER BY message_time ASC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $_SESSION['messages'] = []; // clear current session messages

    while ($row = $result->fetch_assoc()) {
        $_SESSION['messages'][] = [
            'text' => $row['message'],
            'time' => date('h:i A', strtotime($row['message_time']))
        ];
    }
}

// Check if form was confirmed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmSubmit'])) {

    // Collect form data
    $emergencyType = htmlspecialchars($_POST['emergencyType'] ?? '');
    $urgencyLevel = htmlspecialchars($_POST['urgencyLevel'] ?? '');
    $numPeople = htmlspecialchars($_POST['numPeople'] ?? '');
    $details = htmlspecialchars($_POST['details'] ?? '');

    // Redirect with success message
    header('Location: help_requests.php?help-request=success');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Help Requests</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/help_requests.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php require "../views/dashboard_navbar.php" ?>
    <?php require "../views/sidebar.php" ?>

    <div class="main-content">
        <div class="page-header margin">
            <div class="page-title">
                <i class="fa-solid fa-circle-question"></i>
                <h1>Help Requests</h1>
            </div>
            <p>Real-time water level monitoring and crossing point status for community safety</p>
        </div>

        <div class="help-banner margin">
            <div class="help-header">
                <i class="ri-circle-fill"></i>
                <p style="font-size: 18px;">Emergency services are active and ready to help</p>
            </div>
        </div>

        <div class="grid1 margin">
            <!-- Call for Help Button -->
            <div class="card" style="text-align: center;">
                <button class="emergency-button" id="emergencyBtn">
                    <div class="button-text">
                        <img src="../assets/images/help-bell.png" alt="help bell">
                        <p style="font-size: 20px; font-weight: 700;">CALL FOR HELP</p>
                        <p style="font-size: 14px; font-weight: normal;">Press & Hold</p>
                    </div>
                </button>
                <p style="margin-top: 30px;">Your location will be automatically shared with emergency responders</p>
            </div>

            <!-- Your Current Location -->
            <div class="card">
                <h3>📍 Your Current Location</h3>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.0837916690966!2d122.9626614745157!3d10.650598461503094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aed1b6d51c0973%3A0x56bf406758a5856d!2sHacienda%20sacio!5e0!3m2!1sen!2sph!4v1755414643945!5m2!1sen!2sph" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <!-- Emergency Details Form -->
        <div class="card margin" id="helpContainer" style="display: none;">
            <div class="emergency-header">
                <h3>📝 Emergency Details</h3>
                <i class="ri-close-line" id="closeBtn"></i>
            </div>
            
            <form class="help-container" id="helpForm" method="POST" action="">
                <div class="form-row">
                    <div class="form-column">
                        <label for="emergencyType">Type of Emergency <span style="color: #dc3545;"> *</span></label>
                        <select name="emergencyType" id="emergencyType" required>
                            <option value="" disabled selected>Select type of emergency</option>
                            <option value="Flood/Water Rising">Flood/Water Rising</option>
                            <option value="Trapped/Stranded">Trapped/Stranded</option>
                            <option value="Medical Emergency">Medical Emergency</option>
                            <option value="Need Evacuation">Need Evacuation</option>
                            <option value="Other Emergency">Other Emergency</option>
                        </select>
                    </div>
                    <div class="form-column">
                        <label for="urgencyLevel">Urgency Level <span style="color: #dc3545;"> *</span></label>
                        <select name="urgencyLevel" id="urgencyLevel" required>
                            <option value="" disabled selected>Select urgency level</option>
                            <option value="Low Priority">Low Priority</option>
                            <option value="Medium Priority">Medium Priority</option>
                            <option value="High Priority">High Priority</option>
                            <option value="Critical - Life Threatening">Critical - Life Threatening</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="numPeople">Number of People <span style="color: #dc3545;"> *</span></label>
                        <select name="numPeople" id="numPeople" required>
                            <option value="" disabled selected>Select number of people</option>
                            <option value="1 Person">1 Person</option>
                            <option value="2 People">2 People</option>
                            <option value="3 People">3 People</option>
                            <option value="4 People">4 People</option>
                            <option value="5+ People">5+ People</option>
                            <option value="Entire Family">Entire Family</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="details">Additional Details</label>
                        <textarea name="details" id="details" placeholder="Provide more information about your emergency situation..." rows="4" cols="30"></textarea>
                    </div>
                </div>

                <div class="submit-emergency-container">
                    <button type="submit" class="submit-emergency-button">SEND EMERGENCY REQUEST</button>
                </div>
            </form>
        </div>

         <div class="grid2 margin" id="messages">
            <!-- Help Confirmation Messages -->
            <div class="card">
                <h3>💬 Help Confirmation Messages</h3>
                <div class="message-container">

                    <!-- Alert Sent Successfully -->
                    <div class="status-indicator bg-green">
                        <div class="message">
                            <div class="icon" style="background-color: #22c55e;">
                                <i class="ri-check-line" style="font-weight: 600;"></i>
                            </div>
                            <div class="msg-info">
                                <div>
                                    <p style="color: #166534; font-size: 14px; font-weight: 600;">Alert Sent Successfully</p>
                                    <p style="color: #15803d; font-size: 12px;">Emergency services have been notified. Help is on the way.</p>
                                    <p class="msg-time">2 minutes ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Volunteer Responding -->
                    <div class="status-indicator bg-blue">
                        <div class="message">
                            <div class="icon" style="background-color: #3b82f6;">
                                <i class="ri-user-2-fill"></i>
                            </div>
                            <div class="msg-info">
                                <div>
                                    <p style="color: #1e40af; font-size: 14px; font-weight: 600;">Volunteer Responding</p>
                                    <p style="color: #1d4de8; font-size: 12px;">First aider from local community is en route (5 minutes away)</p>
                                    <p class="msg-time">1 minute ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Services Update -->
                    <div class="status-indicator bg-orange">
                        <div class="message">
                            <div class="icon" style="background-color: #f97316;">
                                <i class="ri-time-fill"></i>
                            </div>
                            <div class="msg-info">
                                <div>
                                    <p style="color: #9a3412; font-size: 14px; font-weight: 600;">Emergency Services Update</p>
                                    <p style="color: #c2410c; font-size: 12px;">Ambulance dispatched (ETA: 8 minutes) - Please remain where you are</p>
                                    <p class="msg-time">Just Now</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Services -->
                    <div class="status-indicator bg-green">
                        <div class="message">
                            <div class="icon" style="background-color: #22c55e;">
                                <i class="ri-shield-cross-fill"></i>
                            </div>
                            <div class="msg-info">
                                <div>
                                    <p style="color: #166534; font-size: 14px; font-weight: 600;">Emergency Services</p>
                                    <p style="color: #15803d; font-size: 12px;">Emergency team is 2 minutes away. Please stay positioned and follow instructions.</p>
                                    <p class="msg-time">Now</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User submitted messages -->
                    <?php if (!empty($_SESSION['messages'])): ?>
                        <?php foreach ($_SESSION['messages'] as $m): ?>
                            <div class="status-indicator bg-blue">
                                <div class="message">
                                    <div class="icon" style="background-color:#3b82f6;">
                                        <i class="ri-user-fill"></i>
                                    </div>
                                    <div class="msg-info">
                                        <p style="color:#1e40af;font-size: 14px;font-weight:600;">You</p>
                                        <p style="color:#1d4ed8;font-size: 12px;"><?php echo $m['text']; ?></p>
                                        <p class="msg-time"><?php echo $m['time']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Message Input Form -->
                <form class="type-msg" method="POST" action="">
                    <input type="text" name="user-message" placeholder="Type a message to responders..." required>
                    <button class="send-msg-btn">
                        <i class="ri-send-plane-fill"></i>
                    </button>
                </form>
            </div>

            <!-- Nearby Responders -->
            <div class="card">
                <h3>Nearby Responders</h3>
                <div class="volunteer-container">
                    <div class="volunteer-card">
                        <div class="volunteer-info">
                            <div class="volunteer-details">
                                <div class="volunteer-avatar">JS</div>
                                <div>
                                    <p style="font-weight: 600;">John Smith</p>
                                    <p style="font-size: 13px; color: #666;">First Aider</p>
                                </div>
                            </div>
                            <span class="status-badge available">Available</span>
                        </div>
                        <div class="location-info">
                            <i class="ri-map-pin-fill"></i>
                            <p style="font-size: 11px; color: #666;">2.3km away</p>
                        </div>
                    </div>
                    <div class="volunteer-card">
                        <div class="volunteer-info">
                            <div class="volunteer-details">
                                <div class="volunteer-avatar">SJ</div>
                                <div>
                                    <p style="font-weight: 600;">Sarah Johnson</p>
                                    <p style="font-size: 13px; color: #666;">Emergency Responder</p>
                                </div>
                            </div>
                            <span class="status-badge available">Available</span>
                        </div>
                        <div class="location-info">
                            <i class="ri-map-pin-fill"></i>
                            <p style="font-size: 11px; color: #666;">3.7km away</p>
                        </div>
                    </div>
                    <div class="volunteer-card">
                        <div class="volunteer-info">
                            <div class="volunteer-details">
                                <div class="volunteer-avatar">MD</div>
                                <div>
                                    <p style="font-weight: 600;">Mike Davis</p>
                                    <p style="font-size: 13px; color: #666;">Community Support</p>
                                </div>
                            </div>
                            <span class="status-badge responding">Responding</span>
                        </div>
                        <div class="location-info">
                            <i class="ri-map-pin-fill"></i>
                            <p style="font-size: 11px; color: #666;">4.1km away</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <div id="toast" class="toast"></div>

        <!-- Modal -->
        <div id="confirmModal" class="modal">
            <div class="modal-content">
                <h3>Confirm Your Help Request</h3>
                <div id="modalDetails"></div>
                <div class="modal-buttons">
                    <button class="modal-btn-cancel" id="cancelModal">Cancel</button>
                    <button class="modal-btn-confirm" id="confirmSubmit">Confirm</button>
                </div>
            </div>
        </div>

        <?php require "../views/footer.php" ?>
    </div>

    <script src="../assets/js/help_requests.js"></script>
</body>
</html>