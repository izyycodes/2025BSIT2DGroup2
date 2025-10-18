// Show or hide the add contact form
document.getElementById('showFormBtn').addEventListener('click', function() {
const form = document.getElementById('addContactForm');
form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
});

// Show edit form
function showEditForm(index) {
document.getElementById('display-' + index).style.display = 'none';
document.getElementById('editForm-' + index).style.display = 'block';
}

// Cancel edit form
function cancelEdit(index) {
document.getElementById('editForm-' + index).style.display = 'none';
document.getElementById('display-' + index).style.display = 'flex';
}


