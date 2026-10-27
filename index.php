
<?php
    require_once 'header.php';
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32)); 
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="action.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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