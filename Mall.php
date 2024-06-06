<?php include 'cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: Mall.php");
    exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Mall Terdekat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        body {
            overflow-x: hidden;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 25px;
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
            margin-right: 25px;
        }

        nav ul li a:hover {
            text-decoration: none;
            color: #07253b;
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

        .kontak {
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 30px 200px;
            background-color: #ebf6fe;
        }

        .kontak-detail {
            flex-grow: 1;
            text-align: justify;
        }

        .kontak-detail  {
            padding-bottom: 20px;
        }

        .kontak-detail strong {
            display: inline-block;
            width: 100px;
        }

        .kontak-detail p {
            margin: 0;
            padding-bottom: 30px;
            width: 400px;
        }

        .maps {
            width: 100%;
        }

        .containerr {
            display: flex;
            justify-content: space-between;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container,
        .review-container {
            width: 45%;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .form-container {
            box-sizing: border-box;
        }

        .review-container {
            overflow-y: auto;
            max-height: 400px;
        }

        h2 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .review {
            margin-bottom: 15px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: left;
        }

        .rating input {
            display: none;
        }

        .rating label {
            display: inline-block;
            cursor: pointer;
        }

        .rating label:before {
            content: "\2605";
            font-size: 30px;
        }

        .rating input:checked ~ label:before {
            color: orange;
        }

        .dropdown-menu {
            position: absolute;
            width: 70px;
            list-style: none;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.15);
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
            background-color: #f1f1f1; /* Warna latar belakang saat opsi dropdown dihover */
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
        <img src="Gambar/Picture2.png" alt="Logo Monumen Kapal Selam" style="width: 60px; height: 60px; margin-left: 50px; margin-right: -300px;">
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
                <a href="profile.php" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a href="profile.php" data-toggle="tab">Profile Saya</a></li>
                    <li><a href="profile.php#account-change-password" data-toggle="tab">Ubah Password</a></li>
                    <li><a href="profile.php#account-info" data-toggle="tab">Tiket Saya</a></li>
                    <li><a href="log-login.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

<h1 style="text-align: center; padding-top: 20px;">Plaza Surabaya</h1>
<hr style="width: 50%; margin: 10px auto; border: 3px solid #2697FF;">
<div class="kontak">
    <div class="maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1978.8920559675796!2d112.74687570348583!3d-7.265392411627517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f94ba046cff7%3A0x1093a971829ea06d!2sPlaza%20Surabaya!5e0!3m2!1sid!2sid!4v1716726958002!5m2!1sid!2sid" width="1000" height="430" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
</body>
</html>
<footer>
    <div class="footer-left">
        Copyright © 2024 Monumen Kapal Selam Surabaya
    </div>
    <div class="footer-right">
        Powered by Monumen Kapal Selam Surabaya
    </div>
</footer>
