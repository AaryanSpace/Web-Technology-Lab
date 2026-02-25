const display = document.getElementById('display');
let currentInput = '';

/**
 * Standard value appending
 */
function appendValue(value) {
    if (currentInput === '' && ['+', '*', '/', '^', '%'].includes(value)) return; 
    currentInput += value;
    display.innerText = currentInput;
}

/**
 * VIVA POINT: Specific function for Scientific Operators.
 * When the user clicks "sin", it types "sin(" on the screen to guide them 
 * to put a number inside the brackets.
 */
function appendFunction(funcName) {
    currentInput += funcName + '(';
    display.innerText = currentInput;
}

function clearDisplay() {
    currentInput = '';          
    display.innerText = '0';    
}

function deleteLast() {
    currentInput = currentInput.slice(0, -1);
    display.innerText = currentInput === '' ? '0' : currentInput;
}

/**
 * VIVA POINT: The Engine of the Scientific Calculator
 */
function calculateResult() {
    try {
        if (currentInput === '') return;

        let mathExpression = currentInput;

        // --- PRE-PROCESSING THE STRING FOR JAVASCRIPT ---
        
        // 1. Replace constants (Pi and Euler's Number)
        mathExpression = mathExpression.replace(/π/g, 'Math.PI');
        mathExpression = mathExpression.replace(/e/g, 'Math.E');
        
        // 2. Replace the visual power symbol '^' with JavaScript's power operator '**'
        mathExpression = mathExpression.replace(/\^/g, '**');

        // 3. Replace Square Root (√) with Math.sqrt
        mathExpression = mathExpression.replace(/√\(/g, 'Math.sqrt(');

        // 4. Replace Logarithms
        // Note: Math.log in JS is actually natural log (ln). Math.log10 is base 10 (log).
        mathExpression = mathExpression.replace(/log\(/g, 'Math.log10(');
        mathExpression = mathExpression.replace(/ln\(/g, 'Math.log(');

        // 5. Replace Trigonometry Functions
        // VIVA POINT: Standard Math.sin() uses radians. For a school project, this is fine, 
        // but if your examiner asks, you can mention that real calculators convert degrees to radians first.
        mathExpression = mathExpression.replace(/sin\(/g, 'Math.sin(');
        mathExpression = mathExpression.replace(/cos\(/g, 'Math.cos(');
        mathExpression = mathExpression.replace(/tan\(/g, 'Math.tan(');

        // 6. Handle Percentages (From previous logic)
        mathExpression = mathExpression.replace(/(\d+\.?\d*)([\+\-])(\d+\.?\d*)%/g, function(match, num1, operator, num2) {
            return num1 + operator + '(' + num1 + '*' + num2 + '/100)';
        });
        mathExpression = mathExpression.replace(/(\d+\.?\d*)([\*\/])(\d+\.?\d*)%/g, function(match, num1, operator, num2) {
            return num1 + operator + '(' + num2 + '/100)';
        });
        mathExpression = mathExpression.replace(/(\d+\.?\d*)%/g, '($1/100)');

        // Evaluate the final mapped string
        let result = eval(mathExpression);
        
        // Fix floating point errors (e.g., 0.1 + 0.2 = 0.30000000000000004)
        // This rounds it cleanly to 8 decimal places if necessary
        result = Math.round(result * 100000000) / 100000000;
        
        currentInput = result.toString();
        display.innerText = currentInput;

    } catch (error) {
        // Catches syntax errors (like forgetting to close a bracket)
        display.innerText = 'Syntax Error';
        currentInput = ''; 
    }
}