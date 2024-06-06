<?php
include '../cek-login.php';

if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: beli-tiket.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "testing");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nama_pembeli'], $_POST['no_telp'], $_POST['jumlah_tiket'], $_POST['metode_pembayaran'])) {
        $nama_pembeli = mysqli_real_escape_string($conn, $_POST['nama_pembeli']);
        $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
        $jumlah_tiket = (int)$_POST['jumlah_tiket'];
        $total_harga = $jumlah_tiket * 15000;
        $tgl_pembayaran = date('Y-m-d');
        $metode_pembayaran = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);
        $userID = $_SESSION['UserID'];

        $sql = "INSERT INTO tiket (UserID, nama_pembeli, no_telp, jumlah_tiket, total_harga, tgl_pembayaran, metode_pembayaran, status_tiket) VALUES ('$userID', '$nama_pembeli', '$no_telp', '$jumlah_tiket', '$total_harga', '$tgl_pembayaran', '$metode_pembayaran', 'Belum Terkonfirmasi')";

        if (mysqli_query($conn, $sql)) {
            header("Location: view-tickets.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "All fields are required.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Monumen Kapal Selam</title>
    <style>
        body {
            overflow-x: hidden;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #0A4773;
            color: white;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav ul li {
            margin-right: 20px;
            font-size: 20px; 
            position: relative; 
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 10px 20px; Add padding for better click area
            display: block; /* Ensure the anchor takes up the full space of the list item */
            text-align: center; /* Center text inside the anchor */
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition for background and text color */
        }

        nav ul li a:hover {
            text-decoration: none;
            background-color: black;
            color: #fff; /* Optional: change text color on hover */
            border-radius: 5px; /* Optional: rounded corners */
        }
        .container {
            width: 60%;
            margin: 20px auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: solid;
        }

        .content { 
            height: 89vh; 
            background-image: url('../Gambar/Picture15.png'); 
            background-size: cover;
            background-position: center;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content-box {
            text-align: justify;
            color: white; 
            background-color: rgba(0, 0, 0, 0.4);
            width: 100%;
            height: 100%;
        }

        .monumen {
            text-align: center;
            max-width: 80%; 
            margin: 0 auto; 
            margin-top: 40px;
        }

        .event {
            margin-top: 50px;
            display: flex;
            background-color: #295346E5; 
            color: white;
            padding: 50px;
        }

        .event h1 {
            color: black;
            border: 1px white;
            font-family: Patoa Print;
            font-style: italic;
            font: bold;
        }

        .fasilitas {
            color: black;
            text-align: center;
            max-width: 80%; 
            margin: 0 auto;
            padding: 50px;
            font-size: 50px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #0A4773E5;
            color: white;
            text-decoration: none;
            border: solid black;
            border-radius: 10px;
            cursor: pointer;
            display: inline-block;
            font-size: 20px;
        }

        figcaption {
            font-size: 25px; 
            color: #333; 
            margin-top: 5px; 
        }

        .informasi {
            display: flex;
            flex-wrap: wrap;
            background-color: #0A4773;
            color: white;
        }

        .judul {
            width: 100%;
            text-align: center;
            margin-top: 15px;
            font-family: Patoa One;
            font-style: italic;
            font: bold;
        }

        .informasi-kolom {
            flex: 1;
            margin: 10px 30px 40px;
            padding: 20px;
            color: white;
            text-align: justify;
            
        }

        .informasi-kolom:not(:last-child) {
            border-right: 2px solid white;
        }

        .informasi ul {
            list-style-type: none; 
            padding: 0; 
        }

        .informasi ul li a{
            color: white;
            font-size: 22px;
        }

        .kunjungan {
            background-color: white;
            display: flex;
            flex-wrap:wrap;
            justify-content: center; 
            align-items: center; 
        }

        .kunjungan-monumen {
            background-color: #0A4773;
            flex: 1;
            margin-left: 80px;
            margin-right: -80px;
            padding: 50px;
            color: white;
            text-align: justify;
            max-width: 50%; 
            border-radius: 10px;
        }

        .kunjungan-../gambar {
            flex: 1;
            margin-left: 10px;
            margin-right: 50px;
            padding: 70px;
            max-width: 50%; 
            text-align: center; 
        }
        
        .kunjungan-../gambar img {
            border-radius: 15px;
        }

        .dropdown-menu {
            position: absolute;
            width: 70px;
            list-style: none;
            background-color: #fff;
            border: 2px solid black;
            padding: 0;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
            left: -50px;
        }
        .dropdown-menu a {
            border-radius: 10px;
            width: 100%;
            color: #333; 
            padding: 8px 15px;
            display: block;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .dropdown-menu a:hover {
            background-color: #0A4773;
        }
        .dropdown-menu li a {
            font-size: 15px;
        }

        footer {
            background-color: #2D2C2C;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .footer-left, .footer-right {
            color: white;
        }

        .hidden {
            display: none;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 60px; 
            left: -240px;
            width: 240px;
            background-color: #0A4773;
            padding-top: 20px;
            z-index: 999;
            transition: left 0.3s;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar .list-group-item {
            border: none;
            border-radius: 0;
            padding: 15px 20px;
            color: white;
            background-color: #0A4773;
        }

        .sidebar .close-btn {
            position: absolute;
            top: 60px;
            right: 15px;
            font-size: 24px;
            color: white;
            cursor: pointer;
        }
        .menu-btn {
            font-size: 24px;
            cursor: pointer;
        }
                        /* Warna saat hover */
        .list-group-item:hover {
            background-color: rgba(0, 0, 0, 0.4); /* Warna hitam agak transparan */
        }

        /* Warna saat aktif */
        .list-group-item.active {
            background-color: rgba(0, 0, 0, 1); /* Warna hitam sedikit lebih gelap */
        }
    </style>
</head>
<body>

    <nav>
        <span class="menu-btn" onclick="toggleSidebar()">&#9776;</span>
        <img src="../Gambar/Picture2.png" alt="Logo Monumen Kapal Selam" style="width: 50px; height: 50px; margin-right: 10px;">
        <span style="font-size: 20px;"><a href="main.php" style="color: white; text-decoration: none; margin-right: 280px;  font-family: Segoe Print;">Monumen Kapal Selam</a></span>
        <ul>
            <li><a href="fasilitas.php">Fasilitas</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="sejarah.php">Sejarah</a></li>
            <li><a href="kontak.php">Kontak</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Tiket
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a href="tiket.php">Informasi Tiket</a></li>
                    <li><a href="beli-tiket.php">Beli Tiket</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a href="profile-admin.php" data-toggle="tab">Profile Saya</a></li>
                    <li><a href="profile-admin.php#account-change-password" data-toggle="tab">Ubah Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
            <li>Admin</li>
        </ul>
    </nav>
    <div class="sidebar" id="sidebar">
        <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action" href="data-user.php">Data User</a>
            <a class="list-group-item list-group-item-action" href="data-admin.php">Data Admin</a>
            <a class="list-group-item list-group-item-action" href="tiket-admin.php">Data Tiket</a>
            <a class="list-group-item list-group-item-action" href="ulasan-admin.php">Ulasan Pengunjung</a>
            <a class="list-group-item list-group-item-action" href="grafik-admin.php">Grafik Pengunjung</a>
        </div>
    </div>

    <div class="content"> 
        <div class="content-box">
            <div class="container">
                <h2>Pembelian Tiket</h2>
                <form method="POST" action="beli-tiket.php" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_pembeli" class="label">Nama</label>
                            <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Masukkan Nama Anda" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_telp" class="label">No. Telp</label>
                            <input type="tel" name="no_telp" id="no_telp" class="form-control" placeholder="Masukkan nomor telepon Anda" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="jumlah_tiket" class="label">Jumlah Tiket</label>
                            <input type="number" name="jumlah_tiket" id="jumlah_tiket" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="total_ticket_price" class="label">Total Harga</label>
                            <input type="text" id="total_ticket_price" class="form-control" readonly>
                            <input type="hidden" name="total_harga" id="total-harga">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tgl_pembayaran" class="label">Tanggal Pembayaran</label>
                            <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="metode_pembayaran" class="label">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required onchange="showBankAccount()">
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="Bank BCA - 123456 - A/N Monkasel">Bank BCA</option>
                                <option value="Bank BNI - 098765 - A/N Monkasel">Bank BNI</option>
                                <option value="Bank Mandiri - 112233 - A/N Monkasel">Bank Mandiri</option>
                                <option value="Bank BRI - 667788 - A/N Monkasel">Bank BRI</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bank_account" class="label">Rekening Bank</label>
                            <input type="text" id="bank_account" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn">Pesan Tiket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<footer id="footer">
        <div class="footer-left">
            Copyright © 2024 Monumen Kapal Selam Surabaya
        </div>
        <div class="footer-right">
            Powered by Monumen Kapal Selam Surabaya
        </div>
    </footer>

    <script>
        function showBankAccount() {
            var bank = document.getElementById('metode_pembayaran').value;
            var account = '';
            switch(bank) {
                case 'Bank BCA - 123456 - A/N Monkasel':
                    account = 'BCA - 123456 - A/N Monumen Kapal Selam';
                    break;
                case 'Bank BNI - 098765 - A/N Monkasel':
                    account = 'BNI - 098765 - A/N Monumen Kapal Selam';
                    break;
                case 'Bank Mandiri - 112233 - A/N Monkasel':
                    account = 'Mandiri - 112233 - A/N Monumen Kapal Selam';
                    break;
                case 'Bank BRI - 667788 - A/N Monkasel':
                    account = 'BRI - 667788 - A/N Monumen Kapal Selam';
                    break;
                default:
                    account = '';
            }
            document.getElementById('bank_account').value = account;
        }

        document.getElementById('jumlah_tiket').addEventListener('input', function() {
            var price = 15000;
            var total = this.value * price;
            document.getElementById('total_ticket_price').value = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            document.getElementById('total-harga').value = total;
        });
    </script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("show");
        document.getElementById("content").classList.toggle("shift");
        document.getElementById("footer").classList.toggle("shift");
    }

    function showProfile() {
        $('#account-change-password').removeClass('show active');
        $('#tiket-info').removeClass('show active');
        $('#ulasan-info').removeClass('show active');
        $('#grafik').removeClass('show active');
        $('#account-general').addClass('show active');
        $('#account-tab').tab('show');
    }

    function showChangePassword() {
        $('#account-general').removeClass('show active');
        $('#tiket-info').removeClass('show active');
        $('#ulasan-info').removeClass('show active');
        $('#grafik').removeClass('show active');
        $('#account-change-password').addClass('show active');
        $('#account-tab').tab('show');
    }

    function showTickett() {
        $('#account-general').removeClass('show active');
        $('#account-change-password').removeClass('show active');
        $('#ulasan-info').removeClass('show active');
        $('#grafik').removeClass('show active');
        $('#tiket-info').addClass('show active');
        $('#account-tab').tab('show');
    }

    function showUlasan() {
        $('#account-general').removeClass('show active');
        $('#account-change-password').removeClass('show active');
        $('#tiket-info').removeClass('show active');
        $('#grafik').removeClass('show active');
        $('#ulasan-info').addClass('show active');
        $('#account-tab').tab('show');
    }

    function showGrafik() {
        $('#account-general').removeClass('show active');
        $('#account-change-password').removeClass('show active');
        $('#tiket-info').removeClass('show active');
        $('#ulasan-info').removeClass('show active');
        $('#grafik').addClass('show active');
        $('#account-tab').tab('show');
    }

    function showTicket() {
        document.getElementById("ticket-table-card").classList.add("hidden");
        document.getElementById("tiket-infoo").classList.remove("hidden");
        document.getElementById("tiket-infoo").classList.add("show", "active");
    }

    function goBack() {
        document.getElementById("tiket-infoo").classList.remove("show", "active");
        document.getElementById("tiket-infoo").classList.add("hidden");
        document.getElementById("ticket-table-card").classList.remove("hidden");
    }

    function hapusTicket() {
        alert("Fungsi hapus belum diimplementasikan.");
    }

    const data = {
        labels: ['2024-05-01', '2024-05-02', '2024-05-03'], 
        datasets: [{
            label: 'Jumlah Tiket Terjual',
            data: [10, 15, 20], 
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

</body>
</html>
