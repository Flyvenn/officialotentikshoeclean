<?php
session_start();
include '../config.php';

// Cek login admin
$usermail = $_SESSION['usermail'] ?? '';
if (!$usermail) {
    header("Location: ../index.php");
    exit();
}

// Ambil semua data booking yang sudah selesai atau dalam proses pembayaran
$payments_query = mysqli_query($conn, "SELECT * FROM shoe_booking WHERE booking_status IN ('Done', 'On Process') ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pembayaran - Otentik Shoes Clean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <h2>Data Pembayaran</h2>
    <p>Daftar pesanan yang telah selesai atau dalam proses pembayaran.</p>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Service</th>
                <th>Shoe</th>
                <th>Pickup</th>
                <th>Return</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pay = mysqli_fetch_assoc($payments_query)) : ?>
                <tr>
                    <td><?= htmlspecialchars($pay['name']) ?></td>
                    <td><?= htmlspecialchars($pay['email']) ?></td>
                    <td><?= htmlspecialchars($pay['phone']) ?></td>
                    <td><?= htmlspecialchars($pay['service_type']) ?></td>
                    <td><?= htmlspecialchars($pay['shoe_type']) ?></td>
                    <td><?= htmlspecialchars($pay['pickup_date']) ?></td>
                    <td><?= htmlspecialchars($pay['return_date']) ?></td>
                    <td><?= htmlspecialchars($pay['booking_status']) ?></td>
                    <td>Rp <?= number_format($pay['estimated_price'], 0, ',', '.') ?></td>
                    <td>
                        <a href="invoiceprint.php?id=<?= $pay['id'] ?>" target="_blank" class="btn btn-sm btn-primary">Invoice</a>
                        <a href="paymantdelete.php?id=<?= $pay['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data pembayaran ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>

</body>
</html>
