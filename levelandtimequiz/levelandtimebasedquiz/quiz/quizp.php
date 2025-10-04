<?php
session_start();
include 'db.php';

$allowed_levels = ['simple', 'medium', 'hard'];
$level = in_array($_GET['level'] ?? 'simple', $allowed_levels) ? $_GET['level'] : 'simple';
$_SESSION['level'] = $level;

$questions = [
    
    'simple' => [
        ['What is the correct file extension for Python files?', '.pyth', '.pt', '.py', '.pyt', '3'],
        ['How do you print something in Python?', 'echo()', 'printf()', 'print()', 'cout', '3'],
        ['What symbol is used to start a comment?', '//', '#', '--', '/*', '2'],
        ['Which of the following is a valid variable name?', '2value', 'my-var', 'value_1', 'my value', '3'],
        ['How do you create a list in Python?', '{}', '()', '[]', '<>', '3'],
        ['Which keyword is used to define a function?', 'def', 'func', 'define', 'function', '1'],
        ['How do you start a for loop in Python?', 'for (i in range):', 'for i in range', 'for i in range():', 'for i to range()', '3'],
        ['What does `len()` return?', 'Length of a list', 'Length of a string', 'Length of any iterable', 'All of the above', '4'],
        ['Which of the following is a Boolean value?', '0', 'yes', 'True', '"true"', '3'],
        ['How do you insert comments in Python code?', '//', '--', '#', '!!', '3'],
        ['Which one is NOT a data type in Python?', 'int', 'float', 'real', 'str', '3'],
        ['What is the output of 3 * "hi"?', 'hihihi', 'error', '3hi', 'hi3', '1'],
        ['Which keyword is used for loops?', 'repeat', 'for', 'iterate', 'loop', '2'],
        ['Which function is used to get user input?', 'scan()', 'input()', 'read()', 'get()', '2'],
        ['What does `type(5)` return?', 'float', 'str', 'int', 'number', '3']
    ],

    'medium' => [
        ['What is the output of `bool("")`?', 'True', 'False', 'None', 'Error', '2'],
        ['Which operator is used for exponentiation?', '^', '**', 'exp', '^^', '2'],
        ['How do you handle exceptions in Python?', 'try/catch', 'try/except', 'try/catch/finally', 'error/handle', '2'],
        ['What is the correct way to open a file in read mode?', 'open("file.txt", "read")', 'open.read("file.txt")', 'open("file.txt", "r")', 'read("file.txt")', '3'],
        ['Which of the following is a mutable data type?', 'tuple', 'list', 'str', 'int', '2'],
        ['What is the result of `5 == "5"`?', 'True', 'False', 'Error', 'None', '2'],
        ['What does `range(5)` return?', '0 to 5', '1 to 5', '0 to 4', '1 to 4', '3'],
        ['Which method adds an item to the end of a list?', 'add()', 'append()', 'insert()', 'push()', '2'],
        ['What is a lambda function?', 'Named function', 'Anonymous function', 'Method', 'Loop', '2'],
        ['What is the output of `len([1, [2, 3]])`?', '2', '3', '4', 'Error', '1'],
        ['Which keyword is used to define a class?', 'function', 'def', 'class', 'struct', '3'],
        ['How do you create a dictionary?', '[]', '()', '{}', '<>', '3'],
        ['What is the output of `type([])`?', '<class "list">', '<type "list">', 'list', 'class list', '1'],
        ['Which of the following is used to install a package?', 'pip install', 'pkg add', 'py get', 'python -add', '1'],
        ['Which loop is guaranteed to execute at least once?', 'while', 'for', 'do...while (simulated)', 'None of the above', '3']
    ],

    'hard' => [
        ['What is the output of `sorted("banana")`?', "['a', 'a', 'a', 'b', 'n', 'n']", "['banana']", "['b', 'a', 'n']", 'Error', '1'],
        ['Which of the following is used to define a generator in Python?', 'yield', 'return', 'next', 'gen', '1'],
        ['What does `*args` do in a function definition?', 'Accepts multiple keyword arguments', 'Accepts one argument', 'Accepts multiple positional arguments', 'None', '3'],
        ['What is the difference between `is` and `==`?', 'No difference', '`is` compares values, `==` compares identity', '`is` compares identity, `==` compares values', 'Both are same', '3'],
        ['What is a correct syntax to inherit a class in Python?', 'class A : B', 'class A inherits B', 'class A(B):', 'class A -> B', '3'],
        ['Which module handles regular expressions in Python?', 'regex', 're', 'expression', 'match', '2'],
        ['What does `__init__` do?', 'Initialize a class', 'Destroy a class', 'Create a module', 'None', '1'],
        ['What does `map()` return?', 'List', 'Set', 'Iterator', 'Dictionary', '3'],
        ['Which one is not a built-in function?', 'map()', 'filter()', 'reduce()', 'join()', '3'],
        ['What is the output of `list(range(0, 10, 2))`?', '[0, 2, 4, 6, 8]', '[2, 4, 6, 8, 10]', '[0, 2, 4, 6]', '[0, 2, 4, 6, 8, 10]', '1'],
        ['How do you reverse a list `a` in-place?', 'a.reverse()', 'a[::-1]', 'reverse(a)', 'rev(a)', '1'],
        ['Which function is used to check memory usage in Python?', 'mem()', 'memory()', 'sys.mem()', 'sys.getsizeof()', '4'],
        ['What is the output of `bool([])`?', 'True', 'False', 'None', 'Error', '2'],
        ['How to convert a string into a list of characters?', 'split()', 'list()', 'char()', 'array()', '2'],
        ['What does the `enumerate()` function do?', 'Returns values only', 'Returns index only', 'Returns index and value', 'None of the above', '3']
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
