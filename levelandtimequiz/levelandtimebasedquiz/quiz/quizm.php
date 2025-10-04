<?php
session_start();
include 'db.php';

$allowed_levels = ['simple', 'medium', 'hard'];
$level = in_array($_GET['level'] ?? 'simple', $allowed_levels) ? $_GET['level'] : 'simple';
$_SESSION['level'] = $level;

$questions = [
    'simple' => [
        ['What is 5 + 3?', '6', '7', '8', '9', '3'],
        ['What is 10 - 4?', '6', '5', '4', '3', '1'],
        ['What is 3 × 4?', '12', '7', '9', '10', '1'],
        ['What is 16 ÷ 4?', '2', '3', '4', '5', '3'],
        ['What is the square of 5?', '10', '15', '25', '30', '3'],
        ['Which number is even?', '3', '5', '7', '8', '4'],
        ['What comes after 99?', '98', '100', '101', '102', '2'],
        ['What is 100 - 55?', '45', '40', '50', '35', '1'],
        ['What is 7 + 6?', '12', '13', '14', '15', '2'],
        ['What is 9 × 1?', '8', '9', '10', '11', '2'],
        ['What is the value of π (approximately)?', '3.14', '2.14', '4.13', '1.41', '1'],
        ['Which shape has 3 sides?', 'Square', 'Triangle', 'Circle', 'Rectangle', '2'],
        ['What is 2²?', '2', '4', '6', '8', '2'],
        ['What is half of 20?', '5', '10', '15', '8', '2'],
        ['How many angles does a square have?', '2', '3', '4', '5', '3']
    ],
    'medium' => [
        ['What is the LCM of 4 and 6?', '10', '12', '14', '8', '2'],
        ['What is 15% of 200?', '25', '30', '35', '40', '2'],
        ['What is the square root of 49?', '5', '6', '7', '8', '3'],
        ['Solve: 2x = 10. What is x?', '2', '5', '10', '20', '2'],
        ['What is the next prime number after 7?', '8', '9', '10', '11', '4'],
        ['What is the area of a square with side 6?', '36', '12', '18', '24', '1'],
        ['What is 3³?', '9', '27', '81', '18', '2'],
        ['What is the perimeter of a rectangle with length 4 and width 3?', '12', '14', '16', '10', '2'],
        ['What is the average of 10, 20, 30?', '15', '20', '25', '30', '2'],
        ['Which is a factor of 36?', '5', '7', '9', '11', '3'],
        ['How many degrees in a triangle?', '90', '180', '270', '360', '2'],
        ['How many centimeters in a meter?', '10', '100', '1000', '10000', '2'],
        ['What is 7²?', '42', '48', '49', '56', '3'],
        ['How many sides does a hexagon have?', '5', '6', '7', '8', '2'],
        ['Simplify: 4 + 3 × 2', '14', '10', '11', '7', '2']
    ],

    'hard' => [
        ['What is the value of x in the equation 3x - 5 = 16?', '5', '6', '7', '8', '3'],
        ['What is the derivative of x²?', '2x', 'x', 'x²', '1', '1'],
        ['What is the integral of 2x?', '2x', 'x² + C', 'x + C', 'x²', '2'],
        ['Solve: x² - 4x + 4 = 0', 'x = 2', 'x = 1', 'x = 0', 'x = 4', '1'],
        ['What is the discriminant of x² - 2x + 1?', '1', '2', '0', '4', '3'],
        ['What is the 10th term of the arithmetic sequence: 2, 4, 6, ...?', '20', '18', '22', '24', '1'],
        ['If sin(θ) = 1, what is θ?', '0°', '45°', '90°', '180°', '3'],
        ['What is the logarithm of 100 to base 10?', '1', '2', '10', '100', '2'],
        ['What is the value of cos(0)?', '0', '1', '-1', 'Undefined', '2'],
        ['What is 2⁵?', '16', '32', '64', '128', '2'],
        ['How many zeros in one million?', '4', '5', '6', '7', '3'],
        ['What is the area of a circle with radius 7?', '49π', '14π', '28π', '7π', '1'],
        ['If a triangle has sides 3, 4, 5, what type is it?', 'Equilateral', 'Isosceles', 'Scalene', 'Right-angled', '4'],
        ['What is the sum of interior angles of a hexagon?', '540°', '720°', '900°', '1080°', '2'],
        ['What is 1001 ÷ 7?', '143', '141', '139', '147', '1']
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
