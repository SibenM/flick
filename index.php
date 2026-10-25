<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        session_destroy();

        session_start();
        // destroy last session for security
    ?>
<form action="viewReviews.php" method="POST">
    <p>Welcome To Flick!</p>

    <p>Login:</p>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="text" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
</form>
</body>
</html>