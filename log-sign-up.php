<?php
$conn = mysqli_connect("localhost", "root", "", "testing");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Format Email Salah, Ex : Example.gmail.com."); window.location.href = "log-sign-up.php";</script>';
        exit();
    }

    // Validate username length
    if (strlen($username) < 10) {
        echo '<script>alert("Username minimal harus 10 karakter."); window.location.href = "log-sign-up.php";</script>';
        exit();
    }

    // Validate password strength
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        echo '<script>alert("Password harus terdiri dari minimal 8 karakter dan berisi minimal 1 huruf besar & angka."); window.location.href = "log-sign-up.php";</script>';
        exit();
    }

    // Check if username or email already exists
    $check_query = "SELECT * FROM `users` WHERE `Username` = ? OR `Email` = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<script>alert("Username & email sudah terpakai."); window.location.href = "log-sign-up.php";</script>';
        exit();
    }

    // Hash the password with bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $userID = mt_rand(1000, 9999);
    $query = "INSERT INTO `users`(`UserID`, `Username`, `Password`, `Email`, `lvl`, `namaLengkap`) VALUES (?, ?, ?, ?, '2', 'Pengguna Baru')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $userID, $username, $hashed_password, $email);
    $hasil = $stmt->execute();

    if ($hasil) {
        echo '<script>alert("Akun anda berhasil terdaftar."); window.location.href = "log-sign-up.php";</script>';
    } else {
        echo '<script>alert("Gagal Mendaftar: ' . mysqli_error($conn) . '"); window.location.href = "log-sign-up.php";</script>';
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
            max-width: 400px;
            margin: 25px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .content-box p {
            position: relative;
            text-align: right;
            top: -35px;
            left: -10px;
        }

        label {
            font-weight: bold;
            font-size: 22px;
        }

        input[type="text"],
        input[type="password"] {
            background-color: transparent;
            width: 95%;
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 1px solid #2697FF;
            border-top: none;
            border-left: none;
            border-right: none;
            color: white;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .password-toggle {
            position: relative;
        }

        .toggle-icon {
            position: absolute;
            margin-top: -78px;
            right: 20px;
            top: 45%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .toggle-icon::before {
            content: '\f06e';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 20px;
            color: whitesmoke;
        }

        .password-visible .toggle-icon::before {
            content: '\f070';
        }

        #passwordInput[type="password"] {
            font-family: 'Arial', sans-serif;
        }

        .container-btn {
            text-align: left;
        }

        .btnn {
            padding: 10px 20px;
            background-color: #0A4773E5;
            color: white;
            text-decoration: none;
            border: 1px black;
            border-radius: 10px;
            cursor: pointer;
            display: inline-block;
            font-size: 15px;
            width: 180px;
            margin-top:10px;
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
            margin-top: -75px;
            margin-left: -235px;
            position: absolute;
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
        .error-message {
            color: red;
            font-size: 12px;
            display: none; /* Initially hide error messages */
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
        <h1 style="margin-bottom: 0;">Buat Akun</h1>
        <hr style="width: 100%; margin-bottom: 20px; border: 3px solid #2697FF;">
        <form id="sign-up-form" action="log-sign-up.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <small id="username-error" class="error-message"></small>
            
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required>
            <small id="email-error" class="error-message"></small>
            
            <label for="password">Password</label>
            <input type="password" id="passwordInput" name="password" required>
            <small id="password-error" class="error-message"></small>
            
            <div class="password-toggle">
                <span class="toggle-icon" onclick="togglePasswordVisibility()"></span>
            </div>
            
            <div class="container-btn">
                <button class="btnn" type="submit" name="submit">Daftar</button>
            </div>
        </form>
        <p><a style="color: green;" href="log-login.php">Sudah Punya Akun ?</a></p>
    </div>
</div>
<div style="text-align: right; border-radius: 10px; font-size: 10px;">
    <button style="font-size: 20;" class="btn" onclick="window.location.href='log-kontak.php';"><img src="Gambar/Picture4.png" alt="Kontak" style="width: 30px; height: 30px; margin-right: 15px;">Hubungi Kami</button>
</div>


<footer>
    <div class="footer-left">
        Copyright © 2024 Monumen Kapal Selam Surabaya
    </div>
    <div class="footer-right">
        Powered by Monumen Kapal Selam Surabaya
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.querySelector('#sign-up-form');
    
    form.addEventListener('submit', (e) => {
        const username = document.querySelector('#username').value.trim();
        const email = document.querySelector('#email').value.trim();
        const password = document.querySelector('#passwordInput').value.trim();
        
        let valid = true;
        
        // Validate username
        if (username === '') {
            displayError('username-error', 'Harap Isi Username');
            valid = false;
        } else if (username.length < 10) {
            displayError('username-error', 'Username minimal harus 10 karakter.');
            valid = false;
        } else {
            hideError('username-error');
        }
        
        // Validate email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            displayError('email-error', 'Format Email Salah, Ex : Example.gmail.com');
            valid = false;
        } else {
            hideError('email-error');
        }
        
        // Validate password
        if (password.length < 8 || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
            displayError('password-error', 'Password harus terdiri dari minimal 8 karakter dan berisi minimal 1 huruf besar & angka.');
            valid = false;
        } else {
            hideError('password-error');
        }
        
        if (!valid) {
            e.preventDefault(); // Prevent form submission if there are validation errors
        }
    });
});

function displayError(id, message) {
    const errorElement = document.getElementById(id);
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

function hideError(id) {
    const errorElement = document.getElementById(id);
    errorElement.textContent = '';
    errorElement.style.display = 'none';
}

function togglePasswordVisibility() {
    var passwordInput = document.getElementById("passwordInput");
    var toggleIcon = document.querySelector(".toggle-icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.parentNode.classList.add("password-visible");
    } else {
        passwordInput.type = "password";
        toggleIcon.parentNode.classList.remove("password-visible");
    }
}
</script>

</body>
</html>
