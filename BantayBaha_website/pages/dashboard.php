<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c835d6c14b.js" crossorigin="anonymous"></script>
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
            <p><span style="font-weight: 600;">🚨 FLOOD ALERT:</span> High water levels detected at Crossing Point 3. Exercise extreme caution!</p>
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
                <div class="action-buttons"></div>
            </div>

            <!-- Community Reports -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/reports.png" alt="reports" class="reports">
                    </div>
                    <h3>Community Reports</h3>
                </div>
                <div class="action-buttons"></div>
            </div>

            <!-- Flood Forecast -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/forecast.png" alt="forecast" class="forecast">
                    </div>
                    <h3>Flood Forecast</h3>
                </div>
                <div class="action-buttons"></div>
            </div>

            <!-- Help Requests -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/help.png" alt="help" class="help">
                    </div>
                    <h3>Help Requests</h3>
                </div>
                <div class="action-buttons"></div>
            </div>

            <!-- System Statistics -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/stats.png" alt="stats" class="stats">
                    </div>
                    <h3>System Statistics</h3>
                </div>
                <div class="action-buttons"></div>
            </div>

            <!-- Admin Controls -->
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <img src="../assets/images/controls.png" alt="controls" class="controls">
                    </div>
                    <h3>Admin Controls</h3>
                </div>
                <div class="action-buttons"></div>
            </div>
        </div>

        <!-- <div class="map-container" id="map-container" style="display:none;">
            <h1>Monitoring Site</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.0837916690966!2d122.9626614745157!3d10.650598461503094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aed1b6d51c0973%3A0x56bf406758a5856d!2sHacienda%20sacio!5e0!3m2!1sen!2sph!4v1755414643945!5m2!1sen!2sph" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div> -->

        <?php require "../views/footer.php" ?>
    </div>

    <script>
         document.getElementById("map").addEventListener("click", function() {
            const mapContainer = document.getElementById("map-container");
            if (mapContainer.style.display === "none" || mapContainer.style.display === "") {
                mapContainer.style.display = "block";
            } else {
                mapContainer.style.display = "none";
            }
        });

       document.addEventListener("DOMContentLoaded", () => {
            if (localStorage.getItem("isLoggedIn") !== "true") {
            alert("You must login or sign up first!");
            window.location.href = "../pages/login.php";
            }
        });
    </script>
</body>
</html>