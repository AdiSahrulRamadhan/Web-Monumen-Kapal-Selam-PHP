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
            height: 89vh; 
            background-image: url('Gambar/Picture1.png'); 
            background-size: cover;
            background-position: center;
            color: white;
            text-align: left;
            display: flex;
            flex-direction: column;
            box-sizing: border-box; 
        }

        .content-box {
            background-color: rgba(0, 0, 0, 0.4); 
            padding: 30px;
            border-radius: 10px; 
            max-width: 980px; 
            margin: 70px 100px; 
            text-align: justify;
        }

        .content h3, p {
            font-size: 20px;
        }
        .content h1 {
            font-size: 35px;
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

        .kunjungan-gambar {
            flex: 1;
            margin-left: 10px;
            margin-right: 50px;
            padding: 70px;
            max-width: 50%; 
            text-align: center; 
        }
        
        .kunjungan-gambar img {
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
            left: -40px;
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
        <img src="Gambar/Picture2.png" alt="Logo Monumen Kapal Selam" style="width: 60px; height: 60px; margin-left: 50px; margin-right: -370px;">
        <span style="font-size: 25px;"><a href="log-main.php" style="color: white; text-decoration: none; font-family: Segoe Print;">Monumen Kapal Selam</a></span>
        <ul>
            <li><a href="log-main.php">Beranda</a></li>
            <li><a href="log-fasilitas.php">Fasilitas</a></li>
            <li><a href="log-gallery.php">Gallery</a></li>
            <li><a href="log-sejarah.php">Sejarah</a></li>
            <li><a href="log-kontak.php">Kontak</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a href="log-login.php" data-toggle="tab">Login</a></li>
                    <li><a href="log-sign-up.php" data-toggle="tab">Daftar</a></li>
                </ul>
            </li>
        </ul>
    </nav>

<div class="content"> 
    <div class="content-box">
        <h3 style="color: #FDC2C2; font-family: Patua One; font-size: 20px;">Selamat Datang di !</h3>
        <h1 style="color: white; font-family: Patua One; font-size: 50px;">Monumen Kapal Selam</h1>
        <p style="color: white; font-family: Patua One; font-size: 20px;">
            Monumen Kapal Selam, atau disingkat Monkasel, adalah sebuah museum kapal selam. 
            Indonesia dikenal dengan negara maritim yang begitu luas. 
            Monumen Kapal Selam (Monkasel) Surabaya, yaitu sebuah kapal yang berada di darat yang difungsikan sebagai bangunan museum sekaligus wisata. 
            Monumen ini sebenarnya peninggalan yang masih ada dan dinikmati sampai sekarang yakni kapal selam KRI Pasopati 410, salah satu armada Angkatan Laut Republik Indonesia buatan Uni Soviet tahun 1952. 
            Kapal selam ini pernah dilibatkan dalam Pertempuran Laut Aru untuk membebaskan Irian Barat dari pendudukan Belanda.
        </p>
        <button style="font-size: 20px;" class="btn"onclick="window.location.href='log-sejarah.php';">Lihat Lebih Lengkapnya</button>
    </div>
    <div style="text-align: right; border-radius: 10px; font-size: 10px; ">
        <button style="font-size: 20;" class="btn" onclick="window.location.href='log-kontak.php';"><img src="Gambar/Picture4.png" alt="Kontak" style="width: 30px; height: 30px; margin-right: 15px;">Hubungi Kami</button>
    </div>
</div>

<div class="monumen">
    <h1 style="margin-top: 20px; font-family: PoetsenOne; font-style: italic;"><b>Selamat Datang di Monumen</b></h1>
    <p style="font-size: 20px; font-family: Patua One;">
        Selamat datang di website resmi Monumen Kapal Selam Surabaya! Kami mengundang Anda untuk menjelajahi dan mengenal lebih jauh tentang monumen ini yang merupakan salah satu ikon sejarah Kota Surabaya. Monumen Kapal Selam Surabaya 
        adalah simbol kegigihan dan ketangguhan, mewakili sejarah maritim yang kaya dan penting bagi kota ini. Dengan menggabungkan warisan sejarah dan keindahan arsitektur, monumen ini menjadi titik penting dalam menceritakan kisah perjalanan Surabaya. 
    </p>
    <p style="font-size: 20px; font-family: Patua One;">
        “Nikmati penjelajahan Anda melalui informasi sejarah yang menarik dan penuh inspirasi tentang Monumen Kapal Selam Surabaya di website kami.”
    </p>
    <button class="btn"onclick="window.location.href='log-sejarah.php';">Sejarah Monumen</button>
</div>

<div class="event">
    <img src="Gambar/Picture3.png" alt="Gambar Event" style="max-width: 500px; max-height: 300px; margin-right: 40px;">
    <div class="event-text">
        <h1>Event Tahunan Hari Kemerdekaan 17 Agustus 1945</h1>
        <h2>Lomba Mewarnai  Tingkat Tk  - SD</h2>
        <p>
            Ikut sertakan putra dan putri anda untuk memeriahkan hari kemerdekaan 
            Indonesia yang tentunya terdapat perebutan Juara 1 - Juara 3 tentunya terdapat
            sertifikat, piala dan tentunya hadiah utamanya. Segera daftar 1 - 15 Agustus.
        </p>
        <p>
            Daftarkan Putra-Putri anda karena kouta terbatas, hubungi nomer dibawah ini.
        </p>
        <p style="color: #57F7AA">
            Contact Person : 081-233-658-802
        </p>
    </div>
</div>

<div class="fasilitas">
    <button style="background-color: transparent; border: none; font-size: inherit; font-size: 40px; cursor: pointer; font-family: PoetsenOne; font-style: italic;" onclick="window.location.href='log-fasilitas.php';"><b>Fasilitas Terdekat</b></button>
    <hr style="width: 50%; margin: 10px auto; border: 3px solid #2697FF;">
    <p>Kenapa Lokasi Sangat Strategis karena bisa dilihat dari fasilitas sekitar yang tersedia dari Monumen Kapal Selam
        tepat dipusat kota atau dekat dengan pusat keramaian Kota Surabaya terdapat Mall, Restaurant, Cafe, 
        Masjid dan masih banyak lagi untuk melihat fasilitas tersebut klik Gambar dibawah ini atau Tulisan tersebut.
    </p>
    <div style="display: flex; justify-content: center;">
        <a href="log-masjid.php">
            <img src="Gambar/Picture7.png" alt="Masjid" style="width: 200px; margin-right: 20px;">
            <figcaption style="text-align: center;">Masjid</figcaption>
        </a>
        <a href="log-cafe.php">
            <img src="Gambar/Picture8.png" alt="Cafe" style="width: 200px; margin-right: 20px;">
            <figcaption style="text-align: center;">Cafe</figcaption>
        </a>
        <a href="log-restoran.php">
            <img src="Gambar/Picture9.png" alt="Restaurant" style="width: 200px; margin-right: 20px;">
            <figcaption style="text-align: center;">Restaurant</figcaption>
        </a>
        <a href="log-mall.php">
            <img src="Gambar/Picture6.png" alt="Mall" style="width: 230px; height: 190px;">
            <figcaption style="text-align: center;">Mall</figcaption>
        </a>
    </div>
</div>

<img src="Gambar/Picture10.png" alt="fasilitas" style="width: 100%;">

<div class="informasi">
    <div class="judul">
        <h1>Informasi Penting</h1>
    </div>
    <div class="informasi-kolom">
        <h2><img src="Gambar/Picture11.png" alt="Tiket dan Harga" style="height: 35px; width: 35px; margin-right: 8px;"> Tiket dan Harga</h2>
        <p>Tiket masuk : Rp. 15.000,00. </p>
        <p>Sudah Termasuk Parkir</p>
    </div>
    <div class="informasi-kolom">
        <h2><img src="Gambar/Picture12.png" alt="Jadwal Setiap Hari" style="height: 35px; width: 35px; margin-right: 8px;"> Jadwal Setiap Hari</h2>
        <p>SENIN - JUMAT: 09:00 - 17:00 WIB</p>
        <p>SABTU - MINGGU: 09:00 - 19:00 WIB</p>
    </div>
    <div class="informasi-kolom">
        <h2><img src="Gambar/Picture13.png" alt="Lokasi Monumen" style="height: 35px; width: 35px; margin-right: 8px;"> Lokasi Monumen</h2>
        <p>Jl. Pemuda No.39, Embong Kaliasin, Kec. Genteng, Surabaya, Jawa Timur 60271</p>
        <ul>
            <li><a href="log-kontak.php">Lebih Lengkap</a></li>
        </ul>
    </div>
</div>

<div class="kunjungan">
    <div class="kunjungan-monumen">
        <h1 style="font-size: 40px; font-family: Patoa Print; font-style: italic;">Berkunjunglah Ke Monumen</h1>
        <p>Anda akan mendapatkan pengalaman & pengetahuan baru tentang bagaimana bagian-bagian dalam dari kapal selam. Mulai dari Haluan kapal sampai buritan kapal, tentunya anda akan mengetahui sejarahnya lebih dalam.</p>
        <button class="btn"onclick="window.location.href='log-sejarah.php';" style="background-color: gray;">Lihat Lebih Lengkapnya</button>
    </div>
    <div class="kunjungan-gambar">
        <img src="Gambar/Picture14.png" alt="">
    </div>
</div>

<div id="lokasi">
    <h1 style="text-align: center; font-style: italic; margin-bottom: 30px;">Lokasi Google Maps</h1>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.782770860351!2d112.74770537476043!3d-7.265544692741319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9628df520e5%3A0x577443720136fb0b!2sMonumen%20Kapal%20Selam%20Surabaya!5e0!3m2!1sid!2sid!4v1715253994728!5m2!1sid!2sid" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
