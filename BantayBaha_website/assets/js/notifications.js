const filters = document.querySelectorAll('#filter-list li');
const notificationsContainer = document.getElementById('notifications-container');
const noNotifications = document.getElementById('no-notifications');
const markAllReadBtn = document.getElementById('mark-all-read');

// Only grab the <p> inside #no-notifications
const noNotificationsMessage = noNotifications.querySelector('p');

// Function to update numbers in filter box + empty state message
function updateCounts() {
    const allCards = document.querySelectorAll('.notification-card');
    const visibleCards = Array.from(allCards).filter(card => card.style.display !== 'none');

    // Update per category
    document.querySelector('li[data-filter="all"] span').textContent = allCards.length;
    document.querySelector('li[data-filter="unread"] span').textContent = document.querySelectorAll('.notification-card.unread').length;
    document.querySelector('li[data-filter="critical"] span').textContent = document.querySelectorAll('.notification-card.critical').length;
    document.querySelector('li[data-filter="warning"] span').textContent = document.querySelectorAll('.notification-card.warning').length;
    document.querySelector('li[data-filter="info"] span').textContent = document.querySelectorAll('.notification-card.info').length;
    document.querySelector('li[data-filter="success"] span').textContent = document.querySelectorAll('.notification-card.success').length;

    // Get active filter
    const activeFilter = document.querySelector('#filter-list li.active').getAttribute('data-filter');

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

// Filter logic
filters.forEach(filter => {
    filter.addEventListener('click', () => {
        filters.forEach(f => f.classList.remove('active'));
        filter.classList.add('active');

        const filterValue = filter.getAttribute('data-filter');
        const notifications = document.querySelectorAll('.notification-card');

        notifications.forEach(notification => {
            if (filterValue === 'all') {
                notification.style.display = 'flex';
            } else if (notification.classList.contains(filterValue)) {
                notification.style.display = 'flex';
            } else {
                notification.style.display = 'none';
            }
        });

        updateCounts();
    });
});

// Close button logic
document.querySelectorAll('.close-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const notificationCard = btn.closest('.notification-card');
        if (notificationCard) {
            notificationCard.remove(); 
        }
        updateCounts();
    });
});

// Mark all as read logic
markAllReadBtn.addEventListener('click', () => {
    const unreadCards = document.querySelectorAll('.notification-card.unread');
    
    unreadCards.forEach(card => {
        card.classList.remove('unread');  
        card.classList.add('read');       
    });

    updateCounts();
});

// Run once on page load
updateCounts();
