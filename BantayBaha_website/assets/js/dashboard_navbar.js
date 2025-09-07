let time = document.getElementById("time");

// Set time
setInterval(function() {
    let date = new Date();
    time.innerHTML = date.toLocaleTimeString();
}, 1000)