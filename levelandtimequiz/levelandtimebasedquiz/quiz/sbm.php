<?php
session_start();
include 'db.php';

$levels = ['simple', 'medium', 'hard'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard</title>
    <link rel="stylesheet" href="../stylescore.css">
   
</head>
<body>

<div class="container">
    <h2>Scoreboard</h2>

    <?php foreach ($levels as $level): ?>
        <div class="level-title">Level: <?php echo ucfirst($level); ?></div>
        <table>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
            </tr>
            <?php
            $query = "SELECT username, score FROM scoreboard_math WHERE level='$level' ORDER BY score DESC LIMIT 10";
            $result = mysqli_query($conn, $query);
            
            if (mysqli_num_rows($result) > 0) {
                $rank = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $medal = "";
                    if ($rank == 1) $medal = "<span class='gold'>🥇</span>";
                    elseif ($rank == 2) $medal = "<span class='silver'>🥈</span>";
                    elseif ($rank == 3) $medal = "<span class='bronze'>🥉</span>";
                    
                    echo "<tr>
                            <td>$medal $rank</td>
                            <td>{$row['username']}</td>
                            <td>{$row['score']}</td>
                          </tr>";
                    $rank++;
                }
            } else {
                echo "<tr><td colspan='3'>No scores yet</td></tr>";
            }
            ?>
        </table>
    <?php endforeach; ?>

    <a href="../homepage.php" class="btn">Home</a>
</div>

</body>
</html>
