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
                <button class="emergency-button">
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
            <div class="card">
                <h3>📍 Your Current Location</h3>
                
                <div class="form-row">
                    <div class="form-column">
                        <label for="emergencyType">Type of Emergency</label>
                        <select name="emergencyType" id="emergencyType">
                            <option value="waterRising">Flood/Water Rising</option>
                            <option value="stranded">Trapped/Stranded</option>
                            <option value="medEmergency">Medical Emergency</option>
                            <option value="evacuation">Need Evacuation</option>
                            <option value="others">Other Emergency</option>
                        </select>
                    </div>
                    <div class="form-column">
                        <label for="urgencyLevel">Urgency Level</label>
                        <select name="urgencyLevel" id="urgencyLevel">
                            <option value="low">Low Priority</option>
                            <option value="medium">Medium Priority</option>
                            <option value="high">High Priority</option>
                            <option value="critical">Critical - Life Threatening</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="numPeople">Number of People</label>
                        <select name="numPeople" id="numPeople">
                            <option value="one">1 Person</option>
                            <option value="two">2 People</option>
                            <option value="three">3 People</option>
                            <option value="four">4 People</option>
                            <option value="fiveAbove">5+ People</option>
                            <option value="critical">Entire Family</option>
                        </select>
                    </div>
                </div>
            </div>
    
        <?php require "../views/footer.php" ?>
    </div>
</body>
</html>