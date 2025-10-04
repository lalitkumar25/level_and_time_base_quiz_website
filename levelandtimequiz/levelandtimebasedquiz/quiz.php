<?php
session_start();
include 'db.php';

$allowed_levels = ['simple', 'medium', 'hard'];
$level = in_array($_GET['level'] ?? 'simple', $allowed_levels) ? $_GET['level'] : 'simple';
$_SESSION['level'] = $level;

$questions = [
    'simple' => [
        ['What does CPU stand for?', 'Central Processing Unit', 'Computer Personal Unit', 'Central Processor Utility', 'Control Program Unit', '1'],
        ['Which device is used to input text?', 'Monitor', 'Mouse', 'Keyboard', 'Printer', '3'],
        ['Which of these is an output device?', 'Scanner', 'Keyboard', 'Mouse', 'Speaker', '4'],
        ['What does RAM stand for?', 'Read Access Memory', 'Random Access Memory', 'Run Access Mode', 'Real Active Memory', '2'],
        ['What is the brain of the computer?', 'Monitor', 'Mouse', 'CPU', 'RAM', '3'],
        ['Which one is a programming language?', 'HTML', 'MS Word', 'Excel', 'PowerPoint', '1'],
        ['Which storage device is permanent?', 'RAM', 'ROM', 'Cache', 'Register', '2'],
        ['What does GUI stand for?', 'Graphical User Interface', 'General Unit Input', 'Group User Internet', 'Graphics Uniform Interface', '1'],
        ['Which software is used for browsing internet?', 'MS Word', 'Chrome', 'Paint', 'Excel', '2'],
        ['Which of the following is not an input device?', 'Joystick', 'Printer', 'Keyboard', 'Microphone', '2'],
        ['What does URL stand for?', 'Uniform Resource Locator', 'Unified Resource Link', 'Universal Remote Locator', 'User Resource List', '1'],
        ['Which component stores data permanently?', 'RAM', 'ROM', 'CPU', 'Cache', '2'],
        ['Which one is an operating system?', 'Windows', 'Intel', 'Google', 'Facebook', '1'],
        ['What is used to make calculations in computers?', 'Keyboard', 'CPU', 'Monitor', 'Mouse', '2'],
        ['Which key is used to delete characters to the left of the cursor?', 'Enter', 'Tab', 'Backspace', 'Shift', '3']
    ],
    'medium' => [
        ['What is the main function of the ALU?', 'Store data', 'Display data', 'Perform arithmetic and logic operations', 'Control system', '3'],
        ['Which memory is volatile?', 'ROM', 'SSD', 'RAM', 'Hard Disk', '3'],
        ['Which part of the computer controls all other parts?', 'RAM', 'Monitor', 'CPU', 'Mouse', '3'],
        ['Which of these is a programming language?', 'Python', 'Photoshop', 'Excel', 'Linux', '1'],
        ['Which generation used microprocessors?', '1st', '2nd', '3rd', '4th', '4'],
        ['What is a compiler?', 'Hardware', 'Software that converts high-level code to machine code', 'Debugger', 'Text Editor', '2'],
        ['What does HTTP stand for?', 'HyperText Transfer Protocol', 'HighText Tool Protocol', 'Hyper Terminal Transfer Program', 'Hyper Transfer Tool Protocol', '1'],
        ['Which command is used to copy files in Windows?', 'del', 'copy', 'move', 'exit', '2'],
        ['What does IP stand for in networking?', 'Internet Provider', 'Internet Protocol', 'Information Protocol', 'Input Provider', '2'],
        ['Which of the following is not a type of software?', 'System software', 'Application software', 'Utility software', 'Hardware software', '4'],
        ['Which language is used for web development?', 'Python', 'Java', 'HTML', 'C', '3'],
        ['In binary, what is 1010?', '10', '12', '8', '15', '1'],
        ['Which key is used to refresh a webpage?', 'F1', 'F5', 'F3', 'F11', '2'],
        ['Which one is a search engine?', 'Windows', 'Google', 'Instagram', 'Word', '2'],
        ['Which port is used for HTTP?', '80', '21', '25', '110', '1']
    ],

    'hard' => [
        ['Which data structure uses FIFO?', 'Stack', 'Queue', 'Tree', 'Graph', '2'],
        ['Which OS is open-source?', 'Windows', 'macOS', 'Linux', 'iOS', '3'],
        ['What does SQL stand for?', 'Structured Query Language', 'Simple Query Line', 'Standard Queue Language', 'System Query Logic', '1'],
        ['Which protocol is used to send email?', 'FTP', 'HTTP', 'SMTP', 'SNMP', '3'],
        ['What is the time complexity of binary search?', 'O(n)', 'O(log n)', 'O(n²)', 'O(1)', '2'],
        ['Which of these is not a programming paradigm?', 'Object-oriented', 'Procedural', 'Structural', 'Preprocessor', '4'],
        ['What is a NULL pointer?', 'Points to 1', 'Points to last memory', 'Points to nothing', 'Points to garbage', '3'],
        ['What does DNS stand for?', 'Domain Name System', 'Device Network Software', 'Digital Naming System', 'Domain Naming Structure', '1'],
        ['What is the result of 1101 AND 1011?', '1101', '1001', '1000', '1111', '2'],
        ['Which algorithm is used for sorting?', 'Dijkstra', 'Bellman-Ford', 'Quick Sort', 'Floyd Warshall', '3'],
        ['What does API stand for?', 'Application Programming Interface', 'Advanced Protocol Interface', 'Applied Programming Instruction', 'App Program Integration', '1'],
        ['Which of the following is not an OS?', 'Windows', 'Android', 'Linux', 'Oracle', '4'],
        ['Which layer in the OSI model handles encryption?', 'Data Link', 'Session', 'Presentation', 'Network', '3'],
        ['Which part of a CPU performs logical operations?', 'Control Unit', 'ALU', 'Memory', 'Register', '2'],
        ['What is recursion in programming?', 'Looping technique', 'Repeating process by itself', 'Switching code', 'Calling system files', '2']
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
