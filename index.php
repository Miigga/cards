<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Game - 21</title>
</head>
<body>
    <h1>Welcome to the 21 Card Game</h1>
    <form action="drawtwo.php" method="get">
        <input type="submit" value="Draw">
    </form>
</body>
</html>
