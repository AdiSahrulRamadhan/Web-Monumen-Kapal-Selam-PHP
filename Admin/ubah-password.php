<?php
include '../cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: profile-admin.php");
    exit;
}

// Koneksi basis data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $repeat_new_password = $_POST['repeat_new_password'];
    $username = $_SESSION['Username']; // Ganti dengan nama pengguna sesi sebenarnya

    // Ambil kata sandi saat ini dari database menggunakan pernyataan yang telah disiapkan
    $sql = "SELECT Password FROM users WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['Password'];

        // Verifikasi kata sandi saat ini
        if (password_verify($current_password, $hashed_password)) {
            // Periksa apakah kata sandi baru dan ulangi kata sandi baru yang cocok
            if ($new_password === $repeat_new_password) {
                // Hash kata sandi baru
                $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                // Perbarui kata sandi dalam database menggunakan pernyataan yang telah disiapkan
                $update_sql = "UPDATE users SET Password = ? WHERE Username = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("ss", $new_hashed_password, $username);

                if ($update_stmt->execute()) {
                    // Kata sandi berhasil diperbarui
                    echo "<script>alert('Kata sandi berhasil diperbarui'); window.location.href='profile-admin.php#account-change-password';</script>";
                } else {
                    // Terjadi kesalahan saat memperbarui kata sandi
                    echo "<script>alert('Terjadi kesalahan saat memperbarui kata sandi: " . $update_stmt->error . "'); window.history.back();</script>";
                }

                // Tutup pernyataan pembaruan
                $update_stmt->close();
            } else {
                // Kata sandi baru dan ulangi kata sandi baru tidak cocok
                echo "<script>alert('Kata sandi baru dan ulangi kata sandi baru tidak cocok'); window.history.back();</script>";
            }
        } else {
            // Password saat ini salah
            echo "<script>alert('Password saat ini salah'); window.history.back();</script>";
        }
    } else {
        // Pengguna tidak ditemukan
        echo "<script>alert('Pengguna tidak ditemukan'); window.history.back();</script>";
    }

    // Tutup pernyataan pilih
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
