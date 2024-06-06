<?php
include '../cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: fasilitas.php");
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
            background-image: url('../Gambar/Picture15.png'); 
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

        .fasilitas {
            text-align: center;
            max-width: 80%;
            margin: 0 auto; 
        }

        .fasilitas h3 {
            margin-top: 30px;
            color: #2697FF;
            text-decoration: underline ;
            font-style: italic;
        }
        .fasilitas h2 {
            font-style: italic;
        }

        .fasilitas-text {
            text-align: center;
            font-family: Patoa Print;
            font-size: 18px;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .column {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .column-content {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .column-content i {
            font-size: 30px;
            margin-right: 10px;
            margin-top: -15px;
            color: rgb(74, 137, 255);
        }

        .container-fasilitas {
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        
        .row {
            display: flex;
            width: 90%;
            align-items: center; /* Menyusun konten di tengah secara vertikal */
        }
        
        .column-fasilitas, .column-fasilitas-text {
            margin-top: 30px;
            margin-bottom: 30px;
            height: 350px;
            width: 400px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .column-fasilitas-text {
            height: 300px;
            background-color: #0A4773;
            border-radius: 15px;
            color: white;
            border:3px solid black;
        }
        
        .column-fasilitas-text h3,p {
            margin-left:40px;
            margin-right:30px;
        }
        
        .column-fasilitas img {
            border:3px solid black;
            width: 100%;
            height: 100%;
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
        1px  1px 0 black;">Fasilitas Monumen Kapal Selam</h1>
        <hr style="width: 100%; margin: 10px auto; border: 3px solid white;">
    </div>
</div>

<div class="fasilitas">
    <h3>Fasilitas Monumen</h3>
    <h2 style="margin: 20px;">Monumen Sejarah Perjuangan</h2>
    <div class="fasilitas-text">
        <p>
            Monumen Kapal Selam Surabaya menawarkan berbagai fasilitas yang menarik bagi pengunjung yang ingin 
            menjelajahi sejarah kapal selam dan perang kemerdekaan Indonesia. Salah satu daya tarik utama adalah eksplorasi
            di dalam kapal selam KRI Pasopati yang telah diubah menjadi museum. Di dalamnya, pengunjung dapat melihat 
            langsung kondisi di dalam kapal selam, mengenal peralatan yang digunakan oleh awak kapal selam, serta memahami
            bagaimana kehidupan di dalam kapal selam itu sendiri.
        </p>
    </div>
</div>

<div class="container">
    <div class="column">
        <div class="column-content">
            <i class="fas fa-film"></i>
            <p>Video Rama</p>
        </div>
    </div>
    <div class="column">
        <div class="column-content">
            <i class="fas fa-music"></i>
            <p>Live Musik</p>
        </div>
    </div>
    <div class="column">
        <div class="column-content">
            <i class="fas fa-swimmer"></i>
            <p>Kolam Renang</p>
        </div>
    </div>
</div>

<div class="fasilitas-monumen">
    <h2 style="text-align: center; margin: 30px;">Fasilitas Monumen Kapal Selam</h2>
    <div class="container-fasilitas">
        <div class="row">
            <div class="column-fasilitas">
                <img src="../Gambar/Picture38.png" alt="Gambar 1">
            </div>
            <div class="column-fasilitas-text">
                <h3>1. Video Rama</h3>
                <p>Ruang Video Rama merupakan salah satu fasilitas edukasi dari monumen kapal selam untuk melihat sejarah dari kapal selam Pasopati 410.</p>
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas-text">
                <h3>2. Kolam Renang</h3>
                <p>Kolam Renang merupakan salah satu fasilitas
                    hiburan di monumen kapal selam yang terdiri 
                    dari 2 kolam untuk dewasa dan anak - anak 
                    yang dilengkapi dengan seluncuran dan kamar
                    mandi.</p>
            </div>
            <div class="column-fasilitas">
                <img src="../Gambar/Picture34.png" alt="Gambar 2" >
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas">
                <img src="../Gambar/Picture19.png" alt="Gambar 3" >
            </div>
            <div class="column-fasilitas-text">                
                <h3>3. Live Musik</h3>
                <p>Live Musik salah satu fasilitas hiburan monumen 
                    kapal selam dengan manampilkan pertunjukan 
                    musik yang dibawakan oleh band - band lokal
                    ataupun pengunjung yang ingin menyanyi di
                    pangung live musik.</p>
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas-text">                
                <h3>4. Tempat Duduk Pinggir Sungai</h3>
                <p>Tempat Duduk Santai juga termasuk fasilitas 
yang tersedia pada monumen kapal selam 
biasanya akan lebih indah kelap kelip lampu
sungai yang dilewati oleh kapal-kapal
dari kalimas.</p>
            </div>
            <div class="column-fasilitas">
                <img src="../Gambar/Picture37.png" alt="Gambar 4" >
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas">
                <img src="../Gambar/Picture39.png" alt="Gambar 5" >
            </div>
            <div class="column-fasilitas-text">
                <h3>5. Tempat Bermain</h3>
                <p>Tempat Bermain juga termasuk fasilitas yang 
ada pada monumen kapal selam, karena 
monumen kapal selam sering sekali dikunjungi
oleh para anak-anak tk-sd jadi fasilitas ini 
sangat membantu suapaya anak-anak senang.</p>
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas-text">
                <h3>6. Perahu Kano</h3>
                <p>Perahu Kano menjadi fasilitas monumen kapal 
selam anda bisa menyewanya dan didampingi 
oleh pendamping dari pegawai kano itu 
disediakan pelampung yang pastinya aman
dan nyaman.</p>
            </div>
            <div class="column-fasilitas">
                <img src="../Gambar/Picture36.png" alt="Gambar 6" >
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas">
                <img src="../Gambar/Picture29.png" alt="Gambar 7" >
            </div>
            <div class="column-fasilitas-text">
                <h3>7. Kantin</h3>
                <p>Kantin Juga termasuk fasilitas yang bisa anda
nikmati ketika anda mencari jajanan untuk 
anak-anak anda atau lapar bisa saja ke kantin
terjamin lengkap karena bekerja sama dengan 
UMKM.</p>
            </div>
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
