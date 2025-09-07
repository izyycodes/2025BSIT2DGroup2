<head>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c835d6c14b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<body>
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <div class="sidebar">
        <div class="sidebar-toggler">
            <i class="ri-menu-fold-line" id="btn"></i>
        </div>
        <ul class="side-list">
            <li>
                <a href="../pages/dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-house"></i>
                    <span class="links-name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="../pages/river_monitoring.php" class="<?php echo ($current_page == 'river_monitoring.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-water"></i>
                    <span class="links-name">River Monitoring</span>
                </a>
                <span class="tooltip">River Monitoring</span>
            </li>
            <li>
                <a href="../pages/community_reports.php" class="<?php echo ($current_page == 'community_reports.php' || $current_page == 'submit_new_report.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span class="links-name">Community Reports</span>
                </a>
                <span class="tooltip">Community Reports</span>
            </li>
            <li>
                <a href="../pages/flood_alerts.php" class="<?php echo ($current_page == 'flood_alerts.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="links-name">Flood Alerts</span>
                </a>
                <span class="tooltip">Flood Alerts</span>
            </li>
            <li>
                <a href="../pages/help_requests.php" class="<?php echo ($current_page == 'help_requests.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-circle-question"></i>
                    <span class="links-name">Help Requests</span>
                </a>
                <span class="tooltip">Help Requests</span>
            </li>
        </ul>
        <div class="profile-logout">
            <ul class="side-bottom-list">
                <li>
                    <a href="../pages/profile.php" class="<?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
                        <i class="fa-solid fa-user"></i>
                        <span class="links-name">Profile</span>
                    </a>
                    <span class="tooltip">Profile</span>
                </li>
                <li>
                    <a href="../pages/index.php" id="logout-btn" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="links-name">Logout</span>
                    </a>
                    <span class="tooltip">Logout</span>
                </li>
            </ul>
        </div>
    </div>
    
    <script src="../assets/js/sidebar.js"></script>
</body>