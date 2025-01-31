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

    // Validation messages
    if (!firstName || !lastName || !gender || !age || !email || !phone || !location || !businessName || !businessType || !password || !confirmPassword) {
        alert("All fields are required. Please fill out the entire form.");
        return false;
    }
    if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
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

}
