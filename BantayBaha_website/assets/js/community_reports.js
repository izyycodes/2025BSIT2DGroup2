// Get filter elements
const statusFilter = document.getElementById('status');
const locationFilter = document.getElementById('location');
const searchInput = document.getElementById('search');

// Get all report cards
const reportCards = document.querySelectorAll('.report-card');

// Get "No reports" element
const noReports = document.getElementById('no-reports');

// ✅ Apply filters function
function applyFilters() {
    const statusValue = statusFilter.value;
    const locationValue = locationFilter.value;
    const searchValue = searchInput.value.toLowerCase();

    let visibleCount = 0;

    reportCards.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        const cardLocation = card.getAttribute('data-location');
        const cardText = card.textContent.toLowerCase();

        const matchesStatus = (statusValue === 'all-reports' || cardStatus === statusValue);
        const matchesLocation = (locationValue === 'all-locations' || cardLocation === locationValue);
        const matchesSearch = (searchValue === '' || cardText.includes(searchValue));

        if (matchesStatus && matchesLocation && matchesSearch) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // Show/hide "No reports" placeholder
    noReports.style.display = visibleCount === 0 ? 'block' : 'none';

    // ✅ Update URL with current filter values
    const url = new URL(window.location);
    url.searchParams.set('status', statusValue);
    url.searchParams.set('location', locationValue);
    if (searchValue) {
        url.searchParams.set('search', searchValue);
    } else {
        url.searchParams.delete('search');
    }
    window.history.replaceState({}, '', url);
}

// ✅ Read filters from URL on load
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const savedStatus = urlParams.get('status') || 'all-reports';
    const savedLocation = urlParams.get('location') || 'all-locations';
    const savedSearch = urlParams.get('search') || '';

    // Set dropdowns and search input
    statusFilter.value = savedStatus;
    locationFilter.value = savedLocation;
    searchInput.value = savedSearch;

    // Apply filters immediately
    applyFilters();
});

// ✅ Attach listeners
statusFilter.addEventListener('change', applyFilters);
locationFilter.addEventListener('change', applyFilters);
searchInput.addEventListener('input', applyFilters);
