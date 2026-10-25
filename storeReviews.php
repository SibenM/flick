<?php
session_start();

if (empty($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'flicks');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn = mysqli_connect("localhost", "root", "", "flicks");
$stmt = $conn->prepare("INSERT INTO reviews (`username`, `review`) VALUES (?, ?)");
$stmt->bind_param("ss", $_SESSION['username'], $_POST['review']);
$stmt->execute();
?>

<p><a href="viewReviews.php">View your reviews!</a></p>