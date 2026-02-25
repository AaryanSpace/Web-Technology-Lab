/**
 * FUNCTION: calculate(operator)
 * This function runs whenever the user clicks one of the math buttons (+, -, *, /).
 * The 'operator' parameter tells the function which button was clicked.
 */
function calculate(operator) {
    
    // VIVA POINT 1: Getting the values from the HTML input boxes.
    // 'document.getElementById' finds the input box in the HTML.
    // '.value' gets the text the user typed into that box.
    // 'Number()' converts that text into an actual mathematical number.
    let num1 = Number(document.getElementById("num1").value);
    let num2 = Number(document.getElementById("num2").value);
    
    // Create a variable to hold our final answer. It is currently empty.
    let result;

    // VIVA POINT 2: Input Validation (Checking for empty boxes)
    // The '===' means "exactly equals". The '||' means "OR".
    // If either the first box OR the second box is empty (""), we show a warning.
    if (document.getElementById("num1").value === "" || 
        document.getElementById("num2").value === "") {
        
        result = "Please enter valid numbers";
    
    } 
    // VIVA POINT 3: The Logic (If / Else If statements)
    // If the inputs are valid, we check which operator was passed into the function.
    else if (operator === '+') {
        result = num1 + num2; // Addition
    } 
    else if (operator === '-') {
        result = num1 - num2; // Subtraction
    } 
    else if (operator === '*') {
        result = num1 * num2; // Multiplication
    } 
    else if (operator === '/') {
        
        // VIVA POINT 4: Handling Division by Zero
        // In math, you cannot divide a number by zero. This 'if' statement 
        // prevents the calculator from breaking or showing "Infinity".
        if (num2 === 0) {
            result = "Cannot divide by zero";
        } else {
            result = num1 / num2; // Safe Division
        }
    }

    // VIVA POINT 5: Displaying the result on the webpage.
    // This finds the HTML element with the id="result" (usually an <h3> tag)
    // and changes its visible text to show our final answer.
    document.getElementById("result").innerText = "Result: " + result;
}