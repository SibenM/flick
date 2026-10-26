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

    if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
    }   else {
        header("Location: index.php");
    exit;
    }

    $conn = new mysqli("localhost", "root", "", "flicks", 3307);
    if ($conn->connect_error) {
        die("Connection failed.");
    }

    $username = $_COOKIE['username'];

    $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        setcookie('username', '');
        session_destroy();
        echo "Your account has been deleted. <a href='index.php'>Home</a>";
    } else {
        echo "Error deleting account. <a href='index.php'>Home</a>";
    }

$stmt->close();
$conn->close();
?>
</body>
</html>

