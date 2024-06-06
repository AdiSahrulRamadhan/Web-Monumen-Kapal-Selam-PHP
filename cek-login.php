<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['UserID'])) {
    // Jika belum, arahkan kembali ke halaman login
    header("Location: log-login.php");
    exit;
}
?>
