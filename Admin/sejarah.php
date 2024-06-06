<?php
include '../cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: sejarah.php");
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
            margin-bottom: 15px;
            text-align: justify;
            color: white; 
            margin-bottom: 340px;
        }


        .content h1 {
            font-size: 40px;
            font-family: Patua One;
            font-style: italic;
        }

        .monumen {
            text-align: center;
            max-width: 80%;
            margin: 0 auto; 
        }

        .monumen h3 {
            margin-top: 30px;
            color: #2697FF;
            text-decoration: underline ;
            font-style: italic;
        }

        .monumen h1 {
            font-style: italic;
        }

        .../gambar-monumen {
            display: block;
            margin: 0 auto; 
            max-width: 100%; 
            height: auto; 
            border-radius: 10px;
        }

        .sejarah {
            background-color: white; 
            padding: 20px; 
        }

        .sejarah-text {
            width: 90%; 
            background-color: #0A4773E5; 
            color: white; 
            padding: 20px; 
            box-sizing: border-box; 
            margin: 20px auto; 
            max-height: 80vh; 
            overflow-y: auto; 
            text-align: justify;
            border-radius: 10px;
        }

        .sejarah h1 {
            color: #F17676;
            border: 1px white;
        }

        .spesifikasi {
            text-align: center; 
        }

        .center-text {
            margin-bottom: 20px; 
        }

        .center-text h3, h1 {
            margin: 20px; 
        }

        .blue-line {
            border: none; 
            border-bottom: 3px solid #2697FF; 
            width: 40%; 
            margin: auto; 
        }

        .spesifikasi-kri {
            display: flex; 
            justify-content: center; 
        }

        .container {
            display: flex;
            flex-direction: column;
        }

        .row {
            display: flex;
            margin-top: 30px;
        }

        .column {
            font-size: 22px;
            flex: 1;
            margin: 20px; 
            text-align: justify;
        }

        .spesifikasi-kri img {
            border-radius: 15px;
            max-width: 100%; 
            margin: 50px; 
        }

        .ruangan {
            max-width: 90%;
            margin: 20px 30px;
            padding: 30px;
            font-size: 22px;
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
        1px  1px 0 black;">Sejarah Monumen Kapal Selam</h1>
        <hr style="width: 100%; margin: 10px auto; border: 3px solid white;">
    </div>
</div>

<div class="monumen">
    <h3>SEJARAH KRI PASOPATI 410</h3>
    <h1>Pendirian Monumen Kapal Selam</h1>
    <p>
        Pendirian Monumen Kapal Selam Surabaya adalah bentuk penghargaan atas jasa-jasa heroik KRI Pasopati dan awaknya yang berani dalam melawan penjajah. Monumen ini bertujuan untuk mengenang perjuangan mereka dan mengabadikan sejarah perang kemerdekaan Indonesia. Dibuka untuk umum pada tahun 1998, monumen ini 
        sejak itu telah menjadi destinasi wisata edukatif yang menarik, yang memberikan wawasan tentang peran penting kapal selam dalam perang laut dan sejarah kemerdekaan Indonesia.
    </p>
    <img src="../Gambar/Picture16.png" class="../gambar-monumen">
</div>

<div class="sejarah">
    <div class="sejarah-text">
        <h1>Sejarah KRI Pasopati 410</h1>
        <p>
            Monumen Kapal Selam Surabaya adalah sebuah situs bersejarah yang menampilkan kapal selam yang 
            sebenarnya, yaitu KRI Pasopati 410. Kapal selam ini merupakan bagian dari Armada Divisi Timur TNI Angkatan
            Laut dan termasuk dalam jenis SS Whiskey Class yang dibuat di Vladivostok, Rusia pada tahun 1952. Sebelum
            pembangunan Monkasel, terdapat cerita menarik mengenai Kapten Kapal KRI Pasopati ini. Dikatakan bahwa
            pada suatu malam, Drajat Budiyanto, mantan KKM KRI Pasopati 410, bermimpi diperintahkan oleh KSAL 
            (Kepala Staf Angkatan Laut) untuk membawa kapal selam ini melalui Kali Mas. Mimpi tersebut kemudian 
            menjadi kenyataan.
        </p>
        <p>
            Drajat Budiyanto kemudian ditugaskan untuk memajang kapal selam tersebut di Surabaya Plaza. Untuk 
            melakukannya, KRI Pasopati 410 dibelah menjadi 16 bagian, kemudian disatukan kembali di PT PAL Indonesia,
            dan akhirnya dibawa ke lokasi Monumen Kapal Selam untuk dirakit ulang menjadi wujud utuh KRI Pasopati.
        </p>
        <p>
            KRI Pasopati 410 telah aktif beroperasi sejak tahun 1962, dengan tugas utama seperti menghancurkan garis 
            musuh (Anti-shipping), melakukan pengintaian, dan menjalankan serangan secara diam-diam (Silent Raid).
        </p>
        <p>
            Pada tanggal 26 Januari 1990, kapal ini dinonaktifkan oleh TNI Angkatan Laut dan diubah menjadi Monumen 
            Kapal Selam untuk mengenang perjuangan Operasi Trikora, operasi militer yang dilancarkan Indonesia untuk 
            melawan pendudukan Belanda di Irian Barat (Papua). Pembangunan Monkasel dimulai pada tanggal 1 Juli 1995 
            dengan peletakan batu pertama oleh Gubernur Jawa Timur, Basofi Sudirman, dan Panglima Komando Armada 
            RI Kawasan Timur, Laksamana Muda (Laksda) TNI Gofar Soewarno.
        </p>
        <p>
            Tiga tahun kemudian, Monumen ini diresmikan oleh Kepala Staf TNI Angkatan Laut (KSAL), Laksamana TNI Arief
            Kushariadi, pada tanggal 27 Juni 1998, dan dibuka untuk publik pada tanggal 15 Juli 1998. Monkasel saat ini 
            menjadi monumen kapal selam terbesar di Asia. Pengelolaan Monkasel berada di bawah tanggung jawab TNI 
            Angkatan Laut dan dikelola oleh Pusat Koperasi Angkatan Laut.
        </p>
    </div>
</div>

<div class="spesifikasi">
    <div class="center-text">
        <h3>KRI PASOPATI 410</h3>
        <hr class="blue-line">
        <h1>Spesifikasi KRI Pasopati 410</h1>
    </div>
    <div class="spesifikasi-kri">
        <img src="../Gambar/Picture17.png" alt="">
        <div class="container">
            <div class="row">
                <div class="column">
                    <strong>Ukuran:</strong> 
                    <ul>
                        <li>Panjang : 76,6 m</li>
                        <li>Lebar : 6,30 m</li>
                    </ul>
                </div>
                <div class="column">
                    <strong>Kecepatan:</strong> 
                    <ul>
                        <li>18,3 knot di atas permukaan</li>
                        <li>13,6 knot di bawah permukaan</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <strong>Berat:</strong> 
                    <ul>
                        <li>Berat penuh : 1,300 tons</li>
                        <li>Berat kosong : 1,050 tons</li>
                    </ul>
                </div>
                <div class="column">
                    <strong>Kemampuan Penemuan :</strong> 
                    <ul>
                        <li>8,500 mil laut</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <strong>Bahan Bakar :</strong> 
                    <ul>
                        <li>Baterai : 224 unit</li>
                        <li>Bahan Bakar : Diesel</li>
                    </ul>
                </div>
                <div class="column">
                    <strong>Lain-lain :</strong> 
                    <ul>
                        <li>Persenjataan : 12 torpedo uap gas</li>
                        <li>Panjang : 7 m</li>
                        <li>Baling-baling : 6 lubang</li>
                        <li>Awak kapal :63 termasuk Komandan</li>
                    </ul>
                </div>
            </div>
        </div>
        
        </div>
        
        </div>
    </div>
    
    <div class="ruangan">
        <strong>KRI Pasopati memiliki jumlah 7 ruangan :</strong> 
        <ul>
            <li>Ruang untuk haluan torpedo, dipersenjatai dengan 4 torpedo propeller, juga bertindak sebagai penyimpanan untuk torpedo</li>
            <li>Ruang komandan</li>
            <li>Ruang makan</li>
            <li>Ruang kerja. Di bawah dek adalah ruang untuk baterai I</li>
            <li>Jembatan utama</li>
            <li>Pusat komando</li>
            <li>Ruangan penyimpanan makanan di bawah dek</li>
            <li>Ruangan awak kapal</li>
            <li>Ruangan dapur</li>
            <li>Ruangan penyimpanan untuk baterai II di bawah dek</li>
            <li>Ruangan mesin diesel dan terminal mesin</li>
            <li>Kamar mesin listrik</li>
            <li>Ruangan torpedo untuk bagian buritan. Berisi dengan 2 buah torpedo</li>
        </ul>
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
