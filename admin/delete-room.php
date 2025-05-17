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
$collection->deleteOne(['_id' => new ObjectId($id)]);

header("Location: dashboard.php");
exit();
?>
