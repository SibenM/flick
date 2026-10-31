<?php
        require_once 'header.php';
        $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
               
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $conn = new mysqli( "localhost", "root", "", "flicks", 3307);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        //$sql = "SELECT * FROM users WHERE username='". $username . "' and password='" . $password . "'";
        $sql = "SELECT * FROM users WHERE username=? and password=?";
        $stmt = $conn->prepare($sql);
        error_log($conn->error);
        if ($stmt === false) {
            exit;
        }
        $stmt->bind_param("ss", $username, $password);

        try {
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result == false) {
                exit;
            }
            if ( mysqli_num_rows($result) > 0 ) {

                session_regenerate_id(true);

                $_SESSION['login']=true;
                $_SESSION['username']=$username;

                echo "<p> Hello " . htmlspecialchars((string)$username) . "</p>";
                echo '<br>
                <a href="addReviews.php">Add Review</a><br>
                <a href="viewReviews.php">View Reviews</a><br>
                <a href="fetchPoster.php">Fetch Poster via URL</a><br>
                <a href="deleteAccount.php">Delete Account</a><br>
                <a href="logout.php">Logout</a>
                <br>';

                
                

                $username = $_POST['username'];
                //setcookie('username', $username);
                
            } else {
                echo "Incorrect login. Go back.";
            } 
        } catch (mysqli_sql_exception $e) {
            echo "ERROR!";
        }
    ?>

</body>
</html>

