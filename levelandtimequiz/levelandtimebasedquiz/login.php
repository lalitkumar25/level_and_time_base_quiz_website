<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if email and password match
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // If user is found
    if (mysqli_num_rows($result) == 1) {
        // Fetch user details
        $user = mysqli_fetch_assoc($result);

        // Save user details in the session
        $_SESSION['username'] = $user['firstName'];  // User's first name
        $_SESSION['email'] = $user['email'];  // User's email

        // Redirect to homepage or user profile
        header("Location: homepage.php");
        exit();
    } else {
        // Error if email or password is incorrect
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </form>
</div>

</body>
</html>
