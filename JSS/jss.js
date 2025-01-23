// Function to validate form inputs dynamically
function validateForm() {
    // Get elements by ID
    const firstName = document.getElementById("first-name").value;
    const lastName = document.getElementById("last-name").value;
    const gender = document.getElementById("gender").value;
    const age = document.getElementById("age").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const location = document.getElementById("location").value;
    const businessName = document.getElementById("business-name").value;
    const businessType = document.getElementById("business-type").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;
    const terms = document.getElementById("terms").checked;

    // Get error message elements
    const emailError = document.getElementById("email-error");
    const ageError = document.getElementById("age-error");
    const phoneError = document.getElementById("phone-error");

    // Reset error messages
    emailError.innerHTML = "";
    ageError.innerHTML = "";
    phoneError.innerHTML = "";

    // Email format validation
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!email.match(emailRegex)) {
        emailError.innerHTML = "Please enter a valid email address.";
        return false;
    }

    // Age validation
    if (isNaN(age) || age <= 18) {
        ageError.innerHTML = "Age must be a number greater than 18.";
        return false;
    }

    // Phone number validation
    const phoneRegex = /^[0-9]{10}$/;
    if (!phone.match(phoneRegex)) {
        phoneError.innerHTML = "Please enter a valid 10-digit phone number.";
        return false;
    }

    // Other validations
    if (!firstName || !lastName || !gender || !age || !email || !phone || !location || !businessName || !businessType || !password || !confirmPassword) {
        alert("All fields are required. Please fill out the entire form.");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match. Please try again.");
        return false;
    }

    if (!terms) {
        alert("You must agree to the Terms and Conditions.");
        return false;
    }

    return true; // Allow form submission if validation passes
}
