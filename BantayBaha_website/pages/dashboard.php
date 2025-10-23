<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c835d6c14b.js" crossorigin="anonymous"></script>

    <!-- Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>

    <?php require "../views/dashboard_navbar.php" ?>
    <?php require "../views/sidebar.php" ?>

    <div class="main-content">
        <div class="alert-banner">
            <p style="font-size: 18px;"><strong>🚨 FLOOD ALERT:</strong> High water levels detected at Crossing Point 3. Exercise extreme caution!</p>
        </div>

        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.0837916690966!2d122.9626614745157!3d10.650598461503094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aed1b6d51c0973%3A0x56bf406758a5856d!2sHacienda%20sacio!5e0!3m2!1sen!2sph!4v1755414643945!5m2!1sen!2sph" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
        <div class="dashboard-grid">
            <!-- Live River Status -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/river-status.png" alt="river status" class="river-status">
                    </div>
                    <h3>Live River Status</h3>
                </div>
                <div class="small-map-container">

                    <div id="map"></div>
                </div>
                <!-- Point 1: Safe to Cross -->
                <div class="status-indicator">
                    <div class="status-dot safe"></div>
                    <span>Point 1: Safe to Cross (0.5m)</span>
                </div>
                <!-- Point 2: Use Caution -->
                <div class="status-indicator">
                    <div class="status-dot caution"></div>
                    <span>Point 2: Use Caution (1.2m)</span>
                </div>
                <!-- Point 3: Impassable -->
                <div class="status-indicator">
                    <div class="status-dot danger"></div>
                    <span>Point 3: Impassable (2.1m)</span>
                </div>
                <div class="action-buttons">
                    <a href="../pages/river_monitoring.php#river-map" class="btn btn-primary">
                        <img src="../assets/images/location.png" alt="location">
                        View Full Map
                    </a>
                    <a href="../pages/river_monitoring.php" class="btn btn-success">
                        <img src="../assets/images/stats.png" alt="stats">
                        Water Levels
                    </a>
                </div>
            </div>

            <!-- Community Reports -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/reports.png" alt="reports" class="reports">
                    </div>
                    <h3>Community Reports</h3>
                </div>
                <div class="quick-stats">
                    <div class="stat-box">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Today</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">85</div>
                        <div class="stat-label">This Week</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">3</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
                <div class="recent-activity">
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #4CAF50;">
                            <i class="ri-check-line"></i>
                        </div>
                        <div class="activity-details">
                            <strong>Maria Santos</strong>
                            reported safe crossing at Point 1.
                            <br>
                            <small style="color: #666;">5 minutes ago</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #ff9800;">
                            <i class="ri-alert-line"></i>
                        </div>
                        <div class="activity-details">
                            <strong>Juan dela Cruz</strong>
                            reported rising water at Point 2.
                            <br>
                            <small style="color: #666;">15 minutes ago</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #f44336;">
                            <i class="ri-close-line"></i>
                        </div>
                        <div class="activity-details">
                            <strong>Ana Reyes</strong>
                            confirmed impassable at Point 3.
                            <br>
                            <small style="color: #666;">32 minutes ago</small>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <a href="../pages/submit_new_report.php" class="btn btn-primary">
                        <img src="../assets/images/file-pen.png" alt="file pen">
                        Submit Report
                    </a>
                    <a href="../pages/community_reports.php#verify-reports" class="btn btn-success">
                        <img src="../assets/images/check.png" alt="check">
                        Verify Reports
                    </a>
                    <a href="../pages/community_reports.php" class="btn btn-warning">
                        <img src="../assets/images/graph.png" alt="graph">
                        View All
                    </a>
                </div>
            </div>

            <!-- Flood Forecast -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/forecast.png" alt="forecast" class="forecast">
                    </div>
                    <h3>Flood Forecast</h3>
                </div>
                <div class="metric">
                    <span>Rainfall (24h)</span>
                    <span class="metric-value">45mm</span>
                </div>
                <div class="metric">
                    <span>Risk Level</span>
                    <span class="metric-value">Moderate</span>
                </div>
                <div class="metric">
                    <span>Next Update</span>
                    <span class="metric-value">2:00 PM</span>
                </div>
                <div class="weather-advisory">
                    <strong>Weather Advisory:</strong>
                    Heavy rainfall expected from 6-8 PM. Monitor river levels closely.
                </div>
                <div class="action-buttons">
                    <a href="../pages/flood_alerts.php#forecast" class="btn btn-warning">
                        <img src="../assets/images/stats.png" alt="stats">
                        Detailed Forecast
                    </a>
                    <a href="../pages/flood_alerts.php#alerts"  class="btn btn-primary">
                        <img src="../assets/images/bell.png" alt="bell">
                        View Alerts
                    </a>
                </div>
            </div>

            <!-- Help Requests -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/help.png" alt="help" class="help">
                    </div>
                    <h3>Help Requests</h3>
                </div>
                <div class="metric">
                    <span>Active Requests</span>
                    <span class="metric-value" style="color: #f44336;">2</span>
                </div>
                <div class="metric">
                    <span>Volunteers Available</span>
                    <span class="metric-value" style="color: #4CAF50;">8</span>
                </div>
                <div class="metric">
                    <span>Response Time (Avg)</span>
                    <span class="metric-value">4 mins</span>
                </div>
                <div class="recent-activity">
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #f44336;">
                            <i class="ri-alarm-warning-fill"></i>
                        </div>
                        <div class="activity-details">
                            <strong>Emergency:</strong>
                            Family stranded at Point 3.
                            <br>
                            <small style="color: #666;">2 volunteers responding</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: #4CAF50;">
                            <i class="ri-check-line"></i>
                        </div>
                        <div class="activity-details">
                            <strong>Resolved:</strong>
                            Medical assistance completed.
                            <br>
                            <small style="color: #666;">45 minutes ago</small>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <a href="../pages/help_requests.php" class="btn btn-danger">
                        <i class="ri-alarm-warning-fill"></i>
                        Call for Help
                    </a>
                    <a href="../pages/help_requests.php#messages" class="btn btn-primary">
                        <img src="../assets/images/users.png" alt="users">
                        Send Message
                    </a>
                </div>
            </div>
        
        </div>

         <!-- Scroll to top button -->
        <section>
            <i class="ri-arrow-drop-up-line scroll-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"></i>
        </section>

        <?php require "../views/footer.php" ?>
    </div>

    <script>
        window.onload = function() {
            // Initialize map centered on Hacienda Sacio, Panaquiao, Isabela
            const map = L.map('map').setView([10.2435, 123.0419], 14);

            // Add OpenStreetMap layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Define crossing points
            const points = [
            { coords: [10.2460, 123.0400], name: "Crossing Point 1", status: "Safe" },
            { coords: [10.2410, 123.0430], name: "Crossing Point 2", status: "Caution" },
            { coords: [10.2380, 123.0450], name: "Crossing Point 3", status: "Danger" }
            ];

            // Create numbered custom markers with hover tooltip
            points.forEach((point, index) => {
            const color =
                point.status === "Safe"
                ? "green"
                : point.status === "Caution"
                ? "orange"
                : "red";

            // Custom HTML marker with number label
            const icon = L.divIcon({
                className: "numbered-marker",
                html: `
                <div class="marker-circle" style="background-color: ${color}; border: 2px solid white;">
                    ${index + 1}
                </div>
                `,
                iconSize: [30, 30],
                iconAnchor: [15, 15],
            });

            const marker = L.marker(point.coords, { icon: icon }).addTo(map);

            // Add tooltip that shows on hover
            marker.bindTooltip(
                `<b>${point.name}</b><br>Status: ${point.status}`,
                { direction: 'top', opacity: 0.9 }
            );
            });

        };
    </script>

</body>
</html>