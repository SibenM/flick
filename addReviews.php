<?php
session_start();
if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
} else {
    header("Location: index.php");
    exit;
}
$conn = mysqli_connect("localhost", "root", "" , "flicks");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review = $_POST["review"];
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("INSERT INTO reviews (username, review) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $review);
    $stmt->execute();
    $stmt->close();
    mysqli_close($conn);

    header ("Location: viewReviews.php");
    exit();
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
    <h1>Add a Review</h1>
    <form action="">
        <label for="movies">Choose a movie:</label>
        <select name="movies" id="movies">
            <option value="avatar">Avatar</option>
            <option value="sinners">Sinners</option>
            <option value="sausage-party">Sausage Party</option>
            <option value="tnp">The Nutty Professor</option>
        </select>
        <br><br>
        <label for="ratings">Rate from 1-5:</label>
        <select name="ratings" id="ratings">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br><br>
        <label for="review">Write a short review:</label>
        <br><br>
        <textarea name="review" id="review" rows="4" cols="50"></textarea>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>