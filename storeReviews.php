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

        if (empty($_SESSION['login'])) {
            header("Location: index.php");
            exit;
        }
        
        $conn = new mysqli( "localhost", "root", "", "flicks", 3307);

        $username = $_COOKIE['username'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $movie = $_POST['movie'];

        $sql = "INSERT INTO reviews VALUES ('$username', '$rating', '$review', '$movie')";

        try {
           if ($conn->query($sql) === true) {
                echo "REVIEW ADDED!";
           } else {
                echo "ERROR WITH ADDING REVIEW";
           }
        } catch (mysqli_exception $e) {
            echo "ERROR WITH ADDING REVIEW";
        }
    ?>

    <a href="viewReviews.php">Back to view reviews</a>
</body>
</html>
