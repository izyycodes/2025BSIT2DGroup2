<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Alerts</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/flood_alerts.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php require "../views/dashboard_navbar.php" ?>
    <?php require "../views/sidebar.php" ?>

    <div class="main-content">
         <div class="page-header">
             <i class="ri-alert-fill"></i>
             <h1>Flood Alerts</h1>
        </div>

         <div class="emergency-banner">
             <div class="emergency">
                <div>
                    <i class="ri-alarm-warning-fill"></i>
                </div>
                <div>
                    <p style="font-size: 15px; text-align: left;">
                        <strong style="font-size: 18px;">CRITICAL FLOOD EMERGENCY:</strong> <br>
                        Crossing Point 3 is completely impassable! Water level: 2.1m - Avoid all travel to this area immediately!
                    </p>
                </div>
            </div>
            <div>
                <p style="font-size: 14px;">ACTIVE SINCE <br>
                    <strong>8:30 AM</strong>
               </p>
            </div>
        </div>

        <div class="card">
            <div class="refresh"></div>
            <span style="font-size: 14px;">Auto-updating every 30 seconds • Last update: 9:48 AM</span>
        </div>

        <div class="card alert-status">
            <h3>Current Alert Status</h3>
            <div class="alert-grid">
                <div class="alert-card">
                    <div class="alert-number">1</div>
                    <div class="alert-label" style="font-weight: 600;">Critical Alert</div>
                    <div class="alert-info" style="font-size: 13px;">Point 3 Flooded</div>
                </div>
                <div class="alert-card">
                    <div class="alert-number">1</div>
                    <div class="alert-label" style="font-weight: 600;">High Risk</div>
                    <div class="alert-info" style="font-size: 13px;">Point 2 Rising</div>
                </div>
                <div class="alert-card">
                    <div class="alert-number">1</div>
                    <div class="alert-label" style="font-weight: 600;">Weather Advisory</div>
                    <div class="alert-info" style="font-size: 13px;">Heavy Rain Tonigh</div>
                </div>
            </div>
        </div>
    
        <?php require "../views/footer.php" ?>
    </div>
</body>
</html>