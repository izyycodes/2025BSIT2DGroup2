document.querySelectorAll('.filter-btn').forEach(button => {
  button.addEventListener('click', () => {
    // Remove active class from all buttons
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    // Add active class to clicked button
    button.classList.add('active');
    const filter = button.getAttribute('data-filter');
    const alerts = document.querySelectorAll('.alert-item');
    alerts.forEach(alert => {
      if (filter === 'all') {
        alert.style.display = 'block'; // Show all
      } else {
        // Show only alerts matching the filter, hide others
        if (alert.classList.contains(filter)) {
          alert.style.display = 'block';
        } else {
          alert.style.display = 'none';
        }
      }
    });
  });
});