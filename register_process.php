<?php
session_start();
include "koneksi.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Jika akses langsung tanpa register, kembalikan ke form
if (!isset($_SESSION['reg_email'])) {
    header("Location: register.php");
    exit();
}

$username = $_SESSION['reg_username'];
$email = $_SESSION['reg_email'];
$password = $_SESSION['reg_password'];

$code = rand(100000, 999999);

// Insert data
$query = "INSERT INTO pengguna (username, email, password, verify_code, verified)
          VALUES ('$username', '$email', '$password', '$code', 0)";
mysqli_query($conn, $query);

// Kirim Email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'qmyness@gmail.com';
    $mail->Password = 'nhacxhdyozrwwcvh';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('adityarehandikamaulana@gmail.com', 'MyHealthyNesS');
    $mail->addAddress($email);
    $mail->isHTML(true);

    $mail->Subject = "Kode Verifikasi Akun Anda";
    $mail->Body = "
        <p>Halo <b>$username</b>,</p>
        <p>Berikut kode verifikasi akun Anda:</p>
        <h2 style='color:blue;'>$code</h2>
        <p><b>Terima kasih!</b></p>
    ";

    $mail->send();

    // Bersihkan session
    unset($_SESSION['reg_username'], $_SESSION['reg_email'], $_SESSION['reg_password']);

    header("Location: verifikasi.php?email=$email");
    exit();

} catch (Exception $e) {
    echo "Gagal mengirim email: {$mail->ErrorInfo}";
}
?>
