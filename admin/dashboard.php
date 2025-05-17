<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once '../includes/db.php';

$rooms = $collection->find();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Room Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            padding-top: 40px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        .room-image {
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .logout-btn {
            position: absolute;
            right: 20px;
            top: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="#">🏠 Admin Dashboard</a>
    <a href="logout.php" class="btn btn-outline-light logout-btn">Logout</a>
</nav>

<div class="container">
    <h2 class="mb-4 text-center">Manage Rooms</h2>

    <div class="text-end mb-3">
        <a href="add_room.php" class="btn btn-success">➕ Add New Room</a>
    </div>

    <div class="row">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-4 mb-4">
                <div class="card p-3">
                    <img src="../uploads/<?php echo $room['image']; ?>" class="room-image mb-3 w-100" alt="Room">
                    <h5><?php echo htmlspecialchars($room['location']); ?></h5>
                    <p><strong>Cost:</strong> ₹<?php echo $room['cost']; ?></p>
                    <p><?php echo htmlspecialchars($room['features']); ?></p>
                    <div class="d-flex justify-content-between">
                        <a href="edit_room.php?id=<?php echo $room['_id']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <a href="delete_room.php?id=<?php echo $room['_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this room?');">🗑️ Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
