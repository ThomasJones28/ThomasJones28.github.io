<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Thomas">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculators</title>
    <link rel="stylesheet" href="my_style.css">
    <script src="2-calculator.js"></script>
    <script src="2-calculator_utils.js"></script>
</head>
<body>
    <?php include_once('nav.php'); ?>
    <h1> Some calculators! </h1>

        
        <div class="calculator_div">
        
        
            <fieldset>
                <legend> How old are you in terms of days? </legend>
                <div>
                    <input type="date" id="DOB">
                    <label for="DOB"> Your date of birth </label>
                </div>
                <div>
                    <input type="button" id="submit_days" value="Click here to compute" onclick="compute_days()">
                </div>
                <div class="answer">
                    <p> The answer is: </p>
                    <p id="p_answer_days"> (click submit first!) </p>
                </div>
            </fieldset>
            
            
            <fieldset class="right">
                <legend> The radius and area of the biggest circle fitting in your screen </legend>
                <div>
                    <input type="button" id="submit_circle" value="Click here to compute" onclick="compute_circle()">
                </div>
                <div class="answer">
                    <p> The answer is: </p>
                    <p id="p_answer_circle"> (click submit first!) </p>
                </div>
            </fieldset>
            
            
            <fieldset>
                <legend> Palindrome checker </legend>
                <div>
                    <input type="text" id="possible_palindrome" value="Enter text here">
                </div>
                <div>
                    <input type="button" id="submit_palindrome" value="Click here to compute" onclick="check_palindrome()">
                </div>
                <div  class="answer">
                    <p> The answer is: </p>
                    <p id="p_answer_palindrome"> (click submit first!) </p>
                </div>
            </fieldset>
            
            
            <fieldset class="right">
                <legend> Fibonacci </legend>
                <div>
                    <label for="fibo_length"> How long would you like me to create the Fibonacci sequence?"
                    <input type="number" id="fibo_length">
                </div>
                <div>
                    <input type="button" id="submit_fibo" value="Click here to compute" onclick="create_fibo()">
                </div>
                <div class="answer">
                    <p> The answer is: </p>
                    <p id="p_answer_fibo"> (click submit first!) </p>
                </div>
            </fieldset>
                
                
        </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
