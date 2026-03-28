/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 7: EVENT HANDLING - PERSONAL WEBSITE
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * Demonstrates various event handling mechanisms in JavaScript
 * including:
 * - Click events
 * - Hover events
 * - Form events
 * - Mobile menu toggle
 * - Smooth navigation
 * 
 * CONCEPTS COVERED:
 * 1. Event Listeners (onclick, onmouseover, onmouseout, etc.)
 * 2. Event Objects and preventDefault()
 * 3. DOM Manipulation
 * 4. Conditional Logic
 * 5. Animation and Visual Feedback
 */

// ═══════════════════════════════════════════════════════════════
// SECTION 1: NAVIGATION EVENTS
// ═══════════════════════════════════════════════════════════════

/**
 * handleNavigation(event, sectionId)
 * 
 * Handles navigation link clicks
 * Prevents default anchor behavior and shows relevant section
 * 
 * PARAMETERS:
 * - event: The click event object
 * - sectionId: The ID of the section to navigate to
 */
function handleNavigation(event, sectionId) {
    // Prevent default anchor link behavior
    // This stops the page from jumping to the anchor
    event.preventDefault();

    console.log('Navigating to: ' + sectionId);

    // Get all sections and hide them
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    // Show the selected section
    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
        // Smooth scroll to top
        selectedSection.scrollIntoView({ behavior: 'smooth' });
    }

    // Close mobile menu if open
    const navLinks = document.getElementById('navLinks');
    navLinks.classList.remove('active');
}

/**
 * toggleMobileMenu()
 * 
 * Toggles the mobile navigation menu on and off
 * This function is called when hamburger icon is clicked
 * 
 * How it works:
 * 1. Gets the nav-links element
 * 2. Toggles the 'active' class
 * 3. When 'active' class is present, menu is visible
 */
function toggleMobileMenu() {
    // Get the navigation links container
    const navLinks = document.getElementById('navLinks');
    
    // Toggle the 'active' class
    // classList.toggle() adds class if not present, removes if present
    navLinks.classList.toggle('active');

    // Log the current state
    console.log('Mobile menu toggled');
}

// ═══════════════════════════════════════════════════════════════
// SECTION 2: BUTTON HOVER EVENTS
// ═══════════════════════════════════════════════════════════════

/**
 * handleButtonHover(element)
 * 
 * Handles mouse over event on buttons
 * Creates hover effect by changing button style
 * 
 * PARAMETERS:
 * - element: The button element being hovered
 */
function handleButtonHover(element) {
    // Change button appearance on hover
    element.style.transform = 'scale(1.05)';
    element.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.3)';
    
    console.log('Button hovered');
}

/**
 * handleButtonOut(element)
 * 
 * Handles mouse out event on buttons
 * Restores button to original state
 * 
 * PARAMETERS:
 * - element: The button element where mouse left
 */
function handleButtonOut(element) {
    // Restore button to original state
    element.style.transform = 'scale(1)';
    element.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.2)';
    
    console.log('Button unhovered');
}

/**
 * handleCTAClick()
 * 
 * Handles click event on the main CTA (Call-to-Action) button
 * Shows an alert and navigates to contact section
 */
function handleCTAClick() {
    // Show notification to user
    alert('Welcome! Let\'s create something amazing together! 🚀');
    
    // Navigate to contact section
    const contactSection = document.getElementById('contact');
    if (contactSection) {
        contactSection.scrollIntoView({ behavior: 'smooth' });
    }
}

// ═══════════════════════════════════════════════════════════════
// SECTION 3: SKILL BUTTON EVENTS
// ═══════════════════════════════════════════════════════════════

/**
 * toggleSkillDetails(event)
 * 
 * Handles click event on skill buttons
 * Displays details about the selected skill
 * 
 * PARAMETERS:
 * - event: The click event object
 */
function toggleSkillDetails(event) {
    // Get the clicked button element
    const button = event.target;
    
    // Get the skill name from button text
    const skillName = button.textContent;
    
    // Define skill descriptions
    const skillDescriptions = {
        'HTML5': '✓ Semantic HTML5 structure\n✓ SEO optimization\n✓ Accessibility compliance',
        'CSS3': '✓ Flexbox and Grid layouts\n✓ Responsive design\n✓ Animations and transitions',
        'JavaScript': '✓ DOM manipulation\n✓ Event handling\n✓ Async/await and Promises',
        'PHP': '✓ Server-side scripting\n✓ Form handling\n✓ Database operations',
        'MySQL': '✓ Database design\n✓ Query optimization\n✓ Relationships and joins',
        'Git': '✓ Version control\n✓ Repository management\n✓ Team collaboration'
    };

    // Get the skill details div
    const skillDetailsDiv = document.getElementById('skillDetails');
    const skillText = document.getElementById('skillText');

    // If clicking the same skill again, hide details
    if (skillDetailsDiv.style.display === 'block' && skillText.textContent.includes(skillName)) {
        skillDetailsDiv.style.display = 'none';
    } else {
        // Show details for clicked skill
        if (skillDescriptions[skillName]) {
            skillText.textContent = skillName + '\n' + skillDescriptions[skillName];
            skillDetailsDiv.style.display = 'block';
        }
    }

    // Change button style when clicked
    button.style.backgroundColor = '#667eea';
    button.style.color = 'white';

    console.log('Skill clicked: ' + skillName);
}

// ═══════════════════════════════════════════════════════════════
// SECTION 4: PROJECT CARD EVENTS
// ═══════════════════════════════════════════════════════════════

/**
 * handleProjectHover(element)
 * 
 * Handles mouse over event on project cards
 * Creates lift and shadow effect
 * 
 * PARAMETERS:
 * - element: The project card element
 */
function handleProjectHover(element) {
    // Add hover effect with transform
    element.style.transform = 'translateY(-10px)';
    element.style.boxShadow = '0 15px 40px rgba(0, 0, 0, 0.3)';
    
    console.log('Project card hovered');
}

/**
 * handleProjectOut(element)
 * 
 * Handles mouse out event on project cards
 * Restores card to original position
 * 
 * PARAMETERS:
 * - element: The project card element
 */
function handleProjectOut(element) {
    // Restore card to original position
    element.style.transform = 'translateY(0)';
    element.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
}

/**
 * handleProjectClick(element)
 * 
 * Handles click event on project cards
 * Shows project details
 * 
 * PARAMETERS:
 * - element: The project card element
 */
function handleProjectClick(element) {
    // Get project title
    const projectTitle = element.querySelector('h3').textContent;
    
    // Show project details alert
    alert('Project: ' + projectTitle + '\n\nClick "View Details" to learn more!');
    
    console.log('Project clicked: ' + projectTitle);
}

// ═══════════════════════════════════════════════════════════════
// SECTION 5: FORM EVENTS
// ═══════════════════════════════════════════════════════════════

/**
 * handleFormFocus(event)
 * 
 * Handles focus event on form inputs
 * Adds visual feedback when input is focused
 * 
 * PARAMETERS:
 * - event: The focus event object
 */
function handleFormFocus(event) {
    // Get the input element
    const input = event.target;
    
    // Add focus styling
    input.style.borderColor = '#667eea';
    input.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)';
    input.style.backgroundColor = '#f9f9f9';
    
    console.log('Form input focused: ' + input.placeholder);
}

/**
 * handleFormBlur(event)
 * 
 * Handles blur event on form inputs
 * Removes focus styling when input loses focus
 * 
 * PARAMETERS:
 * - event: The blur event object
 */
function handleFormBlur(event) {
    // Get the input element
    const input = event.target;
    
    // Remove focus styling
    input.style.borderColor = '#e0e0e0';
    input.style.boxShadow = 'none';
    input.style.backgroundColor = 'white';
    
    console.log('Form input blurred: ' + input.placeholder);
}

/**
 * handleContactSubmit(event)
 * 
 * Handles contact form submission
 * Validates and processes form data
 * 
 * PARAMETERS:
 * - event: The form submit event object
 */
function handleContactSubmit(event) {
    // Prevent default form submission (prevents page reload)
    event.preventDefault();

    // Get form data
    const form = event.target;
    const inputs = form.querySelectorAll('input, textarea');
    let isValid = true;
    let formData = {};

    // Validate each input
    inputs.forEach(input => {
        // Check if input is empty
        if (input.value.trim() === '') {
            // Show error state
            input.style.borderColor = '#dc2626';
            isValid = false;
        } else {
            // Clear error state
            input.style.borderColor = '#e0e0e0';
            formData[input.placeholder] = input.value;
        }
    });

    // Get the message display element
    const messageDiv = document.getElementById('contactMessage');

    // If valid, show success message
    if (isValid && Object.keys(formData).length === 3) {
        messageDiv.innerHTML = '✓ Message sent successfully! Thank you for contacting us.';
        messageDiv.style.color = '#10b981';
        messageDiv.style.display = 'block';

        // Log form data
        console.log('Form submitted:', formData);

        // Reset form
        form.reset();

        // Hide message after 5 seconds
        setTimeout(() => {
            messageDiv.style.display = 'none';
        }, 5000);
    } else {
        // Show error message
        messageDiv.innerHTML = '✗ Please fill in all fields correctly.';
        messageDiv.style.color = '#dc2626';
        messageDiv.style.display = 'block';
    }

    return false;
}

// ═══════════════════════════════════════════════════════════════
// SECTION 6: PAGE LOAD INITIALIZATION
// ═══════════════════════════════════════════════════════════════

/**
 * Initialize all event listeners and set up the page
 * This runs when the page loads
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded - Event handlers initialized');

    // Show home section by default
    const homeSection = document.getElementById('home');
    if (homeSection) {
        homeSection.style.display = 'block';
    }

    // Add keyboard event listener for ESC key
    document.addEventListener('keydown', function(event) {
        // If ESC key is pressed, close mobile menu
        if (event.key === 'Escape') {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.remove('active');
            console.log('Mobile menu closed with ESC key');
        }
    });

    // Add scroll event listener to change navbar on scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        
        // If page is scrolled more than 100px, add shadow to navbar
        if (window.scrollY > 100) {
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.boxShadow = 'none';
        }
    });
});

// ═══════════════════════════════════════════════════════════════
// END OF EXERCISE 7 - EVENT HANDLING (PERSONAL WEBSITE)
// ═══════════════════════════════════════════════════════════════
