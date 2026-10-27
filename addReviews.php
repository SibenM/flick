<?php
    require_once 'header.php';
    
    if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
    } else {
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
    <h1>Add a Review</h1>
    <form action="storeReviews.php" method="POST">
        <label for="movie">Choose a movie:</label>
        <select name="movie" id="movie">
            <option value="avatar">Avatar</option>
            <option value="sinners">Sinners</option>
            <option value="sausage-party">Sausage Party</option>
            <option value="tnp">The Nutty Professor</option>
        </select>
        <br><br>
        <label for="rating">Rate from 1-5:</label>
        <select name="rating" id="rating">
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