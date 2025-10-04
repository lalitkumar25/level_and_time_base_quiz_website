<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Check if database connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data from DB
$query = "SELECT firstName, lastName, email FROM users WHERE email = ?";
$stmt = $conn->prepare($query);

// Check if the statement preparation was successful
if (!$stmt) {
    die('MySQL prepare error: ' . $conn->error);
}

$stmt->bind_param("s", $email);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if the user data was retrieved
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // If no user found, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }
        .container {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            margin: 10px 0;
            color: #555;
        }
        .intro {
            margin-top: 30px;
            font-size: 16px;
            color: #444;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?>!</h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

    <div class="intro">
        <p>You're now a part of our exciting quiz journey! 🧠</p>
        <p>Challenge yourself with questions in C, C++, Java, Python, and more.</p>
        <p>Choose a level and start mastering programming skills the fun way!</p>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
</div>

</body>
</html>
