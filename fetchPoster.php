<?php
    require_once 'header.php';

if (isset($_POST['poster_url'])) {
    $posterlink = $_POST['poster_url'];

    if (!filter_var($posterlink, FILTER_VALIDATE_URL)) {
        echo "Invalid URL format.";
        exit;
    }

    $parsed_url = parse_url($posterlink);
    $scheme = strtolower($parsed_url['scheme'] ?? '');
    $host = strtolower($parsed_url['host'] ??'');

    $ip = gethostbyname($host);
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        echo "Access to private or reserved IP addresses is not allowed.";
        exit;
    }


    $content = @file_get_contents($posterlink);
    echo "Successfully fetched content from: " . htmlspecialchars($posterlink) . "<br>";
    
    if ($content === false) {
        echo "Failed to fetch resource from: " . htmlspecialchars($posterlink);
    } else {
        echo "<h3>Fetched Resource Content:</h3>";
        echo "<pre>" . htmlspecialchars(substr($content, 0, 300)) . "</pre>";
    }
}
?>

<form action="fetchPoster.php" method="POST">
    <label>Enter Movie Poster Image URL:</label><br>
    <input type="text" name="poster_url" style="width: 400px;" required><br><br>
    <button type="submit">Fetch Poster</button>
</form>