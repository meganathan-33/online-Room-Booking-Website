<?php
require_once 'includes/db.php';
$rooms = $collection->find();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Room Booking Website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('assets/bg.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .navbar {
      background: rgba(0, 0, 0, 0.7) !important;
    }

    .admin-btn {
      position: absolute;
      top: 20px;
      right: 30px;
    }

    .hero-section {
      text-align: center;
      color: white;
      padding: 80px 20px 40px;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 12px;
      margin-bottom: 30px;
    }

    .hero-section h1 {
      font-weight: 600;
      font-size: 3rem;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: white;
      transition: all 0.3s ease;
    }

    .glass-card:hover {
      transform: scale(1.03);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
    }

    .glass-card img {
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    footer {
      background: rgba(0, 0, 0, 0.7);
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark px-4">
    <a class="navbar-brand fw-bold text-white" href="#">🏠 Room Booking</a>
    <a href="admin/login.php" class="btn btn-warning admin-btn">Admin Login</a>
  </nav>

  <div class="container mt-4">
    <div class="hero-section">
      <h1>Find Your Perfect Stay</h1>
      <p class="lead">Discover hand-picked rooms with best features and affordable prices.</p>
    </div>

    <div class="row">
      <?php foreach ($rooms as $room): ?>
        <div class="col-md-4 mb-4">
          <div class="card glass-card">
            <img src="uploads/<?php echo $room['image']; ?>" class="card-img-top" alt="Room Image" />
            <div class="card-body">
              <h5 class="card-title"><?php echo $room['location']; ?></h5>
              <p class="card-text">💰 ₹<?php echo $room['cost']; ?> / night</p>
              <p class="card-text">✨ <?php echo $room['features']; ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <footer class="text-white text-center py-3 mt-5">
    © <?php echo date("Y"); ?> Room Booking. All rights reserved.
  </footer>
</body>
</html>
