<?php
session_start();

if (empty($_SESSION['login'])) {
    header("Location: login.html");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'flicks');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn = mysqli_connect("localhost", "root", "", "flicks");
$stmt = $conn->prepare("INSERT INTO userThoughts (`user`, `thoughts`) VALUES (?, ?)");
$stmt->bind_param("ss", $_SESSION['username'], $_POST['thought']);
$stmt->execute();
?>

<p><a href="viewContent.php">View your reviews!</a></p>