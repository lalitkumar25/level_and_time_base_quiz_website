<?php
session_start();
include 'db.php';

$allowed_levels = ['simple', 'medium', 'hard'];
$level = in_array($_GET['level'] ?? 'simple', $allowed_levels) ? $_GET['level'] : 'simple';
$_SESSION['level'] = $level;

$questions = [
    
    'simple' => [
        ['What does CSS stand for?', 'Computer Style Sheets', 'Cascading Style Sheets', 'Creative Style System', 'Colorful Style Sheets', '2'],
        ['Which HTML tag is used to link CSS?', '<css>', '<style>', '<link>', '<stylesheet>', '3'],
        ['Where is the correct place to link an external CSS file?', 'At the bottom of the page', 'Inside the body', 'In the head section', 'After all HTML elements', '3'],
        ['How do you add a background color in CSS?', 'background = blue;', 'bg-color: blue;', 'color-background: blue;', 'background-color: blue;', '4'],
        ['Which is the correct CSS syntax?', 'body {color: black;}', '{body;color:black;}', 'body:color=black;', 'body = color: black;', '1'],
        ['Which symbol is used for an ID selector?', '.', '#', '*', '@', '2'],
        ['Which symbol is used for a class selector?', '.', '#', ':', '/', '1'],
        ['How do you make text bold in CSS?', 'font-weight: bold;', 'text-style: bold;', 'font: bold;', 'weight: bold;', '1'],
        ['Which unit is relative to the font size of the element?', 'px', 'pt', 'em', '%', '3'],
        ['How do you center text in CSS?', 'text-position: center;', 'text-align: center;', 'center: text;', 'text-style: center;', '2'],
        ['What is the default position of HTML elements?', 'absolute', 'relative', 'static', 'fixed', '3'],
        ['Which property is used to change the font?', 'text-font', 'font-style', 'font-family', 'font-weight', '3'],
        ['How do you apply a style to all `<p>` elements?', 'p.all', '#p', '*p', 'p', '4'],
        ['Which of the following can be used to apply inline styles?', 'style', 'link', 'css', 'script', '1'],
        ['Which color code is for black in hex?', '#000000', '#ffffff', '#ff0000', '#00ff00', '1']
    ],

    'medium' => [
        ['How do you make a div 100 pixels wide?', 'width = 100px;', 'width: 100;', 'width: 100px;', '100px: width;', '3'],
        ['Which property is used to change text size?', 'font-size', 'text-size', 'size', 'text-style', '1'],
        ['Which value is used for transparent background?', 'opacity: 100%', 'visibility: hidden;', 'opacity: 0;', 'display: none;', '3'],
        ['Which CSS property is used for shadow around a box?', 'shadow', 'box-shadow', 'border-shadow', 'outer-shadow', '2'],
        ['What does `z-index` control?', 'zoom level', 'stacking order', 'margin', 'rotation', '2'],
        ['How do you remove underline from links?', 'text-decoration: none;', 'text-style: no-underline;', 'link-decoration: off;', 'decoration: hide;', '1'],
        ['What is the use of `display: flex;`?', 'To create responsive images', 'To align items in a row or column', 'To remove element', 'To hide overflow', '2'],
        ['Which property controls spacing inside a box?', 'margin', 'border', 'padding', 'space', '3'],
        ['Which property controls spacing outside a box?', 'padding', 'border', 'margin', 'gap', '3'],
        ['What does `inherit` value do?', 'Deletes style', 'Applies browser default', 'Copies parent’s style', 'Resets style', '3'],
        ['Which selector targets all `<h1>` and `<p>` elements?', 'h1 p', 'h1, p', 'h1.p', 'h1 + p', '2'],
        ['How do you make a circular div?', 'border-radius: 360deg;', 'shape: circle;', 'border-radius: 50%;', 'round: 100%;', '3'],
        ['What is `position: relative;` relative to?', 'Screen', 'Parent', 'Initial position', 'Top left corner', '3'],
        ['Which property is used to transition between states smoothly?', 'animation', 'transition', 'hover', 'delay', '2'],
        ['How do you change the cursor to a pointer on hover?', 'cursor: hand;', 'pointer: cursor;', 'cursor: pointer;', 'mouse: pointer;', '3']
    ],

    'hard' => [
        ['Which CSS property is used to apply different styles for different screen sizes?', 'responsive', '@media', '@screen', 'query', '2'],
        ['How do you apply a style to a `<div>` with class "box" inside an element with id "main"?', '#main.box', '#main .box', '.main .box', '#box #main', '2'],
        ['What is the default value of `position` property?', 'relative', 'absolute', 'fixed', 'static', '4'],
        ['How can you animate an element in CSS?', '@transition', '@keyframe', '@animate', '@keyframes', '4'],
        ['Which property is used to set the stacking order?', 'index', 'layer', 'z-order', 'z-index', '4'],
        ['What does `vw` unit mean in CSS?', 'viewport width', 'vertical width', 'viewable width', 'variable width', '1'],
        ['How do you apply multiple background images?', 'background-images', 'background: url1, url2;', 'background-multi', 'background-stack', '2'],
        ['Which pseudo-class targets every even element?', ':nth', ':even', ':nth-child(even)', ':every', '3'],
        ['What does `overflow: hidden;` do?', 'Resizes content', 'Hides overflowing content', 'Shows scroll bar', 'Deletes content', '2'],
        ['How do you center a div vertically and horizontally with flex?', 'align: center;', 'justify-content: center;', 'center: flex;', 'justify-content: center; align-items: center;', '4'],
        ['Which property is used to apply blur effect?', 'blur()', 'filter: blur()', 'effect: blur()', 'transform: blur()', '2'],
        ['How do you make text responsive?', 'font-size: 100%;', 'font-size: vw', 'font-size: auto;', 'text-resize: auto;', '2'],
        ['Which keyword is used to inherit CSS variables?', 'get()', 'var()', 'inherit()', 'use()', '2'],
        ['Which of the following disables an element from being clickable?', 'visibility: hidden;', 'opacity: 0;', 'pointer-events: none;', 'display: none;', '3'],
        ['How do you create a grid in CSS?', 'layout: grid;', 'display: grid;', 'grid: layout;', 'grid-view: on;', '2']
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
