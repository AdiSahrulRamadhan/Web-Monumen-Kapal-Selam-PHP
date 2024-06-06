<?php
include 'cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: tiket.php");
    exit;
}
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
            justify-content: center; /* Center the navigation menu */
        }

        nav ul li {
            margin-right: 10px;
            font-size: 20px;
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 10px 20px; /* Add padding for better click area */
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

        .content {
            margin: 0;
            padding: 20px; 
            height: 45vh; 
            background-image: url('Gambar/Picture15.png'); 
            background-size: cover;
            background-position: center;
            color: white;
            text-align: left;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .content-box {
            position: absolute;
            bottom: 0;
            left: 0;
            margin-left: 90px; 
            margin-bottom:350px;
            text-align: justify;
            color: white; 
        }

        .content h1 {
            font-size: 40px;
            font-family: Patua One;
            font-style: italic;
        }

        .tiket {
            max-width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .divider {
            width: 100%;
            margin: 20px auto;
            border: 3px solid #2697FF;
        }

        .content-tiket {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .item {
            text-align: justify;
        }

        .item img {
            max-width: 100%;
            border-radius: 15px;
        }

        @media screen and (max-width: 768px) {
            .content {
                grid-template-columns: 1fr;
            }
        }

        .pesan {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background-color: #8E8E8E;
            border-radius: 10px;
        }

        .pesan input[type="button"] {
            border-radius: 30px;
            padding: 5px 10px;
            width: 30px;
            margin: 0 5px;
            font-size: 16px;
            cursor: pointer;
            border: solid;
            background-color: transparent;
        }

        .pesan input[type="button"]:hover {
            background-color: #696969;
        }

        .btn {
            padding: 10px 20px;
            background-color: #0A4773E5;
            color: white;
            text-decoration: none;
            border: 1px black;
            border-radius: 10px;
            cursor: pointer;
            display: inline-block;
            font-size: 20px;
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
    </style>
</head>
<body>

    <nav>
        <img src="Gambar/Picture2.png" alt="Logo Monumen Kapal Selam" style="width: 60px; height: 60px; margin-left: 50px; margin-right: -270px;">
        <span style="font-size: 25px;"><a href="main.php" style="color: white; text-decoration: none; font-family: Segoe Print;">Monumen Kapal Selam</a></span>
        <ul>
            <li><a href="main.php">Beranda</a></li>
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
                    <li><a href="profile.php#account-info" data-toggle="tab">Tiket Saya</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a href="profile.php#account-general" data-toggle="tab">Profile Saya</a></li>
                    <li><a href="profile.php#account-change-password" data-toggle="tab">Ubah Password</a></li>
                    <li><a href="profile.php#account-info" data-toggle="tab">Tiket Saya</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

<div class="content"> 
    <div class="content-box">
        <h1 style="text-shadow: -1px -1px 0 black,  
        1px -1px 0 black,
       -1px  1px 0 black,
        1px  1px 0 black;">Tiket</h1>
        <hr style="width: 100%; margin: 10px auto; border: 3px solid white;">
    </div>
</div>

<div class="tiket">
    <h1 style="text-align: center; font-style: italic;">Tiket Monumen Kapal Selam</h1>
    <hr style="width: 40%; border: 2px solid #2697FF;">
    <p style="text-align: center;">Jl. Pemuda No.39, Embong Kaliasin, Kec. Genteng, Surabaya, Jawa Timur 60271</p>
    <p style="text-align: center;">Jam Buka : 08:00 - 21.00, Senin - Minggu</p>
    <h2 style="text-align: center; font-style: italic;">Pemesanan Tiket Terdapat 2 Metode :</h2>
    <div class="content-tiket">
        <div class="item">
            <img src="Gambar/Picture18.png" alt="">
        </div>
        <div class="item">
            <h5>1. Pemesanan Tiket Offline / Langsung Ditempat</h5>
            <p>Caranya Kamu Bisa datang langsung kelokasi dari Monumen Kapal Selam Surabaya, disana sudah tersedia kasir atau loket untuk tiket masuk dari monumen. Harga dari tiket masuknya sebesar Rp. 15.000 Ribu anda sudah bisa mendapatkan biaya untuk arena, kapal selam, dan menonton film dokumenter.</p>
        </div>
    </div>
    <hr class="divider">
    <div class="content-tiket">
        <div class="item">
            <img src="Gambar/Picture40.png" alt="">
        </div>
        <div class="item">
            <h5>2. Pemesanan Tiket Online</h5>
            <p>Caranya Kamu Bisa langsung klik menu tiket maka akan muncul dropdown dari Web Monumen Kapal Selam Surabaya, setelah kamu klik disini sudah tersedia untuk pemesanan tiket masuk dari monumen. Harga dari tiket masuknya sama besarnya dengan offline sebesar Rp. 15.000.
                setelah kamu memesan tiket kamu bisa langsung cek saja pada menu ikon profil disana terdapat dropdown tiket saya jika sudah masuk maka seharusnya muncul detail tiket anda. Jika sudah dipastikan pesanan anda benar maka pesanan tiket anda bisa digunakan ketika ditempat anda tinggal menunjukkan kode tiket.
            </p>
        </div>
    </div>
    <hr class="divider">
    <div class="content-tiket">
        <div class="item">
            <h5>Tata Cara Pemesanan Online</h5>
            <li>Setelah Masuk Login Klik Navbar Bagian Tiket</li>
            <li>Terdapat Dropdown 3 Dropdown Klik Beli Tiket</li>
            <li>Maka Anda Seharusnya Anda Sudah Pada Form Beli Tiket</li>
            <li>Pesan Sesuai Yang Anda Inginkan</li>
            <li>Setelah Sesuai Pilih Metode Pembayaran</li>
            <li>Lakukan Pembayaran Sesuai Metode Anda</li>
            <li>Jika Sudah Kirim Bukti Pemabayarannya Minimal 5MB</li>
            <li>Klik Beli Tiket Jika Sudah Lengkap & Sesuai</li>
            <li>Jika Berhasil Maka Ada Notifikasi Berhasil & Kode Tiket Anda</li>
        </div>
        <div class="item">
        <h5>Tata Cara Mengecek & Pemakaian Tiket</h5>
            <li>Setelah Anda Berhasil Membeli Tiket</li>
            <li>Terdapat Dropdown 3 Dropdown Klik Tiket Saya</li>
            <li>Jika Sudah Maka Terdapat Riwayat Tiket Anda</li>
            <li>Pemakaian Dapat Digunakan Setelah Status Anda Terkonfirmasi</li>
            <li>Jika Sudah Terkonfirmasi Maka Anda dapat Segera Memakainya</li>
            <li>Karena Batas Status Kadaluwarsa Tiket Hanya 1 Hari Setelah Pemesanan Tiket</li>
            <li>Jika Tiket Anda Terkonfirmasi Anda Bisa Menunjukkan Saat Ke Pintu Masuk Suapaya dicek Oleh Pegawai</li>
            <li>Jika Status Terkonfirmasi Anda dapat Diperbolehkan Masuk</li>
            <li>Jika Status Belom Terkonfirmasi atau Kadaluwarsa Maka Tidak diperbolehkan Masuk</li>
        </div>
    </div>
</div>


<footer>
    <div class="footer-left">
        Copyright © 2024 Monumen Kapal Selam Surabaya
    </div>
    <div class="footer-right">
        Powered by Monumen Kapal Selam Surabaya
    </div>
</footer>


</body>
</html>