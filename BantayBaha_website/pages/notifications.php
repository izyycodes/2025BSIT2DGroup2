<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/notifications.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php require "../views/dashboard_navbar.php" ?>
    <?php require "../views/sidebar.php" ?>

    <div class="main-content">
        <div class="notifications-container">
            <div class="notifications-header">
                <div class="notifications">
                    <div class="notif-icon">
                        <i class="ri-notification-3-line"></i>
                    </div>
                    <div class="notif-info">
                        <h3>Notifications</h3>
                        <p style="color: #666; font-size: 16px;">3 unread notifications</p>
                    </div>
                </div>
                <div class="notif-side">
                    <button id="mark-all-read" class="mark-all-read">Mark All Read</button>
                    <a href="../pages/profile.php #notif-settings"><i class="ri-settings-4-line"></i></a>
                </div>
            </div>

            <!-- Filters -->
            <div class="filter-box">
                <h4><i class="ri-filter-3-line"></i> Filters</h4>
                <ul id="filter-list">
                    <li data-filter="all" class="active">All Notifications <span>5</span></li>
                    <li data-filter="unread">Unread <span>3</span></li>
                    <li data-filter="critical">Critical <span>1</span></li>
                    <li data-filter="warning">Warnings <span>2</span></li>
                    <li data-filter="info">Information <span>1</span></li>
                    <li data-filter="success">Success <span>1</span></li>
                </ul>
            </div>

            <!-- Notifications -->
            <div class="notifications-list" id="notifications-list">
                <div class="notification-card critical unread">
                    <div class="card-content">
                        <div class="card-icon" style="color: #e74c3c;"><i class="ri-error-warning-line"></i></div>
                        <div class="notif-text">
                            <h3>Flash Flood Warning <span class="urgent">URGENT</span> <span class="unread-indicator"></span></h3>
                            <p>Severe flooding detected in Point 1. Water level: 3.2m above normal.</p>
                            <small><i class="ri-map-pin-line"></i> Crossing Point 1 • 2 minutes ago</small>
                        </div>
                    </div>
                    <div class="close-btn">
                        <i class="ri-close-fill"></i>
                    </div>
                </div>

                <div class="notification-card warning unread">
                    <div class="card-content">
                        <div class="card-icon" style="color: #f39c12;"><i class="ri-water-flash-line"></i></div>
                        <div>
                            <h3>Rising Water Levels <span class="unread-indicator"></span></h3>
                            <p>Water levels in Point 2 have increased by 15cm in the last hour.</p>
                            <small><i class="ri-map-pin-line"></i> Crossing Point 2 • 15 minutes ago</small>
                        </div>
                    </div>
                    <div class="close-btn">
                        <i class="ri-close-fill"></i>
                    </div>
                </div>

                <div class="notification-card info unread">
                    <div class="card-content">
                        <div class="card-icon" style="color: #3498db;"><i class="ri-community-line"></i></div>
                        <div>
                            <h3>Community Emergency Report <span class="unread-indicator"></span></h3>
                            <p>Barangay Captain reports: "Water level rising due to heavy rain upstream."</p>
                            <small><i class="ri-map-pin-line"></i> Crossing Point 2 • 10 minutes ago</small>
                        </div>
                    </div>
                    <div class="close-btn">
                        <i class="ri-close-fill"></i>
                    </div>
                </div>

                <div class="notification-card success">
                    <div class="card-content">
                        <div class="card-icon" style="color: #2ecc71;"><i class="ri-check-line"></i></div>
                        <div>
                            <h3>Water Levels Normalizing</h3>
                            <p>Flood waters have receded to safe levels. All clear issued.</p>
                            <small><i class="ri-map-pin-line"></i> Isabela, Negros Occidental • 1 hour ago</small>
                        </div>
                    </div>
                    <div class="close-btn">
                        <i class="ri-close-fill"></i>
                    </div>
                </div>

                <div class="notification-card warning">
                    <div class="card-content">
                        <div class="card-icon" style="color: #f39c12;"><i class="ri-error-warning-line"></i></div>
                        <div>
                            <h3>Heavy Rainfall Alert</h3>
                            <p>Moderate to heavy rainfall expected in the next 6 hours. Monitor conditions.</p>
                            <small><i class="ri-map-pin-line"></i> Isabela, Negros Occidental • 5 hours ago</small>
                        </div>
                    </div>
                    <div class="close-btn">
                        <i class="ri-close-fill"></i>
                    </div>
                </div>
            </div>

             <div id="no-notifications" class="no-notifications" style="display: none;">
                <div class="empty-state">
                    <i class="ri-notification-2-line"></i>
                    <h3>No notifications</h3>
                    <p style="color: #666;">No unread notifications to display.</p>
                </div>
            </div>
        </div>

        <?php require "../views/footer.php" ?>
    </div>

    <script src="../assets/js/notifications.js"></script>
</body>
</html>
