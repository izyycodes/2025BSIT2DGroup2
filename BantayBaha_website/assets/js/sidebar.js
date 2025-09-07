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
    e.preventDefault();
    localStorage.removeItem("isLoggedIn"); // clear login
    window.location.href = "../pages/index.php"; // back to login
});