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

document.getElementById("logout-btn").addEventListener("click", function(e) {
    localStorage.removeItem("isLoggedIn"); // clear login
});

function updateSidebarActive() {
  const hash = window.location.hash;
  const path = window.location.pathname;

  if (path.includes('river_monitoring.php') && hash === '#river-map')
    document.querySelector('a[href*="river_monitoring.php"]')?.classList.add('active');

  if (path.includes('community_reports.php') && hash === '#verify-reports')
    document.querySelector('a[href*="community_reports.php"]')?.classList.add('active');

  if (path.includes('flood_alerts.php') && (hash === '#forecast' || hash === '#alerts'))
    document.querySelector('a[href*="flood_alerts.php"]')?.classList.add('active');

  if (path.includes('help_requests.php') && hash === '#messages')
    document.querySelector('a[href*="help_requests.php"]')?.classList.add('active');

  if (path.includes('profile.php') && hash === '#notif-settings')
    document.querySelector('a[href*="profile.php"]')?.classList.add('active');
}

document.addEventListener('DOMContentLoaded', updateSidebarActive);
window.addEventListener('hashchange', updateSidebarActive);


