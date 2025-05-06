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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Books</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<body style="background-image: url(assets/img/back.png);">

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logotext">
      <a href="catalog.html"><img class="logo" src="assets/img/Logo5.png" alt="MCPL logo"></a>
      <h1>Reading Club 2000</h1>
    </div>
    <ul class="nav-links">
      <li><a href="home.html">HOME</a></li>
      <li><a href="catalog.html" class="active">CATALOG</a></li>
      <li><a href="services.html">SERVICES</a></li>
      <li><a href="about.html">ABOUT US</a></li>
    </ul>
    <div class="Hamburger">
      <span class="Bar"></span>
      <span class="Bar"></span>
      <span class="Bar"></span>
    </div>
  </nav>
  
  <div class="container">
    <h1>📚 Available Books</h1>
    <div class="book-grid">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="book">
          <!-- Use the image URL directly from the database -->
          <img src="admin side/<?= htmlspecialchars($row['image_url']) ?>" alt="Book Image">
          <div class="details">
            <p><?= htmlspecialchars($row['title']) ?></p>
            <p style="font-size: 12px;"><?= htmlspecialchars($row['author']) ?></p>
            <a href="book_details.php?id=<?= $row['id'] ?>">
              <button>View Details</button>
            </a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <?php $conn->close(); ?>

  <script src="script.js"></script>
</body>
</html>
