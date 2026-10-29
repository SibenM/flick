<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
    $host = strtolower($parsed_url['host'] ?? '');

    if (!in_array($scheme, ['http', 'https'])) {
        echo "Only http/https URLs are allowed.";
        exit;
    }

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
        $posterDir = __DIR__ . '/posters';
        if (!is_dir($posterDir)) {
            mkdir($posterDir, 0755, true);
        }

        $filename = 'poster_' . uniqid() . '.jpg';
        $filepath = $posterDir . '/' . $filename;
        file_put_contents($filepath, $content);

        echo "Successfully fetched content from: " . htmlspecialchars($url) . "<br><br>";
        echo "<h3>Fetched Poster:</h3>";
        echo '<img width="200" src="posters/' . htmlspecialchars($filename) . '" alt="Fetched poster">';

        echo "<h3>Raw Response: </h3>";
        echo "<pre>" . htmlspecialchars(substr($content, 0, 1000)) . "</pre>";
    }
}
?>

<form action="fetchPoster.php" method="POST">
    <label>Enter Movie Poster Image URL:</label><br>
    <input type="text" name="poster_url" style="width: 400px;" required><br><br>
    <button type="submit">Fetch Poster</button>
</form>

</body>
</html>