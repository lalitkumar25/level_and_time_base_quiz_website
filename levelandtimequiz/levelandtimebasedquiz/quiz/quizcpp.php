<?php
session_start();
include 'db.php';

$allowed_levels = ['simple', 'medium', 'hard'];
$level = in_array($_GET['level'] ?? 'simple', $allowed_levels) ? $_GET['level'] : 'simple';
$_SESSION['level'] = $level;

$questions = [
    'simple' => [
        ['Which symbol is used to end a statement in C++?', '.', ':', ';', ',', '3'],
        ['Which function is the starting point in a C++ program?', 'start()', 'main()', 'init()', 'run()', '2'],
        ['Which of these is a correct comment in C++?', '# comment', '// comment', '<!-- comment -->', '-- comment', '2'],
        ['What is the correct file extension for C++ files?', '.cp', '.cplus', '.cpp', '.cxx', '3'],
        ['Which of the following is a valid C++ data type?', 'integer', 'num', 'int', 'number', '3'],
        ['Which keyword is used to create a variable?', 'var', 'define', 'int', 'let', '3'],
        ['What will `cout << "Hello";` output?', 'Hello', '"Hello"', 'cout << Hello', 'Print Hello', '1'],
        ['What does `endl` do in C++?', 'Ends a line', 'Ends program', 'Exits loop', 'Creates space', '1'],
        ['Which operator is used for addition?', '*', '+', '-', '/', '2'],
        ['What is the value of 3 + 4 * 2?', '14', '11', '10', '9', '2'],
        ['Which library is required for `cout`?', '<math.h>', '<iostream>', '<stdio.h>', '<stdlib.h>', '2'],
        ['How do you declare a string variable in C++?', 'string name;', 'str name;', 'text name;', 'String name;', '1'],
        ['How do you read input from the user?', 'scanf()', 'read()', 'cin', 'input()', '3'],
        ['Which of the following is a loop in C++?', 'repeat', 'foreach', 'do-while', 'until', '3'],
        ['Which symbol is used for logical AND?', '&&', '||', '&', '|', '1']
    ]
    'medium' => [
        ['Which keyword is used to define a constant in C++?', 'fixed', 'let', 'const', 'define', '3'],
        ['Which concept allows using the same function name with different parameters?', 'Abstraction', 'Encapsulation', 'Polymorphism', 'Inheritance', '3'],
        ['Which of the following is a loop structure?', 'loop()', 'iterate()', 'for()', 'circle()', '3'],
        ['What is the size of `int` typically?', '2 bytes', '4 bytes', '6 bytes', '8 bytes', '2'],
        ['Which of the following is used to dynamically allocate memory?', 'alloc()', 'malloc()', 'new', 'create()', '3'],
        ['Which access specifier makes a class member accessible only within the class?', 'private', 'protected', 'public', 'internal', '1'],
        ['What will `5 % 2` return?', '2', '1', '0', '3', '2'],
        ['Which of these is used to define a class?', 'function', 'struct', 'class', 'object', '3'],
        ['Which is NOT a valid loop in C++?', 'for', 'while', 'do-while', 'repeat-until', '4'],
        ['What is the output type of `cin`?', 'input stream', 'int', 'char', 'void', '1'],
        ['Which operator is used to compare two values?', '==', '=', '!=', '===', '1'],
        ['What is the purpose of the `break` statement?', 'Restart loop', 'Stop loop', 'Skip iteration', 'Pause loop', '2'],
        ['What does `sizeof(int)` return?', 'Length of variable', 'Size in memory', 'Number of digits', 'None', '2'],
        ['Which function is used to return the length of a string in C++?', 'length()', 'strlen()', 'size()', 'strlength()', '1'],
        ['Which concept hides internal details of an object?', 'Polymorphism', 'Abstraction', 'Encapsulation', 'Inheritance', '3']
    ],

    'hard' => [
        ['What is the output of `cout << 10 / 3;`?', '3.33', '3', '3.0', 'Error', '2'],
        ['Which keyword is used to inherit a class?', 'extends', 'inherits', 'class', ':', '4'],
        ['What is function overloading?', 'Using same name for different functions', 'Using multiple classes', 'Overriding function', 'None', '1'],
        ['What is the output type of `new` in C++?', 'void', 'pointer', 'object', 'reference', '2'],
        ['Which function is used to release memory allocated using `new`?', 'free()', 'delete()', 'remove()', 'dispose()', '2'],
        ['Which is not part of OOP in C++?', 'Inheritance', 'Encapsulation', 'Compilation', 'Polymorphism', '3'],
        ['What is the output of `int a = 5; cout << ++a;`?', '5', '6', 'Error', 'a', '2'],
        ['Which of the following is a base class for all standard exceptions?', 'exception', 'error', 'throwable', 'base_exception', '1'],
        ['What does `this` pointer refer to?', 'Current object', 'Base class', 'Parent function', 'Main function', '1'],
        ['What is the output of `5 == 5.0`?', 'true', 'false', 'error', 'undefined', '1'],
        ['Which operator is overloaded by `<<` in C++?', 'Extraction', 'Insertion', 'Comparison', 'None', '2'],
        ['What does `virtual` keyword do?', 'Defines a static function', 'Creates a reference', 'Enables runtime polymorphism', 'Declares a friend class', '3'],
        ['Which header is required for file handling in C++?', '<fstream>', '<iostream>', '<file.h>', '<fileio>', '1'],
        ['What is a pure virtual function?', 'A function with no definition', 'A function with parameters only', 'Function with definition only', 'None', '1'],
        ['What happens when `delete` is used on a null pointer?', 'Crash', 'Nothing', 'Error', 'Memory leak', '2']
    ]

];

$selected_questions = $questions[$level];
shuffle($selected_questions);
$_SESSION['questions'] = $selected_questions;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background: red; }
        .option { display: block; padding: 10px; margin: 5px; border: 1px solid #ccc; cursor: pointer; }
        .correct { background-color: green !important; color: white; }
        .wrong { background-color: darkred !important; color: white; }
        #next-btn { display: none; margin-top: 20px; padding: 10px 20px; background: blue; color: white; border: none; cursor: pointer; }
        #timer { font-size: 20px; font-weight: bold; color: #fff; background: #333; padding: 5px 15px; border-radius: 10px; margin-bottom: 15px; display: inline-block; }
    </style>
</head>
<body>

<div class="container">
    <h2>Level: <?php echo ucfirst($level); ?></h2>
    <div id="quiz-container">
        <div id="timer"></div>
        <p id="question-text"></p>
        <div id="options"></div>
        <button id="next-btn" onclick="nextQuestion()">Next</button>
    </div>
</div>

<script>
    let questions = <?php echo json_encode($selected_questions); ?>;
    let currentQuestionIndex = 0;
    let score = 0;
    let timer;
    let timeLeft;

    let level = "<?php echo $level; ?>";
    let timeLimits = { simple: 30, medium: 20, hard: 10 };

    function loadQuestion() {
        clearInterval(timer);
        let q = questions[currentQuestionIndex];
        document.getElementById("question-text").innerText = q[0];
        let optionsDiv = document.getElementById("options");
        optionsDiv.innerHTML = '';

        for (let i = 1; i <= 4; i++) {
            let btn = document.createElement("button");
            btn.innerText = q[i];
            btn.classList.add("option");
            btn.onclick = function() { checkAnswer(i, q[5], btn); };
            optionsDiv.appendChild(btn);
        }

        document.getElementById("next-btn").style.display = "none";

        startTimer();
    }

    function startTimer() {
        timeLeft = timeLimits[level];
        updateTimerDisplay();
        timer = setInterval(function() {
            timeLeft--;
            updateTimerDisplay();
            if (timeLeft <= 0) {
                clearInterval(timer);
                autoNext();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        let timerDisplay = document.getElementById("timer");
        timerDisplay.innerText = "Time Left: " + timeLeft + "s";
    }

    function autoNext() {
        let options = document.querySelectorAll(".option");
        options.forEach(option => option.disabled = true);
        let correctOption = questions[currentQuestionIndex][5];
        options[correctOption - 1].classList.add("correct");
        document.getElementById("next-btn").style.display = "block";
    }

    function checkAnswer(selected, correct, btn) {
        clearInterval(timer);
        let options = document.querySelectorAll(".option");
        options.forEach(option => option.disabled = true);

        if (selected == correct) {
            btn.classList.add("correct");
            score += 10;
        } else {
            btn.classList.add("wrong");
            options[correct - 1].classList.add("correct");
        }

        document.getElementById("next-btn").style.display = "block";
    }

    function nextQuestion() {
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            loadQuestion();
        } else {
            window.location.href = "submit_scorec.php?score=" + score;
        }
    }

    window.onload = function() {
        loadQuestion();
    }
</script>

</body>
</html>
