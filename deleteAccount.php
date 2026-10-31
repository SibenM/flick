<?php
    require_once 'header.php';

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
    <input type="hidden" name="csrf_token" value="<?php echo (string)$_SESSION['csrf_token']; ?>">
    <?php
    $username = (string) $_SESSION['username'];
    echo "<p> Hello " . $username . "</p>";

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION["csrf_token"]) {
        } else {
            echo "Invalid CSRF token. Account deletion request denied.";
            exit;
        }

    $password = $_POST["password"] ?? '';

    $conn = new mysqli("localhost", "root", "", "flicks", 3307);
    if ($conn->connect_error) {
        die("Connection failed.");
    }

    $checkStmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $result = $checkStmt->get_result()->fetch_assoc();

    if (!$result || $result["password"] !== $password) {
    echo "Incorrect password. Account deletion denied.";
    exit;
    }

    $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    error_log($conn->error);
    if ($stmt === false) {
                exit;
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
