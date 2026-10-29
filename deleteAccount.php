<?php
    header_remove("X-Powered-By");
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; object-src 'none'; frame-ancestors 'none'; form-action 'self';");
    session_start();

    if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
    }   else {
        header("Location: index.php");
    exit;
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form method="POST" action="">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <?php
    $username = $_SESSION['username'];
    echo "<p> Hello " . $username . "</p>";

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION["csrf_token"]) {
        } else {
            echo "Invalid CSRF token. Account deletion request denied.";
            exit;
        }
    $conn = new mysqli("localhost", "root", "", "flicks", 3307);
    if ($conn->connect_error) {
        die("Connection failed.");
    }

    $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
    $stmt->bind_param("s", $username);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        setcookie('username', '', time() - 3600, '/');
        session_destroy();
        echo "Your account has been deleted. <a href='index.php'>Home</a>";
    } else {
        echo "Error deleting account. <a href='index.php'>Home</a>";
    }

    $stmt->close();
    $conn->close();

    } else {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    } 
?>
    <p>Are you sure you want to delete your account?</p>
    <button type="submit">Yes, delete my account</button>
</form>

</body>
</html>
