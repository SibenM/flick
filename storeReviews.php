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

        $username = $_SESSION['username'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $movie = $_POST['movie'];

        $sql = "INSERT INTO reviews (username, rating, review, movie) VALUES (?, ?, ?, ?)";

        try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $rating, $review, $movie);
        $stmt->execute();
        echo "REVIEW ADDED!";
        } catch (mysqli_sql_exception $e) {
            echo "ERROR WITH ADDING REVIEW!" . $e->getMessage();
        }
    ?>

    <a href="viewReviews.php">Back to view reviews</a>
</body>
</html>
