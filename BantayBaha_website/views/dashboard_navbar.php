<head>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <input type="checkbox" id="toggler">
        <label for="toggler"><i class="ri-menu-line"></i></label>

        <a href="../pages/index.php">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="logo">
                <h1 class="logo-name">BantayBaha</h1>
            </div>
        </a>
        
        <?php 
            $date = date("d F Y");
            $day  = date("l");
        ?>

        <div class="nav-text">
            <span><?php echo $date; ?></span>
            <span>|</span>
            <span><?php echo $day; ?></span>
            <span>|</span>
            <span id="time"></span>
            <span>|</span>
            <a href="../pages/notifications.php">
                <i class="ri-notification-2-fill" style="font-size: 20px;"></i>
            </a>
            <span>|</span>
            <a href="../pages/profile.php">
                <i class="ri-account-circle-line" style="font-size: 28px;"></i>
            </a>
        </div>
        
    </header>

    <script>
        let time = document.getElementById("time");

        // Set time
        setInterval(function() {
            let date = new Date();
            time.innerHTML = date.toLocaleTimeString();
        }, 1000)
    </script>
</body>