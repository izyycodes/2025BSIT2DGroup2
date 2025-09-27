// Get filter elements
const statusFilter = document.getElementById('status');
const locationFilter = document.getElementById('location');
const searchInput = document.getElementById('search');

// Get all report cards
const reportCards = document.querySelectorAll('.report-card');

// Get no-reports element
const noReports = document.getElementById('no-reports');

// Function to apply filters
function applyFilters() {
    const statusValue = statusFilter.value;       // verified, pending, flagged, all-reports
    const locationValue = locationFilter.value;   // cpoint1, cpoint2, cpoint3, all-locations
    const searchValue = searchInput.value.toLowerCase();

    let visibleCount = 0; // track how many cards are shown

    reportCards.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        const cardLocation = card.getAttribute('data-location');
        const cardText = card.textContent.toLowerCase();

        let matchesStatus = (statusValue === 'all-reports' || cardStatus === statusValue);
        let matchesLocation = (locationValue === 'all-locations' || cardLocation === locationValue);
        let matchesSearch = (searchValue === '' || cardText.includes(searchValue));

        if (matchesStatus && matchesLocation && matchesSearch) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // Show/hide "No reports" placeholder
    if (visibleCount === 0) {
        noReports.style.display = 'block';
    } else {
        noReports.style.display = 'none';
    }
}

// Attach event listeners
statusFilter.addEventListener('change', applyFilters);
locationFilter.addEventListener('change', applyFilters);
searchInput.addEventListener('input', applyFilters);

// Submit new report alert
const form = document.getElementById("new-report-form");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    alert("Report submitted successfully!");
    form.reset();
});
