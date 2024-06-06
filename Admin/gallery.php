<?php
include '../cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: gallery.php");
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .content {
            margin: 0;
            padding: 20px; 
            height: 45vh; 
            background-image: url('../Gambar/Picture18.png'); 
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
            margin-bottom: 350px;
            text-align: justify;
            color: white; 
        }

        .content h1 {
            font-size: 40px;
            font-family: Patua One;
            font-style: italic;
        }

        .gallery-pengunjung, .gallery-kapal, .gallery-monumen {
            height: 100%;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .Gallery h1 {
            font-style: italic;
        }

        .Gallery h2 {
            margin-left: 100px;
            margin-top: 30px;
        }

        .gallery-images {
            width: 620px;
            height: 410px;
            margin: 30px;
            background-color: lightcyan;
            border: black 1px solid;
            border-radius: 15px;
        }

        .gallery-images p {
            text-align: center;
            font-size: 25px;
            font: bold;
            margin: 10px;
        }

        .gallery-images img {
            width: 620px;
            height: 350px;
            border: solid;
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
    <img src="../Gambar/Picture2.png" alt="Logo Monumen Kapal Selam" style="width: 50px; height: 50px; margin-right: -10px;">
    <span style="font-size: 20px;"><a href="main.php" style="color: white; text-decoration: none; margin-right: 280px; font-family: Segoe Print;">Monumen Kapal Selam</a></span>
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
                <li><a href="profile-admin.php" onclick="showProfile()">Profile Saya</a></li>
                <li><a href="profile-admin.php#account-change-password" onclick="showChangePassword()">Ubah Password</a></li>
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
        <h1 style="text-shadow: -1px -1px 0 black,  
        1px -1px 0 black,
       -1px  1px 0 black,
        1px  1px 0 black;">Gallery</h1>
        <hr style="width: 100%; margin: 10px auto; border: 3px solid white;">
    </div>
</div>

<div class="Gallery">
    <h1 style="text-align: center; padding-top: 20px;">Gallery Kami</h1>
    <hr style="width: 50%; margin: 10px auto; border: 3px solid #2697FF;">
    <h2 style="text-decoration: underline;">Gallery Pengunjung</h2>
        <div class="gallery-pengunjung">
            <div class="gallery-images">
                <img src="../Gambar/Picture19.png">
                <p>Live Musik TK</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture20.png">
                <p>Pengunjung</p>
            </div>
        </div>
        
        <h2 style="text-decoration: underline;" >Gallery Kapal Selam</h2>
        <div class="gallery-kapal">
            <div class="gallery-images">
                <img src="../Gambar/Picture21.png">
                <p>Foto Awak Kapal Selam</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture22.png">
                <p>Meja Makan Kapal Selam</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture23.png">
                <p>Ruang IV</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture24.png">
                <p>Data KRI Pasopati-410</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture25.png">
                <p>Tugu Monumen Kapal Selam</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture26.png">
                <p>Ruang Torpedo Kapal</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture27.png">
                <p>Ruang Mesin Kapal</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture28.png">
                <p>Ruang Awak Kapal</p>
            </div>
        </div>
    
        
        <h2 style="text-decoration: underline;">Gallery Fasilitas Monumen</h2>
        <div class="gallery-monumen">
            <div class="gallery-images">
                <img src="../Gambar/Picture29.png">
                <p>Kantin</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture30.png">
                <p>Tempat Pembelian Tiket Kolam Renang</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture31.png">
                <p>Jadwal Pemutaran Vidiorama</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture32.png">
                <p>Tempat Bermain</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture33.png">
                <p>Vidio Rama</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture34.png">
                <p>Kolam Renang</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture35.png">
                <p>Penayangan Vidio Rama</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture36.png">
                <p>Perahu Kano</p>
            </div>
            <div class="gallery-images">
                <img src="../Gambar/Picture37.png">
                <p>Tempat Bersantai Sungai Kalimas</p>
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
