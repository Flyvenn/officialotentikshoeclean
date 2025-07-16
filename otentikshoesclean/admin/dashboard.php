<?php
session_start();
include '../config.php';

// Autentikasi admin
$usermail = $_SESSION['usermail'] ?? '';
if (!$usermail) {
    header("Location: ../index.php");
    exit();
}

// Query Total Booking
$total_booking_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM shoe_booking");
$total_booking = mysqli_fetch_assoc($total_booking_query)['total'];

// Query Total User
$total_user_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM signup");
$total_user = mysqli_fetch_assoc($total_user_query)['total'];

// Query Total Pendapatan (status Done)
$total_income_query = mysqli_query($conn, "SELECT SUM(estimated_price) AS total FROM shoe_booking WHERE booking_status = 'Done'");
$total_income = mysqli_fetch_assoc($total_income_query)['total'] ?? 0;

// Query Statistik Service Type
$service_query = mysqli_query($conn, "SELECT service_type, COUNT(*) AS count FROM shoe_booking GROUP BY service_type");
$service_data = [];
while ($row = mysqli_fetch_assoc($service_query)) {
    $service_data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Otentik Shoes Clean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="p-4">

    <h2>Dashboard Admin</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Booking</h5>
                    <p class="card-text fs-3"><?= $total_booking ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total User</h5>
                    <p class="card-text fs-3"><?= $total_user ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <p class="card-text fs-3">Rp <?= number_format($total_income, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>

    <h4>Statistik Layanan</h4>
    <canvas id="serviceChart" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('serviceChart').getContext('2d');
        const serviceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($service_data, 'service_type')) ?>,
                datasets: [{
                    label: 'Jumlah Booking',
                    data: <?= json_encode(array_column($service_data, 'count')) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
<a href="admin.php" class="btn btn-secondary mt-3">Kembali ke Admin Panel</a>
</body>
</html>
