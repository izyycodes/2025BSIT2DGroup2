<head>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-toggler">
            <i class="ri-menu-fold-line" id="btn"></i>
        </div>
        <ul class="side-list">
            <li>
                <a href="../pages/home.php" class="active">
                    <i class="fa-solid fa-house"></i>
                    <span class="links-name">Home</span>
                </a>
                <span class="tooltip">Home</span>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-water"></i>
                    <span class="links-name">River Monitoring</span>
                </a>
                <span class="tooltip">River Monitoring</span>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span class="links-name">Community Reports</span>
                </a>
                <span class="tooltip">Community Reports</span>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span class="links-name">Flood Alerts</span>
                </a>
                <span class="tooltip">Flood Alerts</span>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-circle-question"></i>
                    <span class="links-name">Help Requests</span>
                </a>
                <span class="tooltip">Help Requests</span>
            </li>
        </ul>
        <div class="profile-logout">
            <ul class="side-bottom-list">
                <li>
                    <a href="">
                        <i class="fa-solid fa-user"></i>
                        <span class="links-name">Profile</span>
                    </a>
                    <span class="tooltip">Profile</span>
                </li>
                <li>
                    <a href="">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="links-name">Logout</span>
                    </a>
                    <span class="tooltip">Logout</span>
                </li>
            </ul>
        </div>
    </div>
    
    <script src="https://kit.fontawesome.com/c835d6c14b.js" crossorigin="anonymous"></script>
    <script>
        const sidebar = document.querySelector(".sidebar");
        const sidebarToggler = document. querySelector(".sidebar-toggler");
        const btn = document.querySelector("#btn");

        // Toggle sidebar's collapsed state
        sidebarToggler.addEventListener("click", (e) => {
            e.stopPropagation(); // Prevent toggle click from being counted as "outside"
            sidebar.classList.toggle("collapsed");

            if (btn.classList.contains("ri-menu-fold-line")) {
                btn.classList.replace("ri-menu-fold-line", "ri-menu-unfold-line");
            } else {
                btn.classList.replace("ri-menu-unfold-line", "ri-menu-fold-line");
            }
        });

        // Collapse sidebar when clicking outside (only on mobile)
        document.addEventListener("click", (event) => {
            const isMobile = window.matchMedia("(max-width: 600px)").matches; 
            const clickedInsideSidebar = sidebar.contains(event.target);
            const clickedToggler = sidebarToggler.contains(event.target);

            if (
                isMobile &&
                !clickedInsideSidebar &&
                !clickedToggler &&
                !sidebar.classList.contains("collapsed")
            ) {
                sidebar.classList.add("collapsed");

                // Reset icon back to "fold"
                btn.classList.replace("ri-menu-unfold-line", "ri-menu-fold-line");
            }
        });

    </script>
</body>