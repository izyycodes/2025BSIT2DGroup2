document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("isLoggedIn") !== "true") {
    alert("You must login or sign up first!");
    window.location.href = "../pages/login.php";
    }
});