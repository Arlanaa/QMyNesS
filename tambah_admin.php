<?php
session_start();
include "koneksi.php";

// Cek admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, 
        "INSERT INTO pengguna(username,email,password,verify_code,verified,role)
         VALUES('$username','$email','$password', '000000', 1, 'admin')"
    );

    echo "<script>alert('Admin baru berhasil ditambahkan!');
    window.location='admin_dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Admin</title>
</head>
<body>

<h3>Tambah Admin Baru</h3>

<form method="POST">
    Username : <input type="text" name="username" required><br><br>
    Email : <input type="email" name="email" required><br><br>
    Password : <input type="password" name="password" required><br><br>
    <button type="submit" name="tambah">Tambah</button>
</form>

<br>
<a href="admin_dashboard.php">⬅ Kembali</a>

</body>
</html>
