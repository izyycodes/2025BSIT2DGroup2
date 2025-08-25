<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BantayBaha</title>
    <link rel="icon" type="image/ico" href="../images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>

    <?php require "../views/index_navbar.php" ?>

    <section class="hero-container">
    
        <div class="hero-text">
            <div class="bantay-baha">
                <p>Bantay</p>
                <p style="text-align: center;">Baha</p>
            </div>

            <div class="slash">
                <span>/</span>
            </div>

            <div class="tagline">
                <p style="text-align: center;">Ligtas ang Barangay,</p>
                <p style="text-align: center;"> Alerto ang Mamamayan.</p>
            </div>
        </div>

        <div class="hero-button">
            <button class="get-started-button">
                <a href="../pages/sign_up.php">Get Started</a>
            </button>
        </div>
    </section>

    <section class="features">
        <h3>Features</h3>
        
        <div class="features-container">
            <!-- River Monitoring -->
            <div class="features-card">
                <div class="features-title">
                    <img width="35" height="35" src="../icons/river_monitoring.png" alt="River Monitoring">
                    <h4>River Monitoring</h4>
                </div>

                <p>View real-time updates on river water levels to track potential flooding in your area.</p>
            </div>
            
            <!-- Community Reports -->
            <div class="features-card">
                <div class="features-title">
                    <img width="35" height="35" src="../icons/community_reports.png" alt="Community Reports">
                    <h4>Community Reports</h4>
                </div>
                
                <p>Residents can report floods, blocked roads, or hazards with photos and brief descriptions.</p>
                
            </div>

            <!-- Flood Alerts -->
            <div class="features-card">
                <div class="features-title">
                    <img width="35" height="35" src="../icons/flood_alerts.png" alt="Flood Alerts">
                    <h4>Flood Alerts</h4>
                </div>
                
                <p>Receive timely warnings and updates when flood risks are detected, helping you make quick and safe decisions.</p>
                
            </div>  
            
            <!-- Help Requests -->
            <div class="features-card">
                <div class="features-title">
                    <img width="35" height="35" src="../icons/help_requests.png" alt="Help Requests">
                    <h4>Help Requests</h4>
                </div>
                
                <p>Send help requests for yourself or others directly to responders or authorities.</p>
                
            </div>
        </div>

    </section>

    <?php require "../views/footer.php" ?>
    
</body>
</html>