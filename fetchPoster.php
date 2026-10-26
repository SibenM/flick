<?php
// fetchPoster.php
session_start();

if (isset($_POST['poster_url'])) {
    $url = $_POST['poster_url'];

    $content = @file_get_contents($url);
    
    if ($content === false) {
        echo "Failed to fetch resource from: " . htmlspecialchars($url);
    } else {
        echo "<h3>Fetched Resource Content:</h3>";
        echo "<pre>" . htmlspecialchars(substr($content, 0, 300)) . "</pre>";
    }
}
?>

<form action="fetchPoster.php" method="POST">
    <label>Enter Movie Poster Image URL:</label><br>
    <input type="text" name="poster_url" style="width: 400px;" placeholder="http://127.0.0.1:3307">
    <button type="submit">Fetch Poster</button>
</form>