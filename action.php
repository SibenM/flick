<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $username = $_POST['username'];
        $password = $_POST['password'];

        $conn = new mysqli( "localhost", "root", "", "flicks", 3307);

        //$sql = "SELECT * FROM users WHERE username='". $username . "' and password='" . $password . "'";
        $sql = "SELECT * FROM users WHERE username=? and password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        try {
            $stmt->execute();
            $result = $stmt->get_result();
            if ( mysqli_num_rows($result) > 0 ) {
                echo "<p> Hello " . $username . "<p>";

                session_start();
                $_SESSION['login']=true;
                $_SESSION['username']=$username;
                
                $username = $_POST['username'];
                setcookie('username', $username);
                
            } else {
                echo "Incorrect login. Go back.";
            } 
        } catch (mysqli_sql_exception $e) {
            echo "ERROR!";
        }
    ?>

    <?php
    $stmt->close();
    mysqli_close($conn);
    ?>
    
    <br>
    <a href="viewReviews.php">View Review</a>
    <a href="addReviews.php">Add Review</a>
    <a href="deleteAccount.php">Delete Account</a>
    <a href="logout.php">Logout</a>
    <br>
</body>
</html>

<!--
        // ' or '1=1
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        try {
            $stmt->execute();
            $result = $stmt->get_result();
            if ( mysqli_num_rows($result) > 0 ) {
                echo "Hello user! ";
                session_start();
                $_SESSION['login']=true;
                
                $username = $_POST['username'];

                setcookie('username', $username);
                

                echo "Your username is " . $username;
                echo "<a href='addReviews.php'>Add Review</a>";
                echo "<p>REVIEWS HERE</p>";
            } else {
                echo "incorrect login. Go back.";
            } 
        } catch (mysqli_exception $e) {
            echo "ERROR!"; 
        } 
    ?>
-->