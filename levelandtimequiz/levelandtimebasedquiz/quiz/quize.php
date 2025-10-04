


        <?php
session_start();
include 'db.php';

$allowed_levels = ['simple', 'medium', 'hard'];
$level = in_array($_GET['level'] ?? 'simple', $allowed_levels) ? $_GET['level'] : 'simple';
$_SESSION['level'] = $level;

$questions = [
    
  'simple' => [
            ['Who played Iron Man in the Marvel movies?', 'Chris Hemsworth', 'Robert Downey Jr.', 'Chris Evans', 'Mark Ruffalo', '2'],
            ['Which movie features the famous line "May the Force be with you"?', 'Star Trek', 'Star Wars', 'The Matrix', 'Back to the Future', '2'],
            ['Who directed "Jurassic Park"?', 'Steven Spielberg', 'James Cameron', 'Ridley Scott', 'Quentin Tarantino', '1'],
            ['What is the name of the fictional African country in "Black Panther"?', 'Zamunda', 'Genovia', 'Wakanda', 'Elbonia', '3'],
            ['Who voiced the character of Shrek in the animated movies?', 'Mike Myers', 'Eddie Murphy', 'Antonio Banderas', 'Robin Williams', '1'],
            ['In which movie does the character "Forrest Gump" run across the country?', 'The Pursuit of Happyness', 'Forrest Gump', 'Cast Away', 'Big', '2'],
            ['What is the name of the kingdom in "Frozen"?', 'Arendelle', 'Narnia', 'Atlantis', 'Rivendell', '1'],
            ['Which animated movie features the song "Let It Go"?', 'Moana', 'Frozen', 'Tangled', 'The Lion King', '2'],
            ['Who played the character of Joker in "The Dark Knight"?', 'Jared Leto', 'Jack Nicholson', 'Heath Ledger', 'Joaquin Phoenix', '3'],
            ['Which movie is about a man who is stranded on a deserted island with a volleyball?', 'Cast Away', 'The Beach', 'Robinson Crusoe', 'The Revenant', '1']
        ],
        'medium' => [
            ['In "Inception," what does the spinning top symbolize?', 'The dream world', 'Reality', 'The end of the dream', 'Time running out', '2'],
            ['Who won the Academy Award for Best Actor in 2020?', 'Brad Pitt', 'Joaquin Phoenix', 'Leonardo DiCaprio', 'Adam Driver', '2'],
            ['Which 2019 movie became the highest-grossing film of all time?', 'Avengers: Endgame', 'Titanic', 'Avatar', 'The Lion King', '1'],
            ['Which actor starred as the character "Jack" in "Titanic"?', 'Matt Damon', 'Johnny Depp', 'Leonardo DiCaprio', 'Tom Hanks', '3'],
            ['In which film did the character "The Terminator" first appear?', 'Terminator 2: Judgment Day', 'The Terminator', 'The Matrix', 'Predator', '2'],
            ['What is the name of the fictional city in "Batman Begins"?', 'Gotham City', 'Metropolis', 'Star City', 'Central City', '1'],
            ['In "The Matrix," what color is the pill that Neo takes to escape the simulation?', 'Red', 'Blue', 'Green', 'Yellow', '1'],
            ['Who played the character of "Hannibal Lecter" in "The Silence of the Lambs"?', 'Robert De Niro', 'Anthony Hopkins', 'Al Pacino', 'Johnny Depp', '2'],
            ['Which animated character says, "To infinity and beyond"?', 'Buzz Lightyear', 'Woody', 'Shrek', 'Simba', '1'],
            ['What is the name of the pirate ship in "Pirates of the Caribbean"?', 'The Black Pearl', 'The Queen Anne\'s Revenge', 'The Flying Dutchman', 'The Sea Serpent', '1']
        ],
        'hard' => [
            ['Who directed "Pulp Fiction"?', 'Martin Scorsese', 'Quentin Tarantino', 'Christopher Nolan', 'David Fincher', '2'],
            ['Which movie won the Oscar for Best Picture in 2017?', 'La La Land', 'The Revenant', 'Birdman', 'Moonlight', '4'],
            ['What is the fictional language spoken in the movie "Avatar"?', 'Klingon', 'Na’vi', 'Dothraki', 'Elvish', '2'],
            ['Who starred as "The Joker" in the 2019 movie "Joker"?', 'Tom Hardy', 'Joaquin Phoenix', 'Heath Ledger', 'Jack Nicholson', '2'],
            ['In which movie does the character "Scar" appear? ', 'The Lion King', 'The Jungle Book', 'Tarzan', 'Zootopia', '1'],
            ['Which film was the highest-grossing movie of the 2010s? ', 'The Avengers', 'Avatar', 'Avengers: Endgame', 'The Dark Knight', '3'],
            ['Who was the first woman to win the Academy Award for Best Director?', 'Kathryn Bigelow', 'Greta Gerwig', 'Sofia Coppola', 'Jane Campion', '1'],
            ['Which Marvel movie was the first to feature the character "Black Panther"?', 'Iron Man', 'The Avengers', 'Captain America: Civil War', 'Black Panther', '3'],
            ['Who won an Academy Award for Best Actor for "There Will Be Blood"?', 'Daniel Day-Lewis', 'Matthew McConaughey', 'Christian Bale', 'Tom Hanks', '1'],
            ['In which film do we see the famous "I see dead people" line?', 'The Sixth Sense', 'The Others', 'The Ring', 'The Exorcist', '1']
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
