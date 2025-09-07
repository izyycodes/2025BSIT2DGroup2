function isLoggedIn() {
    return localStorage.getItem("isLoggedIn") === "true";
}

// Handle footer link clicks 
document.querySelectorAll("footer a").forEach(link => {
    link.addEventListener("click", function (e) {
        if (!isLoggedIn()) {
            e.preventDefault(); // stop going directly to the page
            const targetPage = this.getAttribute("href"); // save where user wanted to go
            localStorage.setItem("redirectAfterLogin", targetPage);
            alert("Please login or sign up first.");
            window.location.href = "../pages/login.php"; // go to login first
        }
    });
});