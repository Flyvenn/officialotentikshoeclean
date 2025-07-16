<?php
session_start();
include '../config.php';

// Autentikasi admin
$usermail = $_SESSION['usermail'] ?? '';
if (!$usermail) {
    header("Location: ../index.php");
    exit();
}

// Ambil data user dari signup
$users_query = mysqli_query($conn, "SELECT * FROM signup");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <h2>Daftar Users Terdaftar</h2>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>UserID</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($user = mysqli_fetch_assoc($users_query)) :
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($user['UserID']) ?></td>
                    <td><?= htmlspecialchars($user['Username']) ?></td>
                    <td><?= htmlspecialchars($user['Email']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<a href="admin.php" class="btn btn-secondary mt-3">Kembali ke Admin Panel</a>
</body>
</html>
