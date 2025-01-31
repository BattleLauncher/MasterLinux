document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    // Form submission event handler
    form.addEventListener('submit', function(event) {
        let valid = true;
        let errorMessage = "";

        // Username validation
        const username = document.querySelector('[name="username"]').value;
        if (!username) {
            valid = false;
            errorMessage += "Username is required.\n";
        }

        // Email validation
        const email = document.querySelector('[name="email"]').value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!email || !emailPattern.test(email)) {
            valid = false;
            errorMessage += "Please enter a valid email address.\n";
        }

        // Password validation
        const password = document.querySelector('[name="password"]').value;
        const confirmPassword = document.querySelector('[name="confirm_password"]').value;
        if (!password || password.length < 8) {
            valid = false;
            errorMessage += "Password must be at least 8 characters long.\n";
        }

        // Confirm password validation
        if (password !== confirmPassword) {
            valid = false;
            errorMessage += "Passwords do not match.\n";
        }

        // Phone number validation (must be numeric)
        const phoneNumber = document.querySelector('[name="phone_number"]').value;
        const phonePattern = /^[0-9]{10}$/; // Assumes 10-digit phone number
        if (phoneNumber && !phonePattern.test(phoneNumber)) {
            valid = false;
            errorMessage += "Phone number must be 10 digits.\n";
        }

        // Role validation
        const role = document.querySelector('[name="role"]').value;
        if (!role) {
            valid = false;
            errorMessage += "Please select a role.\n";
        }

        // Gender validation
        const gender = document.querySelector('[name="gender"]:checked');
        if (!gender) {
            valid = false;
            errorMessage += "Please select a gender.\n";
        }

        // Date of Birth validation
        const dob = document.querySelector('[name="date_of_birth"]').value;
        if (!dob) {
            valid = false;
            errorMessage += "Please select your date of birth.\n";
        }

        // Joining Date validation
        const joiningDate = document.querySelector('[name="joining_date"]').value;
        if (!joiningDate) {
            valid = false;
            errorMessage += "Please select a joining date.\n";
        }

        // Check if the form is valid
        if (!valid) {
            alert(errorMessage);
            event.preventDefault(); // Prevent form submission
        }
    });
});
