// Get the signup form element
const signupForm = document.querySelector('form');

// Function to validate signup form inputs dynamically
function validateForm() {
    const firstName = document.getElementById("fname").value.trim();
    const lastName = document.getElementById("lname").value.trim();
    const email = document.getElementById("gmail").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const businessName = document.getElementById("bname").value.trim();
    const businessType = document.getElementById("btype").value;
    const password = document.getElementById("password").value.trim();

    if (!firstName || !lastName || !email || !phone || !businessName || !businessType || !password) {
        alert("All fields are required. Please fill out the entire form.");
        return false;
    }

    if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}

// Simple email validation function
function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// Attach validation to form submit
signupForm.addEventListener('submit', function(e) {
    if (!validateForm()) {
        e.preventDefault(); // Stop form submission if validation fails
    }
});
