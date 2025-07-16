<?php
session_start();
include '../config.php';

// Cek login
$usermail = $_SESSION['usermail'] ?? '';
if (!$usermail) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Otentik Shoes Clean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar">
            <h5 class="text-white text-center">Admin Panel</h5>
            <a href="dashboard.php">Dashboard</a>
            <a href="bookings.php">Kelola Booking</a>
            <a href="users.php">Kelola Users</a>
            <a href="payment.php">Data Pembayaran</a>
            <a href="logout.php">Logout</a>
        </nav>

        <!-- Konten Utama -->
        <main class="col-md-10 p-4">
            <h2>Selamat Datang di Admin Panel</h2>
            <p>Kelola semua data booking, users, dan pembayaran Otentik Shoes Clean di sini.</p>
        </main>
    </div>
</div>

</body>
</html>
