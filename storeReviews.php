<?php
        require_once 'header.php';

        if (empty($_SESSION['login'])) {
            header("Location: index.php");
            exit;
        }
        
        $conn = new mysqli( "localhost", "root", "", "flicks", 3307);

        $username = $_SESSION['username'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $movie = $_POST['movie'];

        $sql = "INSERT INTO reviews (username, rating, review, movie) VALUES (?, ?, ?, ?)";

        try {
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("ssss", $username, $rating, $review, $movie);
        $stmt->execute();
        echo "REVIEW ADDED!";
        } catch (mysqli_sql_exception $e) {
            echo "ERROR WITH ADDING REVIEW!" . $e->getMessage();
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
    

    <a href="viewReviews.php">Back to view reviews</a>
</body>
</html>
