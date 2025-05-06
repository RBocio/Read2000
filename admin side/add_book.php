<?php
$host = "localhost";
$db = "ex";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$author = $_POST['author'];
$synopsis = $_POST['synopsis'];

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir);

    $fileName = basename($_FILES['image']['name']);
    $targetFile = $uploadDir . time() . "_" . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO sample (title, author, image_url, synopsis) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $author, $targetFile, $synopsis);
        $stmt->execute();
        header("Location: home.php");
        exit();
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "No image uploaded.";
}

$conn->close();
?>
