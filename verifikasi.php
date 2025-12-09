<?php
$email = $_GET['email'] ?? '';
?>

<form action="cek_kode.php" method="POST">
    <input type="hidden" name="email" value="<?= $email ?>">
    <input type="text" name="kode" placeholder="Masukkan kode verifikasi" required maxlength="6">
    <button type="submit">Verifikasi</button>
</form>
