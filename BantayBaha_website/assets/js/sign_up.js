// Toggle password 
function togglePassword(icon) {
    const passwordField = icon.previousElementSibling;

    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        passwordField.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
    }
}

// Sign up verification
document.getElementById("signup-form").addEventListener("submit", function(e) {
    e.preventDefault();

    const email = document.getElementById("signup-email").value;
    const password = document.getElementById("signup-password").value;

    // Set login state and go to dashboard.
    localStorage.setItem("isLoggedIn", "true");

    window.location.href = "../pages/dashboard.php";
});