<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Selamat Datang, <?= $_SESSION['username']; ?> 🎉</h2>
<a href="logout.php">Logout</a>
