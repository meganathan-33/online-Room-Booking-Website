<?php
session_start();
require_once '../includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = $db->admin->findOne(['username' => $username, 'password' => $password]);

    if ($admin) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "❌ Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Login - Room Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('assets/bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            color: #fff;
        }
        .login-box h2 {
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            color: #ffc107;
        }
        .form-label {
            color: #ffc107;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        .form-control::placeholder {
            color: #ccc;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            box-shadow: none;
            border-color: #ffc107;
        }
        .btn-login {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            transition: 0.3s ease;
        }
        .btn-login:hover {
            background-color: #e0a800;
        }
        .alert {
            background-color: rgba(255, 0, 0, 0.7);
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>🔐 Admin Login</h2>
            <?php if ($error): ?>
                <div class="alert"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required />
                </div>
                <button type="submit" class="btn btn-login w-100 mt-3">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
