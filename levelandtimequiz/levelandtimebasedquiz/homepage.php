



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time and levels</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div class="navbar">
            <h2><i class="fa-solid fa-clock"></i>Time and levels</h2>
            <nav>
                <a href="allscore.php"><i class="fas fa-chart-simple"></i> Scoreboard</a>
                <!-- <a href="#"><i class="fas fa-list"></i> Categories</a> -->
                <a href="user.php"><i class="fas fa-user"></i> My Profile</a>
            </nav>
            <div class="auth-buttons">
                <img src="user.png">
            </div>
            <!-- Sliding Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <img src="profile.png" alt="User Avatar" class="sidebar-avatar">
                    
                </div>
                
            </div>
        </div>
    </header>
    
    <main>
        <h1>Challenge Your Knowledge</h1>
        <p>Test your skills across multiple categories and compete with players worldwide</p>
        
        <section class="how-to-play">
            <h2>How to Play</h2>
            <div class="instructions">
                <div><i class="fa-solid fa-layer-group"></i><h3>Choose Category</h3><p>Select from various categories</p></div>
                
                <div><i class="fa-solid fa-comment"></i><h3>Answer Questions</h3><p>Test your knowledge</p></div>
                
                <div><i class="fa-solid fa-coins"></i><h3>Earn Points</h3><p>Score points for correct answers</p></div>
                
                <div><i class="fa-solid fa-list-check"></i><h3>Track Progress</h3><p>Monitor your improvement</p></div>
            </div>
        </section>
        
        <section class="categories">
            <h1>Categories</h1>
            <!-- <h2>Science</h2>
            <div class="category-grid">
                <div class="category"><i class="fa-solid fa-bolt"></i><h3>Physics</h3><p>Test Your Knowledge of Motion, Energy & Beyond!</p><button onclick="location.href='level_select.php'">Start Quiz</button></div> -->
                
                <!-- <div class="category"><i class="fa-solid fa-brain"></i><h3>Biology</h3><p>Life begins at the cellular level!</p><a href="/quesscore/login.php"><button id="startBtn">Start Quiz</button></a></div>
                
                <div class="category"><i class="fa-solid fa-flask"></i><h3>Chemistry</h3><p>Mixing elements, creating wonders!</p><a href="quiz.html"><button id="startBtn">Start Quiz</button></a></div>
               -->
                <!-- <div class="category"><i class="fa-solid fa-calculator"></i><h3>Mathematics</h3><p>Logical and numerical problem-solving quizzes.</p><a href="quiz.html"><button id="startBtn">Start Quiz</button></a></div> -->
                
            <!-- </div> -->

            <h2>Programming</h2>
            <div class="category-grid">
                <div class="category"><i class="fa-solid fa-code"></i><h3>C</h3><p>The Mother of All Programming Languages!</p><button onclick="location.href='quiz/lsc.php'">Start Quiz</button></div>
                
                <div class="category"><i class="fa-solid fa-code"></i><h3>C++</h3><p>Think in Objects, Code in C++!</p><button onclick="location.href='quiz/lscpp.php'">Start Quiz</button></div>
                
                <div class="category"><i class="fa-solid fa-code"></i><h3>Python</h3><p>Master the Snake of Programming!</p><button onclick="location.href='quiz/lsp.php'">Start Quiz</button></div>

                <!-- <div class="category"><i class="fa-solid fa-code"></i><h3>HTML</h3><p>The Skeleton of the Web!</p><button>Start Quiz</button></div> -->

                <div class="category"><i class="fa-solid fa-code"></i><h3>CSS</h3><p>Without CSS, the Web is Just Black & White!</p><button onclick="location.href='quiz/lscs.php'">Start Quiz</button></div>
            </div>

            <h2>Others</h2>
            <div class="category-grid">
                <!-- <div class="category"><i class="fa-solid fa-clock-rotate-left"></i><h3>History</h3><p>Journey through time with history</p><button>Start Quiz</button></div> -->
                
                <div class="category"><i class="fa-solid fa-calculator"></i><h3>Mathematics</h3><p>Logical and numerical problem-solving quizzes.</p><button onclick="location.href='quiz/lsm.php'">Start Quiz</button></div>


                <div class="category"><i class="fa-solid fa-tv"></i><h3>Entertainment</h3><p>Movies, music, and pop culture</p><button onclick="location.href='quiz/lsm.php'">Start Quiz</button></div>

                <div class="category"><i class="fa-solid fa-tv"></i><h3>Computer</h3><p>CPU, Hardware, Softwere, and other computer question</p><button onclick="location.href='level_select.php'">Start Quiz</button></div>

            </div>
        </section>

             
    </main>
    <footer>
        <section class="community">
            <i class="fas fa-clock"></i> <!-- Font Awesome ke liye -->
            <h2>About Section</h2>
            <p>Welcome to <b>Time And Levels</b>, a place to test and improve your knowledge with exciting time-based and level-based quizzes. Keep learning, keep growing!</p>
            <!-- <button>Create Account</button>
            <button>Learn More</button> -->
        </section>
    </footer>
    <script>
    
    document.addEventListener("DOMContentLoaded", function () {
            let authButton = document.getElementById("auth-buttons");
            let sidebar = document.getElementById("sidebar");

            authButton.addEventListener("click", function () {
                if (sidebar.style.right === "0px") {
                    sidebar.style.right = "-250px"; // Hide Sidebar
                } else {
                    sidebar.style.right = "0px"; // Show Sidebar
                }
            });
        });

       
        
    
    </script>
</body>

</html>

