<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>

    <?php require "../views/dashboard_navbar.php" ?>
    <?php require "../views/sidebar.php" ?>

    <div class="home-content">
        <section class="water-container">
            <h1>Water Monitor Level</h1>
            <img src="../assets/images/speedometer.jpg" alt="Speedometer">
        </section>

        <section class="home-card-container">
            <div class="home-card">
                <img src="../images/report.png" alt="Report Your Situation">
                <h4>Report Your Situation</h4>
            </div>
            <div class="home-card" id="map">
                <img src="../images/map.png" alt="Map">
                <h4>Map</h4>
            </div>
            <div class="home-card">
                <img src="../images/weather.png" alt="Weather Forecast">
                <h4>Weather Forecast</h4>
            </div>
        </section>
        
        <div class="map-container" id="map-container" style="display:none;">
            <h1>Monitoring Site</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.0837916690966!2d122.9626614745157!3d10.650598461503094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aed1b6d51c0973%3A0x56bf406758a5856d!2sHacienda%20sacio!5e0!3m2!1sen!2sph!4v1755414643945!5m2!1sen!2sph" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

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