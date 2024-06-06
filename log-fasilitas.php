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
                <img src="Gambar/Picture38.png" alt="Gambar 1">
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
                <img src="Gambar/Picture34.png" alt="Gambar 2" style="width: 100%;">
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas">
                <img src="Gambar/Picture19.png" alt="Gambar 3" style="width: 100%;">
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
                <img src="Gambar/Picture37.png" alt="Gambar 4" style="width: 100%;">
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas">
                <img src="Gambar/Picture39.png" alt="Gambar 5" style="width: 100%;">
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
                <img src="Gambar/Picture36.png" alt="Gambar 6" style="width: 100%;">
            </div>
        </div>
        <div class="row">
            <div class="column-fasilitas">
                <img src="Gambar/Picture29.png" alt="Gambar 7" style="width: 100%;">
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


</body>
</html>
