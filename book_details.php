<?php
$host = "localhost";
$db = "ex";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$bookId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$result = $conn->query("SELECT * FROM sample WHERE id = $bookId LIMIT 1");
$book = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($book['title']) ?> - Details</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #f0f0f0;">
  <div class="container">
    <h1>📖 Book Details</h1>
    <div class="book-details">
      <img src="admin side/<?= htmlspecialchars($book['image_url']) ?>" alt="Book Image" style="width: 200px;">
      <h2><?= htmlspecialchars($book['title']) ?></h2>
      <p><strong>Author:</strong> <?= htmlspecialchars($book['author']) ?></p>
      <p><strong>Synopsis:</strong> <?= nl2br(htmlspecialchars($book['synopsis'])) ?></p>
      <p><strong>Status:</strong> 
        <?= $book['status'] === 'available' ? '<span style="color:green;">Available</span>' : '<span style="color:red;">Not Available</span>' ?>
      </p>

      <?php if ($book['status'] === 'available'): ?>
        <form action="reserve.php" method="post">
          <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
          <button type="submit">📌 Reserve This Book</button>
        </form>
      <?php else: ?>
        <p>📌 Reservation not allowed</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
