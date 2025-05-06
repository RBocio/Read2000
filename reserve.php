<?php
$host = "localhost";
$db = "ex";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$bookId = isset($_POST['book_id']) ? intval($_POST['book_id']) : 0;

$conn->query("UPDATE sample SET status = 'unavailable' WHERE id = $bookId");
$conn->close();

header("Location: book_details.php?id=$bookId");
exit();
