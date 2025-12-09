<?php
session_start();
include "koneksi.php";

// Cek role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil semua user
$result = mysqli_query($conn, "SELECT * FROM pengguna ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
</head>
<body>

<h2>Dashboard Admin</h2>
<p>Halo Admin, <?= $_SESSION['username']; ?> 👋</p>

<!-- Tombol tambah admin -->
<p><a href="tambah_admin.php">➕ Tambah Admin Baru</a></p>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status Verifikasi</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= ($row['verified'] == 1) ? '✔ Verified' : '❌ Belum' ?></td>
        <td><?= $row['role']; ?></td>
        <td>
            <?php if($row['role'] != 'admin') { ?>
                <a href="hapus_user.php?id=<?= $row['id']; ?>" 
                   onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
            <?php } ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="logout.php">Logout</a>

</body>
</html>
