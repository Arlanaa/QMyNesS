<?php
session_start();
include "../koneksi.php";

$query = "SELECT * FROM pengguna";
$result = mysqli_query($conn, $query);
?>

<h2>Daftar Pengguna</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
    <th>Aksi</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['username']; ?></td>
    <td><?= $row['email']; ?></td>
    <td><?= $row['role']; ?></td>
    <td><a href="hapus_user.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus user ini?');">Hapus</a></td>
</tr>
<?php } ?>
</table>
