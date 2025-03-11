function validateLoginForm() {
    let isValid = true;

    // Clear previous error messages
    document.getElementById('usernameError').innerText = '';
    document.getElementById('passwordError').innerText = '';

    // Validate username
    const username = document.getElementById('username').value.trim();
    if (username === '') {
        document.getElementById('usernameError').innerText = 'Username is required.';
        isValid = false;
    }

    // Validate password
    const password = document.getElementById('password').value.trim();
    if (password === '') {
        document.getElementById('passwordError').innerText = 'Password is required.';
        isValid = false;
    }

    return isValid;
}

function validateRegistrationForm() {
    let isValid = true;

    // Clear previous error messages
    document.getElementById('usernameError').innerText = '';
    document.getElementById('passwordError').innerText = '';
    document.getElementById('reenterPassError').innerText = '';
    document.getElementById('fullNameError').innerText = '';
    document.getElementById('emailError').innerText = '';
    document.getElementById('phoneError').innerText = '';
    document.getElementById('locationError').innerText = '';
    document.getElementById('socialMediaPlatformError').innerText = '';
    document.getElementById('socialMediaHandleError').innerText = '';
    document.getElementById('followerRangeError').innerText = '';
    document.getElementById('profilePictureError').innerText = '';
    document.getElementById('bioError').innerText = '';

    // Validate username
    const username = document.getElementById('username').value.trim();
    if (username === '') {
        document.getElementById('usernameError').innerText = 'Username is required.';
        isValid = false;
    }

    // Validate password
    const password = document.getElementById('password').value.trim();
    if (password === '') {
        document.getElementById('passwordError').innerText = 'Password is required.';
        isValid = false;
    }

    // Validate re-enter password
    const reenterPass = document.getElementById('reenter_pass').value.trim();
    if (reenterPass === '') {
        document.getElementById('reenterPassError').innerText = 'Please re-enter your password.';
        isValid = false;
    } else if (reenterPass !== password) {
        document.getElementById('reenterPassError').innerText = 'Passwords do not match.';
        isValid = false;
    }

    // Validate full name
    const fullName = document.getElementById('fullName').value.trim();
    if (fullName === '') {
        document.getElementById('fullNameError').innerText = 'Full name is required.';
        isValid = false;
    }

    // Validate email
    const email = document.getElementById('email').value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '') {
        document.getElementById('emailError').innerText = 'Email is required.';
        isValid = false;
    } else if (!emailPattern.test(email)) {
        document.getElementById('emailError').innerText = 'Invalid email format.';
        isValid = false;
    }

    // Validate phone
    const phone = document.getElementById('phone').value.trim();
    if (phone === '') {
        document.getElementById('phoneError').innerText = 'Phone number is required.';
        isValid = false;
    } else if (!/^\d+$/.test(phone)) {
        document.getElementById('phoneError').innerText = 'Phone number must be numeric.';
        isValid = false;
    }

    // Validate location
    const location = document.getElementById('location').value.trim();
    if (location === '') {
        document.getElementById('locationError').innerText = 'Location is required.';
        isValid = false;
    }

    // Validate social media platform
    const socialMediaPlatform = document.getElementById('socialMediaPlatform').value;
    if (socialMediaPlatform === '') {
        document.getElementById('socialMediaPlatformError').innerText = 'Social media platform is required.';
        isValid = false;
    }

    // Validate social media handle
    const socialMediaHandle = document.getElementById('socialMediaHandle').value.trim();
    if (socialMediaHandle === '') {
        document.getElementById('socialMediaHandleError').innerText = 'Social media handle is required.';
        isValid = false;
    }

    // Validate follower range
    const followerRange = document.getElementById('followerRange').value;
    if (followerRange === '') {
        document.getElementById('followerRangeError').innerText = 'Follower range is required.';
        isValid = false;
    }

    // Validate profile picture
    const profilePicture = document.getElementById('profilePicture').value;
    if (profilePicture === '') {
        document.getElementById('profilePictureError').innerText = 'Profile picture is required.';
        isValid = false;
    }

    // Validate bio
    const bio = document.getElementById('bio').value.trim();
    if (bio === '') {
        document.getElementById('bioError').innerText = 'Bio is required.';
        isValid = false;
    }

    return isValid;
}
function validateSubmissionForm() {
    let isValid = true;

    // Clear previous error messages
    document.getElementById('contentLinkError').innerText = '';
    document.getElementById('proofFileError').innerText = '';

    // Validate content link
    const contentLink = document.getElementById('content_link').value.trim();
    if (contentLink === '') {
        document.getElementById('contentLinkError').innerText = 'Promotional content link is required.';
        isValid = false;
    }

    // Validate proof file
    const proofFile = document.getElementById('proof_file').value;
    if (proofFile === '') {
        document.getElementById('proofFileError').innerText = 'Proof file is required.';
        isValid = false;
    }

    return isValid;
}