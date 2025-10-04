<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Unique User ID
$username = $_SESSION['username']; // First Name for Display
$level = $_GET['level'];
$new_score = (int) $_GET['score'];

// Check if user already has a score for this level
$sql = "SELECT * FROM scores WHERE user_id='$user_id' AND level='$level'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // If user already played, update score (higher or lower)
    $sql = "UPDATE scores SET score=$new_score WHERE user_id='$user_id' AND level='$level'";
} else {
    // First time playing, insert new row
    $sql = "INSERT INTO scores (user_id, firstName, level, score) VALUES ('$user_id', '$username', '$level', $new_score)";
}

if ($conn->query($sql) === TRUE) {
    header("Location: scoreboard.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
