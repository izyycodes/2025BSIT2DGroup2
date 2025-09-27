function requestHelp() {
    const btn = document.getElementById('emergencyBtn');
    const form = document.getElementById('helpContainer');
    
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
        form.scrollIntoView({ behavior: "smooth" });
    } else {
        form.style.display = "none";
    }
}

// Close button
document.addEventListener("DOMContentLoaded", function() {
  const callButton = document.getElementById("emergencyBtn");
  const emergencyBox = document.getElementById("helpContainer");
  const closeButton = document.getElementById("closeBtn");

  // Show the emergency box
  callButton.addEventListener("click", function() {
    emergencyBox.style.display = "block";
    emergencyBox.scrollIntoView({ behavior: "smooth" });
  });

  // Hide the emergency box
  closeButton.addEventListener("click", function() {
    emergencyBox.style.display = "none";
  });
});

const form = document.getElementById("helpForm");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    alert("Help Request sent successfully!");
    form.reset();
});
