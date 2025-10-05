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

// Form javascript
const form = document.getElementById('helpForm');
const modal = document.getElementById('confirmModal');
const modalDetails = document.getElementById('modalDetails');
const confirmBtn = document.getElementById('confirmSubmit');
const cancelBtn = document.getElementById('cancelModal');
const submitBtn = document.querySelector('.submit-emergency-button');

// When "Submit Report" button is clicked
submitBtn.addEventListener('click', function (e) {
    e.preventDefault(); // stop default submit first

    // Check form validity before showing modal
    if (!form.checkValidity()) {
        form.reportValidity(); // triggers browser validation messages
        return; // stop here if form not valid
    }

    // Collect form data if valid
    const data = new FormData(form);
    const entries = Object.fromEntries(data.entries());

    // Show details in modal
    modalDetails.innerHTML = `
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:180px;">Type of Emergency:</strong> ${entries.emergencyType}</p>
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:180px;">Urgency Level:</strong> ${entries.urgencyLevel}</p>
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:180px;">Number of People:</strong> ${entries.numPeople}</p>
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:180px;">Additional Details:</strong> ${entries.details || 'N/A'}</p>
    `;

    // Show modal (only after passing validation)
    modal.style.display = 'flex';
});

// Cancel button hides modal
cancelBtn.addEventListener('click', function () {
    modal.style.display = 'none';
});

// Confirm button actually submits the form
confirmBtn.addEventListener('click', function () {
    // Add hidden input so PHP knows it was confirmed
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'confirmSubmit';
    input.value = '1';
    form.appendChild(input);

    modal.style.display = 'none';
    form.submit(); // Now it will POST safely
});

// Close modal if clicking outside it
window.addEventListener('click', function (e) {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});

// // Messaging system
// const msgForm = document.getElementById('msgForm');
// const container = document.getElementById('messageContainer');

// // --- User message submit (AJAX) ---
// msgForm.addEventListener('submit', async (e) => {
//     e.preventDefault();

//     const input = document.getElementById('user_message');
//     const message = input.value.trim();
//     if (message === '') return;

//     const formData = new FormData();
//     formData.append('user_message', message);

//     const response = await fetch('', { method: 'POST', body: formData });
//     if (response.ok) {
//         const newMsg = await response.json();

//         const div = document.createElement('div');
//         div.className = 'status-indicator bg-green';
//         div.innerHTML = `
//             <div class="message">
//                 <div class="icon" style="background-color: #22c55e;">
//                     <i class="ri-user-3-fill"></i>
//                 </div>
//                 <div class="msg-info">
//                     <div>
//                         <p style="color: #166534; font-size: 14px; font-weight: 600;">You</p>
//                         <p style="color: #15803d; font-size: 12px;">${newMsg.text}</p>
//                         <p class="msg-time">${newMsg.time}</p>
//                     </div>
//                 </div>
//             </div>
//         `;
//         container.appendChild(div);
//         container.scrollTo({ top: container.scrollHeight, behavior: 'smooth' });
//         input.value = '';
//     }
// });

// // --- Automatic random updates every 15 seconds ---
// const updates = [
//     '🚑 Rescue team is 5 minutes closer to your location',
//     '☀️ Weather conditions improving in your area',
//     '🧍 Additional support teams mobilized',
//     '📡 Communication established with local authorities'
// ];

// setInterval(() => {
//     const randomUpdate = updates[Math.floor(Math.random() * updates.length)];

//     const updateDiv = document.createElement('div');
//     updateDiv.className = 'status-indicator bg-yellow';
//     updateDiv.innerHTML = `
//         <div class="message">
//             <div class="icon" style="background-color: #fbbf24;">
//                 <i class="ri-notification-2-fill"></i>
//             </div>
//             <div class="msg-info">
//                 <div>
//                     <p style="color: #92400e; font-size: 14px; font-weight: 600;">Update</p>
//                     <p style="color: #b45309; font-size: 12px;">${randomUpdate}</p>
//                     <p class="msg-time">Just now</p>
//                 </div>
//             </div>
//         </div>
//     `;

//     container.appendChild(updateDiv);
//     container.scrollTo({ top: container.scrollHeight, behavior: 'smooth' });

//     // Remove after 5 seconds
//     setTimeout(() => {
//         updateDiv.style.transition = 'opacity 0.5s';
//         updateDiv.style.opacity = '0';
//         setTimeout(() => updateDiv.remove(), 500);
//     }, 5000);

// }, 15000);