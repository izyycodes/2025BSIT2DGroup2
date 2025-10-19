// // Disable future report dates
const dateInput = document.getElementById('reportDate');
const today = new Date().toISOString().split('T')[0];
dateInput.max = today;

// Form javascript
const form = document.getElementById('new-report-form');
const modal = document.getElementById('confirmModal');
const modalDetails = document.getElementById('modalDetails');
const confirmBtn = document.getElementById('confirmSubmit');
const cancelBtn = document.getElementById('cancelModal');
const submitBtn = document.querySelector('.btn-submit');

// For image preview
const uploadPhoto = document.getElementById('uploadPhoto');
let uploadedImageURL = ""; // store preview URL temporarily

uploadPhoto.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            uploadedImageURL = e.target.result; // base64 preview
        };
        reader.readAsDataURL(file);
    } else {
        uploadedImageURL = "";
    }
});

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

    // Convert 24-hour time to 12-hour format
    let formattedTime = '';
    if (entries.reportTime) {
    const time = new Date(`1970-01-01T${entries.reportTime}`);
    formattedTime = time.toLocaleTimeString([], {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    });
    }

    // Convert YYYY-MM-DD date to "Month DD, YYYY" format
    let formattedDate = '';
    if (entries.reportDate) {
    const date = new Date(entries.reportDate);
    formattedDate = date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    }

    // Show details in modal
    modalDetails.innerHTML = `
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:120px;">Name:</strong> ${entries.firstName} ${entries.lastName}</p>
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:120px;">Location:</strong> ${entries.location}</p>
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:120px;">Date:</strong> ${formattedDate}</p>
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:120px;">Time:</strong> ${formattedTime}</p>
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:120px;">Water Level:</strong> ${entries.waterLevelDesc}</p>
        <p style="color:#555;"><strong style="color:#222; display:inline-block; width:120px;">Remarks:</strong> ${entries.remarks || 'N/A'}</p>
        ${
            uploadedImageURL
                ? `<div style="margin-top:10px;"><strong>Uploaded Photo:</strong><br>
                   <img src="${uploadedImageURL}" alt="Uploaded Photo" 
                        style="max-width:50%; border-radius:8px; margin-top:5px;">
                   </div>`
                : ''
        }
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
