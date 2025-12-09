<?php
include "koneksi.php";

$email = $_POST['email'];
$kode = $_POST['kode'];

$query = "SELECT * FROM pengguna WHERE email='$email' AND verify_code='$kode' LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    mysqli_query($conn, "UPDATE pengguna SET verified=1, verify_code=NULL WHERE email='$email'");
    echo "<p>Verifikasi berhasil! Silahkan <a href='login.php'>login di sini</a>.</p>";

} else {
    echo "Kode verifikasi salah!";
}
