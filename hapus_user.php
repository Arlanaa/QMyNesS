<?php
session_start();
include "koneksi.php";

// Cek role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM pengguna WHERE id='$id'");
}

header("Location: admin_dashboard.php");
exit();
