<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || !isset($_SESSION['level']) || !isset($_GET['score'])) {
    die("Unauthorized access.");
}

$username = $_SESSION['username'];
$level = $_SESSION['level'];
$score = intval($_GET['score']); // URL se score le rahe hain

$query = "SELECT * FROM scoreboard_math WHERE username='$username' AND level='$level'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $existing_score = $row['score'];

    if ($score > $existing_score) {
        $update_query = "UPDATE scoreboard_math SET score='$score' WHERE username='$username' AND level='$level'";
        mysqli_query($conn, $update_query);
    }
} else {
    $insert_query = "INSERT INTO scoreboard_math (username, level, score) VALUES ('$username', '$level', '$score')";
    mysqli_query($conn, $insert_query);
}

header("Location: sbp.php");
exit();
?>
