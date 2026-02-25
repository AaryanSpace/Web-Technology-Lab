// 1. Grab the display screen from HTML
const display = document.getElementById('display');

// 2. Create a variable to keep track of what the user is typing
let currentInput = '';

/**
 * FUNCTION 1: appendValue(value)
 */
function appendValue(value) {
    // Prevent the user from starting the math with an operator like '*' or '/'
    if (currentInput === '' && ['+', '*', '/', '%'].includes(value)) {
        return; 
    }
    currentInput += value;
    display.innerText = currentInput;
}

/**
 * FUNCTION 2: clearDisplay()
 */
function clearDisplay() {
    currentInput = '';          
    display.innerText = '0';    
}

/**
 * FUNCTION 3: deleteLast()
 */
function deleteLast() {
    currentInput = currentInput.slice(0, -1);
    display.innerText = currentInput === '' ? '0' : currentInput;
}

/**
 * FUNCTION 4: calculateResult()
 * VIVA POINT: This is where we fixed the percentage logic!
 */
function calculateResult() {
    try {
        if (currentInput === '') return;

        let mathExpression = currentInput;

        // VIVA POINT FIX 1: Handle Addition & Subtraction with Percentages (e.g., 500 - 50%)
        // This regex looks for: (Number) (+ or -) (Number) %
        // It replaces it with: Number +/- (Number * Percentage / 100)
        mathExpression = mathExpression.replace(/(\d+\.?\d*)([\+\-])(\d+\.?\d*)%/g, function(match, num1, operator, num2) {
            return num1 + operator + '(' + num1 + '*' + num2 + '/100)';
        });

        // VIVA POINT FIX 2: Handle Multiplication & Division with Percentages (e.g., 500 * 50%)
        // This replaces it with: Number * (Percentage / 100)
        mathExpression = mathExpression.replace(/(\d+\.?\d*)([\*\/])(\d+\.?\d*)%/g, function(match, num1, operator, num2) {
            return num1 + operator + '(' + num2 + '/100)';
        });

        // VIVA POINT FIX 3: Handle leftover standalone percentages (e.g., just "50%")
        mathExpression = mathExpression.replace(/(\d+\.?\d*)%/g, '($1/100)');

        // Now calculate the corrected expression
        let result = eval(mathExpression);
        
        // Convert to string and show on screen
        currentInput = result.toString();
        display.innerText = currentInput;

    } catch (error) {
        display.innerText = 'Error';
        currentInput = ''; 
    }
}