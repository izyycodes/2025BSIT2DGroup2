<head>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <footer>
        <div class="footer-row1">
            <div class="footer-col">
                
                <div class="logo">
                    <img src="../assets/images/logo.png" alt="logo">
                    <h1 class="logo-name">BantayBaha</h1>
                </div>
                
                <h3>About Us</h3>
                <p>Transforming flood safety through <br> instant monitoring and community- <br> driven alerts.</p>
                
            </div>

            <div class="footer-col">
                <h4>Important Links</h4>
                <ul>
                    <li><a href="#" id="dashboard-link">Dashboard</a></li>
                    <li><a href="">River Monitoring</a></li>
                    <li><a href="">Community Reports</a></li>
                    <li><a href="">Flood Alerts</a></li>
                    <li><a href="">Help Requests</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact & Support</h4>
                <p>Emergency: 911</p>
                <p>Barangay: +63 9123456789</p>
                <p>Email: info@bantaybaha.ph </p>
                <p>Address: Municipality of Isabela, <br> Negros Occidental, Philippines</p>
            </div>

        </div>

        <hr style="opacity: 0.5; margin-top: 10px;"><br>

        <div class="footer-row2">
            <div class="footer-col">
                <p>© 2025 BantayBaha. All Rights Reserved.</p>
            </div>
            <div class="footer-col social-icons">
                <a href="">
                    <i class="ri-facebook-fill"></i>
                </a>
                <a href="">
                    <i class="ri-instagram-line"></i>
                </a>
                <a href="">
                    <i class="ri-twitter-x-line"></i>
                </a>
                <a href="">
                    <i class="ri-tiktok-fill"></i>
                </a>
            </div>
        </div>

    </footer>

    <script>
        const dashboardLink = document.getElementById("dashboard-link");

        dashboardLink.addEventListener("click", function(e) {
            e.preventDefault();

            if (localStorage.getItem("isLoggedIn") === "true") {
            // Go directly if logged in
            window.location.href = "../pages/dashboard.php";
            } else {
            // Redirect to login first
            alert("Please login or sign up first.");
            window.location.href = "../pages/login.php";
            }
        });

    </script>
</body>