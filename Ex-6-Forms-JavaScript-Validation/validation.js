/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 6: JavaScript Form Validation
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * This script demonstrates comprehensive form validation using
 * JavaScript. It validates registration and login forms with:
 * - Real-time input validation
 * - Error message display
 * - Password strength indicator
 * - Email format validation
 * - Phone number validation
 * 
 * CONCEPTS COVERED:
 * 1. Event Listeners (onsubmit)
 * 2. DOM Manipulation (getElementById, textContent)
 * 3. Regular Expressions (RegExp patterns)
 * 4. Conditional Logic (if-else statements)
 * 5. Form Validation Techniques
 * 6. User Feedback (error/success messages)
 * 7. Browser's preventDefault() method
 */

// ═══════════════════════════════════════════════════════════════
// SECTION 1: REGISTRATION FORM VALIDATION
// ═══════════════════════════════════════════════════════════════

/**
 * handleRegistration(event)
 * 
 * Main function to handle registration form submission
 * Validates all form fields before allowing submission
 * 
 * PARAMETERS:
 * - event: The form submit event object
 * 
 * RETURNS: true if valid, false otherwise
 */
function handleRegistration(event) {
    // Prevent the form from being submitted to server
    // This allows us to validate on client-side first
    event.preventDefault();

    // Clear all previous error messages
    clearAllErrors();

    // Validate each field and store results
    const isFullNameValid = validateFullName();
    const isEmailValid = validateEmail('registration');
    const isPhoneValid = validatePhone();
    const isPasswordValid = validatePassword();
    const isConfirmPasswordValid = validateConfirmPassword();
    const isAddressValid = validateAddress();
    const isCityValid = validateCity();
    const isPostalCodeValid = validatePostalCode();
    const isGenderValid = validateGender();
    const isTermsValid = validateTerms();

    // If ALL validations pass, show success message
    if (isFullNameValid && isEmailValid && isPhoneValid && 
        isPasswordValid && isConfirmPasswordValid && isAddressValid && 
        isCityValid && isPostalCodeValid && isGenderValid && isTermsValid) {
        
        // Display success message
        const successMsg = document.getElementById('successMessage');
        successMsg.style.display = 'block';

        // Collect form data
        const formData = {
            fullName: document.getElementById('fullName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,
            city: document.getElementById('city').value,
            postalCode: document.getElementById('postalCode').value,
            gender: document.querySelector('input[name="gender"]:checked').value,
            newsletter: document.getElementById('newsletter').checked
        };

        // Log registered user data (in real app, send to server)
        console.log('User registered:', formData);

        // Simulate form submission delay
        setTimeout(() => {
            // In real scenario: send data to server via PHP or API
            // For now, redirect to login page
            window.location.href = 'login.html';
        }, 2000);

        return false;
    }

    // If validation failed, show error and don't submit
    console.log('Form validation failed. Please correct the errors.');
    return false;
}

// ═══════════════════════════════════════════════════════════════
// SECTION 2: LOGIN FORM VALIDATION
// ═══════════════════════════════════════════════════════════════

/**
 * handleLogin(event)
 * 
 * Main function to handle login form submission
 * Validates login email and password fields
 * 
 * PARAMETERS:
 * - event: The form submit event object
 */
function handleLogin(event) {
    // Prevent default form submission
    event.preventDefault();

    // Clear all previous error messages
    clearAllErrors();

    // Validate login fields
    const isEmailValid = validateLoginEmail();
    const isPasswordValid = validateLoginPassword();

    // If both fields are valid
    if (isEmailValid && isPasswordValid) {
        // Get form values
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;
        const rememberMe = document.getElementById('rememberMe').checked;

        // Simple demo authentication (in real app, verify against database)
        // Demo credentials: demo@pahirango.com / Demo@123
        if (email === 'demo@pahirango.com' && password === 'Demo@123') {
            // Show success message
            const successMsg = document.getElementById('loginSuccessMessage');
            successMsg.style.display = 'block';

            // If "Remember Me" is checked, store username in localStorage
            if (rememberMe) {
                // localStorage is a browser storage mechanism
                localStorage.setItem('rememberedEmail', email);
            } else {
                // Remove remembered email if unchecked
                localStorage.removeItem('rememberedEmail');
            }

            // Log successful login
            console.log('Login successful for:', email);

            // Redirect to dashboard after 1.5 seconds
            setTimeout(() => {
                window.location.href = 'dashboard.html';
            }, 1500);
        } else {
            // Show error if credentials don't match
            const errorDiv = document.getElementById('loginGeneralError');
            errorDiv.textContent = '✗ Invalid email or password. Please try again.';
            errorDiv.style.color = '#dc2626';
        }

        return false;
    }

    return false;
}

// ═══════════════════════════════════════════════════════════════
// SECTION 3: INDIVIDUAL FIELD VALIDATION FUNCTIONS
// ═══════════════════════════════════════════════════════════════

/**
 * validateFullName()
 * 
 * Validates the full name field
 * Rules:
 * - Must not be empty
 * - Must be at least 3 characters
 * - Must not contain numbers
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateFullName() {
    const fullName = document.getElementById('fullName').value.trim();
    const errorElement = document.getElementById('fullNameError');

    // Check if field is empty
    if (fullName === '') {
        errorElement.textContent = '✗ Full name is required';
        return false;
    }

    // Check if name is at least 3 characters
    if (fullName.length < 3) {
        errorElement.textContent = '✗ Name must be at least 3 characters';
        return false;
    }

    // Regular expression: checks if name contains only letters and spaces
    // ^ = start, [a-zA-Z\s] = only letters a-z, A-Z and spaces, + = one or more, $ = end
    const nameRegex = /^[a-zA-Z\s]+$/;
    if (!nameRegex.test(fullName)) {
        errorElement.textContent = '✗ Name should not contain numbers or special characters';
        return false;
    }

    // If all checks pass, clear error and return true
    errorElement.textContent = '';
    return true;
}

/**
 * validateEmail(formType)
 * 
 * Validates the email field
 * Rules:
 * - Must not be empty
 * - Must match valid email format
 * 
 * PARAMETERS:
 * - formType: 'registration' or 'login' (to identify which form)
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateEmail(formType) {
    const emailField = formType === 'registration' ? 'email' : 'loginEmail';
    const errorField = formType === 'registration' ? 'emailError' : 'loginEmailError';
    
    const email = document.getElementById(emailField).value.trim();
    const errorElement = document.getElementById(errorField);

    // Check if field is empty
    if (email === '') {
        errorElement.textContent = '✗ Email is required';
        return false;
    }

    // Regular expression for email validation
    // Matches: word characters @ domain . extension
    // Example: user@example.com
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errorElement.textContent = '✗ Please enter a valid email address';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

/**
 * validatePhone()
 * 
 * Validates the phone number field (for registration)
 * Rules:
 * - Must not be empty
 * - Must be exactly 10 digits
 * - Must not contain letters or special characters
 * 
 * RETURNS: true if valid, false otherwise
 */
function validatePhone() {
    const phone = document.getElementById('phone').value.trim();
    const errorElement = document.getElementById('phoneError');

    // Check if field is empty
    if (phone === '') {
        errorElement.textContent = '✗ Phone number is required';
        return false;
    }

    // Regular expression: exactly 10 digits
    // ^[0-9]{10}$ = start, 10 digits 0-9, end
    const phoneRegex = /^[0-9]{10}$/;
    if (!phoneRegex.test(phone)) {
        errorElement.textContent = '✗ Phone number must be exactly 10 digits';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

/**
 * validatePassword()
 * 
 * Validates the password field (registration form)
 * Rules:
 * - Must not be empty
 * - Must be at least 8 characters
 * - Must contain at least one uppercase letter
 * - Must contain at least one lowercase letter
 * - Must contain at least one number
 * - Must contain at least one special character (!@#$%^&*)
 * 
 * RETURNS: true if valid, false otherwise
 */
function validatePassword() {
    const password = document.getElementById('password').value;
    const errorElement = document.getElementById('passwordError');
    const strengthMeter = document.getElementById('strengthMeter');
    const strengthText = document.getElementById('strengthText');

    // Check if field is empty
    if (password === '') {
        errorElement.textContent = '✗ Password is required';
        strengthMeter.style.width = '0%';
        strengthText.textContent = '';
        return false;
    }

    // Initialize strength score
    let strength = 0;

    // Check password length (must be at least 8)
    if (password.length >= 8) {
        strength += 25;
    } else {
        errorElement.textContent = '✗ Password must be at least 8 characters';
        strengthMeter.style.width = strength + '%';
        strengthText.textContent = 'Weak';
        return false;
    }

    // Check for uppercase letters (A-Z)
    if (/[A-Z]/.test(password)) {
        strength += 25;
    } else {
        errorElement.textContent = '✗ Password must contain at least one uppercase letter';
        strengthMeter.style.width = strength + '%';
        strengthText.textContent = strength < 50 ? 'Weak' : 'Medium';
        return false;
    }

    // Check for lowercase letters (a-z)
    if (/[a-z]/.test(password)) {
        strength += 25;
    } else {
        errorElement.textContent = '✗ Password must contain at least one lowercase letter';
        strengthMeter.style.width = strength + '%';
        strengthText.textContent = strength < 50 ? 'Weak' : 'Medium';
        return false;
    }

    // Check for numbers (0-9)
    if (/[0-9]/.test(password)) {
        strength += 25;
    } else {
        errorElement.textContent = '✗ Password must contain at least one number';
        strengthMeter.style.width = strength + '%';
        strengthText.textContent = 'Medium';
        return false;
    }

    // If all checks pass, show strength indicator
    errorElement.textContent = '';
    strengthMeter.style.width = strength + '%';
    
    // Display appropriate strength level
    if (strength === 100) {
        strengthMeter.style.backgroundColor = '#10b981'; // Green
        strengthText.textContent = 'Strong';
    } else if (strength >= 75) {
        strengthMeter.style.backgroundColor = '#f59e0b'; // Orange
        strengthText.textContent = 'Good';
    } else {
        strengthMeter.style.backgroundColor = '#ef4444'; // Red
        strengthText.textContent = 'Medium';
    }

    return true;
}

/**
 * validateConfirmPassword()
 * 
 * Validates that confirm password matches the password field
 * Rules:
 * - Must not be empty
 * - Must match the password field exactly
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateConfirmPassword() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const errorElement = document.getElementById('confirmPasswordError');

    // Check if field is empty
    if (confirmPassword === '') {
        errorElement.textContent = '✗ Please confirm your password';
        return false;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        errorElement.textContent = '✗ Passwords do not match';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

/**
 * validateAddress()
 * 
 * Validates the address field
 * Rules:
 * - Must not be empty
 * - Must be at least 10 characters
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateAddress() {
    const address = document.getElementById('address').value.trim();
    const errorElement = document.getElementById('addressError');

    // Check if field is empty
    if (address === '') {
        errorElement.textContent = '✗ Address is required';
        return false;
    }

    // Check minimum length
    if (address.length < 10) {
        errorElement.textContent = '✗ Address must be at least 10 characters';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

/**
 * validateCity()
 * 
 * Validates the city field
 * Rules:
 * - Must not be empty
 * - Must not contain numbers
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateCity() {
    const city = document.getElementById('city').value.trim();
    const errorElement = document.getElementById('cityError');

    // Check if field is empty
    if (city === '') {
        errorElement.textContent = '✗ City is required';
        return false;
    }

    // Check if city contains only letters
    if (!/^[a-zA-Z\s]+$/.test(city)) {
        errorElement.textContent = '✗ City should contain only letters';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

/**
 * validatePostalCode()
 * 
 * Validates the postal code field
 * Rules:
 * - Must not be empty
 * - Must be 5-6 digits
 * 
 * RETURNS: true if valid, false otherwise
 */
function validatePostalCode() {
    const postalCode = document.getElementById('postalCode').value.trim();
    const errorElement = document.getElementById('postalCodeError');

    // Check if field is empty
    if (postalCode === '') {
        errorElement.textContent = '✗ Postal code is required';
        return false;
    }

    // Check if postal code is 5-6 digits
    if (!/^[0-9]{5,6}$/.test(postalCode)) {
        errorElement.textContent = '✗ Postal code must be 5-6 digits';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

/**
 * validateGender()
 * 
 * Validates that a gender option is selected
 * Rules:
 * - At least one radio button must be checked
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateGender() {
    // Get all radio buttons with name="gender"
    const genderOptions = document.querySelectorAll('input[name="gender"]');
    const errorElement = document.getElementById('genderError');

    // Check if at least one is checked
    // some() returns true if at least one element matches the condition
    const isChecked = Array.from(genderOptions).some(option => option.checked);

    if (!isChecked) {
        errorElement.textContent = '✗ Please select your gender';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

/**
 * validateTerms()
 * 
 * Validates that terms and conditions are accepted
 * Rules:
 * - Checkbox must be checked
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateTerms() {
    const termsCheckbox = document.getElementById('terms');
    const errorElement = document.getElementById('termsError');

    // Check if checkbox is checked
    if (!termsCheckbox.checked) {
        errorElement.textContent = '✗ You must agree to Terms & Conditions';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

// ═══════════════════════════════════════════════════════════════
// SECTION 4: LOGIN FORM SPECIFIC VALIDATION
// ═══════════════════════════════════════════════════════════════

/**
 * validateLoginEmail()
 * 
 * Validates the login email field
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateLoginEmail() {
    const email = document.getElementById('loginEmail').value.trim();
    const errorElement = document.getElementById('loginEmailError');

    // Check if field is empty
    if (email === '') {
        errorElement.textContent = '✗ Email or username is required';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

/**
 * validateLoginPassword()
 * 
 * Validates the login password field
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateLoginPassword() {
    const password = document.getElementById('loginPassword').value;
    const errorElement = document.getElementById('loginPasswordError');

    // Check if field is empty
    if (password === '') {
        errorElement.textContent = '✗ Password is required';
        return false;
    }

    // If valid, clear error
    errorElement.textContent = '';
    return true;
}

// ═══════════════════════════════════════════════════════════════
// SECTION 5: UTILITY FUNCTIONS
// ═══════════════════════════════════════════════════════════════

/**
 * clearAllErrors()
 * 
 * Clears all error messages from the form
 * Useful before revalidating the form
 */
function clearAllErrors() {
    // Get all elements with class "error-message"
    const errorElements = document.querySelectorAll('.error-message');
    
    // Loop through each error element and clear its content
    errorElements.forEach(element => {
        element.textContent = '';
    });
}

/**
 * Real-time password strength indicator
 * This event listener updates strength as user types
 */
document.addEventListener('DOMContentLoaded', function() {
    // Check if password field exists (registration form)
    const passwordField = document.getElementById('password');
    
    if (passwordField) {
        // Add real-time validation as user types
        passwordField.addEventListener('input', function() {
            validatePassword();
        });
    }

    // Check if remembered email should be restored
    const loginEmailField = document.getElementById('loginEmail');
    if (loginEmailField) {
        // Try to get stored email from browser's localStorage
        const rememberedEmail = localStorage.getItem('rememberedEmail');
        
        if (rememberedEmail) {
            // Pre-fill email field with remembered email
            loginEmailField.value = rememberedEmail;
            // Also check the "Remember me" checkbox
            const rememberMeCheckbox = document.getElementById('rememberMe');
            if (rememberMeCheckbox) {
                rememberMeCheckbox.checked = true;
            }
        }
    }
});

// ═══════════════════════════════════════════════════════════════
// END OF EXERCISE 6 - JAVASCRIPT FORM VALIDATION
// ═══════════════════════════════════════════════════════════════
