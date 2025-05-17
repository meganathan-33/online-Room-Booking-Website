<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require_once '../includes/db.php';
require_once '../vendor/autoload.php';

use MongoDB\BSON\ObjectId;

$id = $_GET['id'];
$room = $collection->findOne(['_id' => new ObjectId($id)]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updateData = [
        'location' => $_POST['location'],
        'cost' => $_POST['cost'],
        'features' => $_POST['features']
    ];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $updateData['image'] = $image;
    }

    $collection->updateOne(
        ['_id' => new ObjectId($id)],
        ['$set' => $updateData]
    );

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
</head>
<body>
<h2>Edit Room</h2>
<form method="post" enctype="multipart/form-data">
    <label>Location:</label><br>
    <input type="text" name="location" value="<?php echo $room['location']; ?>" required><br>
    <label>Cost:</label><br>
    <input type="number" name="cost" value="<?php echo $room['cost']; ?>" required><br>
    <label>Features:</label><br>
    <textarea name="features" required><?php echo $room['features']; ?></textarea><br>
    <label>Image:</label><br>
    <input type="file" name="image"><br><br>
    <input type="submit" value="Update Room">
</form>
</body>
</html>
