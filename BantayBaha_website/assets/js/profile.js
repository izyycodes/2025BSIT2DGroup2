// Save personal info
document.querySelector("form")?.addEventListener("submit", function (e) {
  e.preventDefault();

  const personalInfo = {
    fullName: document.querySelector("#fullName").value,
    age: document.querySelector("#age").value,
    gender: document.querySelector("#gender").value,
    phone: document.querySelector("#phone").value,
    email: document.querySelector("#email").value,
    address: document.querySelector("#address").value,
  };

  localStorage.setItem("personalInfo", JSON.stringify(personalInfo));
  alert("Personal information saved!");
});

// Load personal info
window.addEventListener("DOMContentLoaded", () => {
  const savedInfo = JSON.parse(localStorage.getItem("personalInfo"));
  if (savedInfo) {
    document.querySelector("#fullName").value = savedInfo.fullName || "";
    document.querySelector("#age").value = savedInfo.age || "";
    document.querySelector("#gender").value = savedInfo.gender || "";
    document.querySelector("#phone").value = savedInfo.phone || "";
    document.querySelector("#email").value = savedInfo.email || "";
    document.querySelector("#address").value = savedInfo.address || "";
  }

  // Load contacts
  const savedContacts = JSON.parse(localStorage.getItem("emergencyContacts")) || [];
  savedContacts.forEach(c => displayContact(c.name, c.relation, c.phone));
});

// Add new contact
document.querySelector("#addContactBtn")?.addEventListener("click", () => {
  const name = prompt("Enter contact name:");
  const relation = prompt("Enter relation (e.g. Father, Spouse):");
  const phone = prompt("Enter phone number:");

  if (name && relation && phone) {
    const contact = { name, relation, phone };
    let contacts = JSON.parse(localStorage.getItem("emergencyContacts")) || [];
    contacts.push(contact);
    localStorage.setItem("emergencyContacts", JSON.stringify(contacts));

    displayContact(name, relation, phone);
  }
});

// Display contact on screen
function displayContact(name, relation, phone) {
  const container = document.querySelector("#emergencyContactsContainer");
  const div = document.createElement("div");
  div.classList.add("contact-card");
  div.innerHTML = `<strong>${name}</strong><br>${relation} - ${phone}`;
  container.appendChild(div);
}
