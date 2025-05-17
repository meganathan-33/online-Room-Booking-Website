<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $collection->insertOne([
        'location' => $_POST['location'],
        'cost' => $_POST['cost'],
        'features' => $_POST['features'],
        'image' => $image
    ]);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Room</title>
</head>
<body>
<h2>Add New Room</h2>
<form method="post" enctype="multipart/form-data">
    <label>Location:</label><br>
    <input type="text" name="location" required><br>
    <label>Cost:</label><br>
    <input type="number" name="cost" required><br>
    <label>Features:</label><br>
    <textarea name="features" required></textarea><br>
    <label>Image:</label><br>
    <input type="file" name="image" required><br><br>
    <input type="submit" value="Add Room">
</form>
</body>
</html>
