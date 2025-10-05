const filters = document.querySelectorAll('#filter-list li');
const notificationsContainer = document.getElementById('notifications-container');
const noNotifications = document.getElementById('no-notifications');
const markAllReadBtn = document.getElementById('mark-all-read');

// Only grab the <p> inside #no-notifications
const noNotificationsMessage = noNotifications.querySelector('p');

// --- Global function to update numbers and handle "no notifications" message ---
function updateCounts() {
    const allCards = document.querySelectorAll('.notification-card');
    const visibleCards = Array.from(allCards).filter(card => card.style.display !== 'none');

    // Update per category
    document.querySelector('li[data-filter="all"] span').textContent = allCards.length;
    document.querySelector('li[data-filter="unread"] span').textContent = document.querySelectorAll('.notification-card.unread').length;
    document.querySelector('li[data-filter="critical"] span').textContent = document.querySelectorAll('.notification-card.critical').length;
    document.querySelector('li[data-filter="warning"] span').textContent = document.querySelectorAll('.notification-card.warning').length;
    document.querySelector('li[data-filter="information"] span').textContent = document.querySelectorAll('.notification-card.information').length;
    document.querySelector('li[data-filter="success"] span').textContent = document.querySelectorAll('.notification-card.success').length;

    // Get active filter
    const activeFilter = document.querySelector('#filter-list li.active')?.getAttribute('data-filter') || 'all';

    // Show "No notifications" placeholder with different <p> text
    if (visibleCards.length === 0) {
        noNotifications.style.display = 'block';

        if (activeFilter === "unread") {
            noNotificationsMessage.textContent = "No unread notifications to display.";
        } else if (activeFilter === "all") {
            noNotificationsMessage.textContent = "You're all caught up! No notifications to display.";
        } else {
            noNotificationsMessage.textContent = `No ${activeFilter} notifications to display.`;
        }
    } else {
        noNotifications.style.display = 'none';
    }
}

// --- Filter logic ---
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.filter-btn, #filter-list li');
    const alerts = document.querySelectorAll('.notification-card');

    // --- Show/hide notifications based on filter ---
    function filterAlerts(filter) {
        let hasVisible = false;

        alerts.forEach(alert => {
            if (filter === 'all' || alert.classList.contains(filter)) {
                alert.style.display = 'flex';
                hasVisible = true;
            } else {
                alert.style.display = 'none';
            }
        });

        // Show or hide the empty-state
        const emptyState = document.getElementById('no-notifications');
        if (emptyState) {
            emptyState.style.display = hasVisible ? 'none' : 'block';
        }

        updateCounts(); // ✅ update after filtering
    }

    // --- Load initial filter from URL (or default to 'all') ---
    const urlParams = new URLSearchParams(window.location.search);
    const initialFilter = urlParams.get('filter') || 'all';
    filterAlerts(initialFilter);

    // --- Set active button on page load ---
    buttons.forEach(btn => {
        const btnFilter = btn.getAttribute('data-filter');
        btn.classList.toggle('active', btnFilter === initialFilter);
    });

    // --- Handle button clicks ---
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');

            // Update active state
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Filter notifications
            filterAlerts(filter);

            // Update the URL (so filter persists on reload)
            const url = new URL(window.location);
            url.searchParams.set('filter', filter);
            window.history.replaceState({}, '', url);
        });
    });
});

// --- Close button logic ---
document.querySelectorAll('.close-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const notificationCard = btn.closest('.notification-card');
        if (notificationCard) {
            notificationCard.remove();
        }
        updateCounts();
    });
});

// --- Mark all as read logic ---
markAllReadBtn.addEventListener('click', () => {
    const unreadCards = document.querySelectorAll('.notification-card.unread');
    unreadCards.forEach(card => {
        card.classList.remove('unread');
        card.classList.add('read');
    });
    updateCounts();
});

// --- Run once on page load ---
updateCounts();
