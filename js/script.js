// Home navbar time
let time = document.getElementById("time");

// Set time
setInterval(function() {
    let date = new Date();
    time.innerHTML = date.toLocaleTimeString();
}, 1000)

// Login 
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

// login verification
const errorMessage = document.getElementById("error-msg");
const forgotPassword = document.getElementById("forgot-pass");

document.getElementById("login-form").addEventListener("submit", function(e) {
    e.preventDefault();

    const email = document.getElementById("login-email").value;
    const password = document.getElementById("login-password").value;

    if (email === "s2100406@usls.edu.ph" && password === "usls1234") {
        window.location.href = "../pages/home.php";
    } else {
        errorMessage.style.display = "block";
        errorMessage.innerHTML = "Wrong password! Try again or <span id='forgot-password-link' style='color: #1386b3; cursor: pointer;text-decoration: underline;'>Forgot password</span> to reset it.";
        document.getElementById("login-password").value = "";
        document.getElementById("forgot-password-link").addEventListener("click", resetPassword);
    }
});

// Forgot password
function resetPassword() {
    alert("Your password has been reset! Enter your new password now.");
    document.getElementById("login-form").reset();
    errorMessage.style.display = "none";
}

