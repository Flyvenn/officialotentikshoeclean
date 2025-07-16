<?php
session_start();
include '../config.php';

// Cek login admin
$usermail = $_SESSION['usermail'] ?? '';
if (!$usermail) {
    header("Location: ../index.php");
    exit();
}

// Ambil ID booking
$booking_id = $_GET['id'] ?? 0;
$booking_query = mysqli_query($conn, "SELECT * FROM shoe_booking WHERE id = $booking_id");
$booking = mysqli_fetch_assoc($booking_query);

if (!$booking) {
    echo "Data booking tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Otentik Shoes Clean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-box {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }
    </style>
</head>
<body>

<div class="invoice-box mt-4">
    <h2 class="text-center">INVOICE</h2>
    <h4 class="text-center mb-4">Otentik Shoes Clean</h4>

    <p><strong>Invoice ID:</strong> <?= $booking['id'] ?></p>
    <p><strong>Nama:</strong> <?= htmlspecialchars($booking['name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
    <p><strong>Telepon:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
    <p><strong>Lokasi:</strong> <?= htmlspecialchars($booking['location']) ?></p>

    <hr>

    <h5>Detail Pemesanan</h5>
    <ul>
        <li>Service Type: <?= htmlspecialchars($booking['service_type']) ?></li>
        <li>Shoe Type: <?= htmlspecialchars($booking['shoe_type']) ?></li>
        <li>Shoe Condition: <?= htmlspecialchars($booking['shoe_condition']) ?></li>
        <li>Pickup Date: <?= htmlspecialchars($booking['pickup_date']) ?></li>
        <li>Return Date: <?= htmlspecialchars($booking['return_date']) ?></li>
        <li>Booking Status: <?= htmlspecialchars($booking['booking_status']) ?></li>
    </ul>

    <hr>

    <h5>Harga</h5>
    <p><strong>Estimasi Biaya:</strong> Rp <?= number_format($booking['estimated_price'], 0, ',', '.') ?></p>

    <p><strong>Tanggal Pemesanan:</strong> <?= $booking['created_at'] ?></p>

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">Cetak Invoice</button>
    </div>
</div>

</body>
</html>
