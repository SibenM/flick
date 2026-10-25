<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>View Reviews</h1>

    <?php
<<<<<<< HEAD
        session_start();

        if (empty($_SESSION['login'])) {
            header("Location: index.php");
            exit;
        }

        
    ?>
    <p>WE WILL SHOW REVIEWS HERE</p>
=======
   session_start();
if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
} else {
    header("Location: index.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'flicks', 3307);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT * FROM reviews");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Username: " . $row["username"] . "</p>";
        echo "<p>Rating: " . $row["rating"] . "</p>";
        echo "<p>Review: " . $row["review"] . "</p>";
        echo "<p>Movie: " . $row["movie"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "<p>No reviews found.</p>";
}

?>
    
    <br>
>>>>>>> b6938e468f33dd74c0a02303f9126af61800d30e
    <a href="addReviews.php">Add Review</a>
    <a href="logout.php">Logout</a>
    <br>
</body>
</html>

