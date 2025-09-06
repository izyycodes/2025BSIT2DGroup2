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
                <h2><i class="ri-notification-3-line"></i> Notifications</h2>
                <span class="unread-count">3 unread notifications</span>
                <button class="mark-read">Mark All Read</button>
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
                    <div class="card-icon"><i class="ri-error-warning-line"></i></div>
                    <div class="card-content">
                        <h3>Flash Flood Warning <span class="urgent">URGENT</span></h3>
                        <p>Severe flooding detected in Point 1. Water level: 3.2m above normal.</p>
                        <small><i class="ri-map-pin-line"></i> Crossing Point 1 • 2 minutes ago</small>
                    </div>
                </div>

                <div class="notification-card warning unread">
                    <div class="card-icon"><i class="ri-water-flash-line"></i></div>
                    <div class="card-content">
                        <h3>Rising Water Levels</h3>
                        <p>Water levels in Point 2 have increased by 15cm in the last hour.</p>
                        <small><i class="ri-map-pin-line"></i> Crossing Point 2 • 15 minutes ago</small>
                    </div>
                </div>

                <div class="notification-card info unread">
                    <div class="card-icon"><i class="ri-community-line"></i></div>
                    <div class="card-content">
                        <h3>Community Emergency Report</h3>
                        <p>Barangay Captain reports: "Water level rising due to heavy rain upstream."</p>
                        <small><i class="ri-map-pin-line"></i> Crossing Point 2 • 10 minutes ago</small>
                    </div>
                </div>

                <div class="notification-card success">
                    <div class="card-icon"><i class="ri-check-line"></i></div>
                    <div class="card-content">
                        <h3>Water Levels Normalizing</h3>
                        <p>Flood waters have receded to safe levels. All clear issued.</p>
                        <small><i class="ri-map-pin-line"></i> Isabela, Negros Occidental • 1 hour ago</small>
                    </div>
                </div>

                <div class="notification-card warning">
                    <div class="card-icon"><i class="ri-cloud-rain-line"></i></div>
                    <div class="card-content">
                        <h3>Heavy Rainfall Alert</h3>
                        <p>Moderate to heavy rainfall expected in the next 6 hours. Monitor conditions.</p>
                        <small><i class="ri-map-pin-line"></i> Isabela, Negros Occidental • 5 hours ago</small>
                    </div>
                </div>
            </div>
        </div>

        <?php require "../views/footer.php" ?>
    </div>

    <!-- Filtering Script -->
    <script>
        const filters = document.querySelectorAll('#filter-list li');
        const notifications = document.querySelectorAll('.notification-card');

        filters.forEach(filter => {
            filter.addEventListener('click', () => {
                // Remove active class from all filters
                filters.forEach(f => f.classList.remove('active'));
                filter.classList.add('active');

                const filterValue = filter.getAttribute('data-filter');

                notifications.forEach(notification => {
                    if (filterValue === 'all') {
                        notification.style.display = 'flex';
                    } else if (notification.classList.contains(filterValue)) {
                        notification.style.display = 'flex';
                    } else {
                        notification.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
