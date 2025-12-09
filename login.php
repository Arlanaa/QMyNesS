<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $emailOrUser = mysqli_real_escape_string($conn, $_POST['email_or_username']);
    $password = $_POST['password'];

    // Query mencari berdasarkan username atau email
    $query = "SELECT * FROM pengguna 
              WHERE email='$emailOrUser' OR username='$emailOrUser'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $row['password'])) {

            // Cek verifikasi akun
            if ($row['verified'] == 0) {
                echo "<script>alert('Akun belum terverifikasi! Silahkan cek email.'); 
                window.location='verifikasi.php?email=" . $row['email'] . "';</script>";
                exit();
            }

            // Login sukses -> Set session
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['login'] = true;
            $_SESSION['role'] = $row['role'];

            // Cek role -> lalu arahkan
            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: home.php");
                exit();
            }

        } else {
            echo "<script>alert('Password salah!');</script>";
        }

    } else {
        echo "<script>alert('Email atau Username tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - MyHealthyNesS</title>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: linear-gradient(#0077e6, #0049b8);
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    .box {
        width: 85%;
        max-width: 350px;
        background: rgba(255, 255, 255, 0.15);
        padding: 25px;
        border-radius: 12px;
        backdrop-filter: blur(6px);
        text-align: center;
    }

    h2 {
        margin-bottom: 25px;
        font-size: 26px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: none;
        border-radius: 6px;
        font-size: 16px;
    }

    button {
        width: 100%;
        padding: 14px;
        background: white;
        color: #0066d6;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
    }

    button:hover {
        background: #e9e9e9;
    }

    p {
        margin-top: 15px;
        font-size: 14px;
    }

    a {
        color: #fff;
        font-weight: bold;
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="box">
    <h2>MyHealthyNesS</h2>

    <form action="" method="POST">
        <input type="text" name="email_or_username" placeholder="Email atau Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Masuk</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</div>

</body>
</html>
