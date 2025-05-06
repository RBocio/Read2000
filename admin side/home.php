<?php
$host = "localhost";
$db = "ex"; 
$user = "root"; 
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM sample ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin - Add Book</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f0f0; padding: 40px; }
    h2 { text-align: center; margin-bottom: 30px; }
    form {
      background: #fff; padding: 20px; width: 400px; margin: 0 auto 40px;
      border-radius: 10px; box-shadow: 0 0 10px #ccc;
    }
    label { display: block; margin-top: 15px; }
    input { width: 100%; padding: 8px; margin-top: 5px; }
    textarea { width: 100%; padding: 8px; margin-top: 5px; }
    button {
      margin-top: 20px; padding: 10px; background: #1f3045;
      color: #fff; border: none; cursor: pointer; width: 100%;
    }
    .book-grid {
      display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;
    }
    .book-card {
      background: #fff; border: 1px solid #ccc; border-radius: 10px;
      width: 200px; padding: 15px; box-shadow: 0 0 5px rgba(0,0,0,0.1); text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .book-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .book-card img {
      width: 100%; height: 250px; object-fit: cover; border-radius: 5px;
    }
    .book-card .book-title {
      margin-top: 10px;
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }
    .book-card .book-author {
      font-size: 14px;
      color: #555;
      margin-top: 5px;
    }
    .book-card .delete-btn-container {
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }
    .book-card button {
      background-color: #ff4d4d; 
      color: white;
      border: none; 
      cursor: pointer;
      padding: 8px 16px;
      border-radius: 5px;
      font-size: 14px;
      transition: background-color 0.3s;
    }
    .book-card button:hover {
      background-color: #e60000;
    }

  </style>
</head>
<body>

  <h2>Add a New Book</h2>
  <form action="add_book.php" method="POST" enctype="multipart/form-data">
    <label>Book Title</label>
    <input type="text" name="title" required>

    <label>Author</label>
    <input type="text" name="author" required>

    <label>Synopsis</label>
    <textarea name="synopsis" placeholder="Write synopsis here..." rows="5" required></textarea><br>

    <label>Upload Image</label>
    <input type="file" name="image" accept="image/*" required>

    <button type="submit">Add Book</button>
  </form>

  <h2>Manage Books</h2>
  <div class="book-grid">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="book-card">
        <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Book Image">
        <div class="book-title"><?= htmlspecialchars($row['title']) ?></div>
        <div class="book-author">by <?= htmlspecialchars($row['author']) ?></div>
        <div class="delete-btn-container">
          <form method="POST" action="delete_book.php" onsubmit="return confirm('Are you sure you want to delete this book?')">
            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
            <button type="submit">Delete</button>
          </form>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <?php $conn->close(); ?>
</body>
</html>
