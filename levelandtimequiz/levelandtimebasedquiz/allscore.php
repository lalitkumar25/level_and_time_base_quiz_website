<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Score Board Menu</title>
    <style>
        body {
            font-family: Cursive;
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            margin-bottom: 40px;
        }
        .container {
            background-color: #EAE2C6;
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .row {
            display: flex;
            justify-content: space-around;
            margin-bottom: 25px;
        }
        .section {
            flex: 1;
            margin: 0 10px;
            color: black;
        }
        .btn {
            padding: 12px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: block;
            margin: auto;
            margin-top: 8px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        p {
            font-size: 17px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Welcome to Score Board</h1>

    <div class="container">

        <div class="row">
            <div class="section">
                <p>Show Score: C</p>
                <a href="quiz/sbc.php" class="btn">C</a>
            </div>
            <div class="section">
                <p>Show Score: C++</p>
                <a href="quiz/sbcpp.php" class="btn">C++</a>
            </div>
        </div>

        <div class="row">
            <div class="section">
                <p>Show Score: CSS</p>
                <a href="quiz/sbcs.php" class="btn">CSS</a>
            </div>
            <div class="section">
                <p>Show Score: Python</p>
                <a href="quiz/sbp.php" class="btn">PY</a>
            </div>
        </div>

        <div class="row">
            <div class="section">
                <p>Show Score: Computer</p>
                <a href="quiz/sbcomputer.php" class="btn">Computer</a>
            </div>
            <div class="section">
                <p>Show Score: Mathematics</p>
                <a href="quiz/sbmath.php" class="btn">Math</a>
            </div>
        </div>

    </div>

</body>
</html>
