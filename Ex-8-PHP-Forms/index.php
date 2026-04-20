<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 8 - PHP Form Handling</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }
        
        .header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .forms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
        }
        
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }
        
        .form-card h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }
        
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        
        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        button:hover {
            background: #764ba2;
            transform: translateY(-2px);
        }
        
        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .success {
            color: #10b981;
            padding: 15px;
            background: #f0fdf4;
            border-radius: 8px;
            margin-top: 15px;
            text-align: center;
        }
        
        .note {
            background: #fef3c7;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #92400e;
        }
        
        @media (max-width: 768px) {
            .forms-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Exercise 8: PHP Form Handling & Validation</h1>
            <p>Server-side form validation and processing</p>
        </div>
        
        <div class="forms-grid">
            <!-- Personal Website Contact Form -->
            <div class="form-card">
                <h2>📧 Contact Form (Personal Website)</h2>
                <div class="note">
                    This form demonstrates server-side validation using PHP. Submit to see validation in action.
                </div>
                
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
                        <div class="error" id="nameError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        <div class="error" id="emailError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="10-digit phone number" required>
                        <div class="error" id="phoneError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" placeholder="Message subject" required>
                        <div class="error" id="subjectError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" placeholder="Your message" rows="4" required></textarea>
                        <div class="error" id="messageError"></div>
                    </div>
                    
                    <button type="submit">Submit Contact Form</button>
                    <div id="contactSuccess"></div>
                </form>
            </div>
            
            <!-- E-Commerce Registration Form -->
            <div class="form-card">
                <h2>👤 Registration Form (E-Commerce)</h2>
                <div class="note">
                    Complete registration with password hashing and validation. All fields required.
                </div>
                
                <form id="registrationForm">
                    <div class="form-group">
                        <label for="fullName">Full Name *</label>
                        <input type="text" id="fullName" name="fullName" placeholder="Your full name" required>
                        <div class="error" id="fullNameError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="regEmail">Email *</label>
                        <input type="email" id="regEmail" name="email" placeholder="your@email.com" required>
                        <div class="error" id="regEmailError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="regPhone">Phone *</label>
                        <input type="tel" id="regPhone" name="phone" placeholder="10 digits" required>
                        <div class="error" id="regPhoneError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="regPassword">Password *</label>
                        <input type="password" id="regPassword" name="password" placeholder="Min 8 characters" required>
                        <div class="error" id="regPasswordError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPass">Confirm Password *</label>
                        <input type="password" id="confirmPass" name="confirmPassword" placeholder="Confirm your password" required>
                        <div class="error" id="confirmPassError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address *</label>
                        <textarea id="address" name="address" placeholder="Your address" rows="2" required></textarea>
                        <div class="error" id="addressError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="city">City *</label>
                        <input type="text" id="city" name="city" placeholder="City name" required>
                        <div class="error" id="cityError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="postalCode">Postal Code *</label>
                        <input type="text" id="postalCode" name="postalCode" placeholder="5-6 digits" required>
                        <div class="error" id="postalCodeError"></div>
                    </div>
                    
                    <button type="submit">Register Account</button>
                    <div id="registrationSuccess"></div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Form Processing Script -->
    <script>
        /**
         * Submit Contact Form to PHP Backend
         */
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Create FormData object from form
            const formData = new FormData(this);
            
            // Send to PHP processor via fetch API
            fetch('process_personal_contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Handle response from PHP
                if (data.success) {
                    // Show success message
                    document.getElementById('contactSuccess').innerHTML = 
                        '<div class="success">✓ ' + data.message + '</div>';
                    document.getElementById('contactForm').reset();
                } else {
                    // Display errors
                    Object.keys(data.errors).forEach(field => {
                        const errorElement = document.getElementById(field + 'Error');
                        if (errorElement) {
                            errorElement.textContent = '✗ ' + data.errors[field];
                        }
                    });
                }
            });
        });
        
        /**
         * Submit Registration Form to PHP Backend
         */
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Create FormData object
            const formData = new FormData(this);
            formData.append('formType', 'registration');
            
            // Send to PHP processor
            fetch('process_ecommerce_forms.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('registrationSuccess').innerHTML = 
                        '<div class="success">✓ ' + data.message + '</div>';
                    document.getElementById('registrationForm').reset();
                } else {
                    // Display errors returned from PHP
                    Object.keys(data.errors).forEach(field => {
                        let errorFieldName = field;
                        if (field === 'email') errorFieldName = 'regEmail';
                        if (field === 'phone') errorFieldName = 'regPhone';
                        if (field === 'password') errorFieldName = 'regPassword';
                        if (field === 'confirmPassword') errorFieldName = 'confirmPass';
                        
                        const errorElement = document.getElementById(errorFieldName + 'Error');
                        if (errorElement) {
                            errorElement.textContent = '✗ ' + data.errors[field];
                        }
                    });
                }
            });
        });
        
        // Clear errors on input focus
        document.querySelectorAll('input, textarea').forEach(field => {
            field.addEventListener('focus', function() {
                const errorId = this.id || this.name;
                const errorElement = document.getElementById(errorId + 'Error');
                if (errorElement) {
                    errorElement.textContent = '';
                }
            });
        });
    </script>
</body>
</html>
