<?php
session_start();
include 'db.php';

$allowed_levels = ['simple', 'medium', 'hard'];
$level = in_array($_GET['level'] ?? 'simple', $allowed_levels) ? $_GET['level'] : 'simple';
$_SESSION['level'] = $level;

$questions = [
    'simple' => [
        ['What is the size of int in C?', '2 bytes', '4 bytes', '8 bytes', 'Depends on compiler', '4'],
        ['Which symbol is used for comments in C?', '//', '#', '/* */', '--', '3'],
        ['Which data type is used to store a single character?', 'char', 'string', 'int', 'float', '1'],
        ['What is the correct syntax for declaring a pointer?', 'int ptr;', 'int *ptr;', 'ptr *int;', 'int& ptr;', '2'],
        ['Which function is used to print output?', 'printf()', 'cout<<', 'print()', 'echo', '1'],
        ['What is the output of 5/2 in C?', '2', '2.5', '3', 'Depends on type', '1'],
        ['What is the extension of a C file?', '.cpp', '.c', '.java', '.h', '2'],
        ['Which loop is used for executing at least once?', 'for', 'while', 'do-while', 'if', '3'],
        ['What is the keyword to define a constant variable?', 'constant', 'final', 'const', 'define', '3'],
        ['Which operator is used for bitwise AND?', '&', '|', '&&', '||', '1'],
        ['What is the default value of an uninitialized int variable?', '0', 'garbage', 'null', 'undefined', '2'],
        ['Which header file is required for malloc()?', 'stdlib.h', 'stdio.h', 'math.h', 'string.h', '1'],
        ['Which operator is used for address-of?', '*', '&', '&&', '@', '2'],
        ['What is the return type of main() in C?', 'void', 'int', 'float', 'char', '2'],
        ['Which function is used to get input from user?', 'scanf()', 'cin>>', 'input()', 'gets()', '1']
    ],
    'medium' => [
        ['Which keyword is used to define a function?', 'method', 'function', 'def', 'void', '4'],
        ['Which function is used to allocate memory?', 'malloc()', 'alloc()', 'new()', 'allocate()', '1'],
        ['Which operator is used for pointer dereferencing?', '*', '&', '->', '=>', '1'],
        ['What is the ASCII value of A?', '64', '65', '66', '67', '2'],
        ['Which loop is preferred when the number of iterations is known?', 'for', 'while', 'do-while', 'switch', '1'],
        ['Which function is used to compare strings?', 'strcmp()', 'strcomp()', 'compare()', 'stringcmp()', '1'],
        ['Which of these is a valid identifier in C?', '2var', '_variable', 'int', 'case', '2'],
        ['What is sizeof(char) in C?', '1 byte', '2 bytes', '4 bytes', 'Depends on compiler', '1'],
        ['Which header file is used for string functions?', 'string.h', 'stdlib.h', 'stdio.h', 'strings.h', '1'],
        ['Which keyword is used for loops?', 'repeat', 'loop', 'for', 'iterate', '3'],
        ['Which function is used to terminate a program?', 'exit()', 'terminate()', 'stop()', 'end()', '1'],
        ['Which of these is a preprocessor directive?', '#define', '@define', '&define', 'define()', '1'],
        ['Which operator is used for modulus operation?', '%', 'mod', '/', '//', '1'],
        ['Which function is used to concatenate strings?', 'strcat()', 'stradd()', 'stringcat()', 'concat()', '1'],
        ['What is the base address of an array?', 'First element', 'Last element', 'Middle element', 'Undefined', '1']
    ],
    'hard' => [
        ['Which of these is a valid pointer declaration?', 'int ptr;', 'int *ptr;', 'ptr int*;', '*int ptr;', '2'],
        ['Which function is used to deallocate memory?', 'free()', 'delete()', 'remove()', 'clear()', '1'],
        ['Which function is used to open a file?', 'fopen()', 'fileopen()', 'open()', 'openfile()', '1'],
        ['Which of these is not a storage class in C?', 'auto', 'register', 'static', 'private', '4'],
        ['Which data structure uses FIFO?', 'Stack', 'Queue', 'Linked List', 'Tree', '2'],
        ['Which header file contains mathematical functions?', 'math.h', 'stdlib.h', 'stdio.h', 'conio.h', '1'],
        ['What does calloc() return if it fails?', 'NULL', '0', '-1', 'None', '1'],
        ['Which operator is used for conditional expressions?', '?:', 'if', 'switch', 'ternary', '1'],
        ['Which function is used to convert a string to integer?', 'atoi()', 'stringtoint()', 'int()', 'convert()', '1'],
        ['Which function is used to reverse a string?', 'strrev()', 'reverse()', 'rev()', 'reversestr()', '1'],
        ['Which keyword is used for defining macros?', '#define', 'define()', 'macro', '@define', '1'],
        ['Which function is used to get length of a string?', 'strlen()', 'length()', 'size()', 'getLength()', '1'],
        ['Which is the fastest memory?', 'HDD', 'RAM', 'Cache', 'Registers', '4'],
        ['What does the function fflush(stdin) do?', 'Clears output buffer', 'Clears input buffer', 'Clears both', 'None', '2'],
        ['Which function is used to write formatted output?', 'printf()', 'sprintf()', 'fprintf()', 'All of the above', '4']
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
    <!-- <link rel="stylesheet" href="../styles.css"> -->
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
