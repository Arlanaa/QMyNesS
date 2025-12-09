<?php
include "koneksi.php";

$usernameError = "";
$emailError = "";
$formValid = true;

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check Username
    $checkUsername = mysqli_query($conn, "SELECT * FROM pengguna WHERE username='$username'");
    if (mysqli_num_rows($checkUsername) > 0) {
        $usernameError = "Username ini sudah digunakan!";
        $formValid = false;
    }

    // Check Email
    $checkEmail = mysqli_query($conn, "SELECT * FROM pengguna WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $emailError = "Email ini sudah terdaftar!";
        $formValid = false;
    }

    // Jika lolos cek → pindah ke file proses
    if ($formValid) {
        session_start();
        $_SESSION['reg_username'] = $username;
        $_SESSION['reg_email'] = $email;
        $_SESSION['reg_password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        header("Location: register_process.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
    body { font-family: Arial, sans-serif; background:#e9e9e9; }
    .box { width: 300px; margin:80px auto; background:white; padding:25px; border-radius:10px; }
    input { width:100%; padding:10px; margin:8px 0; border:1px solid black; border-radius:5px; }
    button { width:100%; padding:10px; background:blue; color:white; border:none; border-radius:5px; cursor:pointer; }
    button:hover { background:darkblue; }
    p.error { color:red; margin-top:-5px; font-size:13px; }
</style>
</head>
<body>

<div class="box">
    <h2>Register</h2>
    <form action="" method="POST">

        <input type="text" name="username" placeholder="Masukkan Username"
            value="<?= $_POST['username'] ?? '' ?>" required>
        <?php if ($usernameError) echo "<p class='error'>$usernameError</p>"; ?>

        <input type="email" name="email" placeholder="Masukkan Email"
            value="<?= $_POST['email'] ?? '' ?>" required>
        <?php if ($emailError) echo "<p class='error'>$emailError</p>"; ?>

        <input type="password" name="password" placeholder="Masukkan Password" required>

        <button type="submit" name="register">Daftar</button>
    </form>

    <p style="text-align:center;">
        Sudah punya akun? <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>
