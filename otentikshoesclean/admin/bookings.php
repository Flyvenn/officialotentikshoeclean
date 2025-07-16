<?php
session_start();
include '../config.php';

// Autentikasi admin
$usermail = $_SESSION['usermail'] ?? '';
if (!$usermail) {
    header("Location: ../index.php");
    exit();
}

// Update status booking jika ada request
if (isset($_POST['update_status'])) {
    $bookingId = $_POST['booking_id'];
    $newStatus = $_POST['new_status'];
    mysqli_query($conn, "UPDATE shoe_booking SET booking_status = '$newStatus' WHERE id = $bookingId");
}

// Hapus booking jika ada request
if (isset($_GET['delete'])) {
    $bookingId = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM shoe_booking WHERE id = $bookingId");
    header("Location: bookings.php");
    exit();
}

// Filter berdasarkan status
$filter = $_GET['filter'] ?? 'all';
$status_filter_sql = $filter !== 'all' ? "WHERE booking_status = '$filter'" : '';

$bookings_query = mysqli_query($conn, "SELECT * FROM shoe_booking $status_filter_sql ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Booking - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <h2>Daftar Booking Sepatu</h2>

    <!-- Filter Status -->
    <form method="GET" class="mb-3">
        <label for="filter">Filter Status:</label>
        <select name="filter" id="filter" onchange="this.form.submit()" class="form-select w-auto d-inline-block ms-2">
            <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>Semua</option>
            <option value="Pending" <?= $filter == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="On Process" <?= $filter == 'On Process' ? 'selected' : '' ?>>On Process</option>
            <option value="Done" <?= $filter == 'Done' ? 'selected' : '' ?>>Done</option>
            <option value="Canceled" <?= $filter == 'Canceled' ? 'selected' : '' ?>>Canceled</option>
        </select>
    </form>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Service Type</th>
                <th>Shoe Type</th>
                <th>Pickup</th>
                <th>Return</th>
                <th>Price</th>
                <th>Status Booking</th>
                <th>Tanggal Booking</th>
                <th>Status Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($booking = mysqli_fetch_assoc($bookings_query)) :
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($booking['name']) ?></td>
                    <td><?= htmlspecialchars($booking['email']) ?></td>
                    <td><?= htmlspecialchars($booking['phone']) ?></td>
                    <td><?= htmlspecialchars($booking['service_type']) ?></td>
                    <td><?= htmlspecialchars($booking['shoe_type']) ?></td>
                    <td><?= htmlspecialchars($booking['pickup_date']) ?></td>
                    <td><?= htmlspecialchars($booking['return_date']) ?></td>
                    <td>Rp <?= number_format($booking['estimated_price'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($booking['booking_status']) ?></td>
                    <td><?= htmlspecialchars($booking['created_at']) ?></td>

                    <!-- Status Pembayaran -->
                    <td>
                        <?= $booking['payment_status'] === 'paid' 
                            ? '<span class="badge bg-success">Paid</span>' 
                            : '<span class="badge bg-warning text-dark">Unpaid</span>' ?>
                    </td>

                    <!-- Bukti Pembayaran -->
                    <td>
                        <?php if (!empty($booking['payment_proof'])): ?>
                            <a href="/otentikshoesclean/<?= htmlspecialchars($booking['payment_proof']) ?>" target="_blank">Lihat</a>

                        <?php else: ?>
                            <em>-</em>
                        <?php endif; ?>
                    </td>

                    <!-- Aksi -->
                    <td>
                        <!-- Form Ubah Status -->
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                            <select name="new_status" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option disabled selected>Ubah Status</option>
                                <option value="Pending">Pending</option>
                                <option value="On Process">On Process</option>
                                <option value="Done">Done</option>
                                <option value="Canceled">Canceled</option>
                            </select>
                            <input type="hidden" name="update_status" value="1">
                        </form>

                        <!-- Tombol Hapus -->
                        <a href="bookings.php?delete=<?= $booking['id'] ?>" 
                           class="btn btn-sm btn-danger mt-1"
                           onclick="return confirm('Yakin ingin menghapus booking ini?');">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="admin.php" class="btn btn-secondary mt-3">Kembali ke Admin Panel</a>

</body>
</html>
