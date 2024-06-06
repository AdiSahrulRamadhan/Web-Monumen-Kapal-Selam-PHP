<?php 
include("config.php");

if(!isset($_GET["code"])) {
    exit("Can't find Page");
}

$code = $_GET["code"];

// Memastikan $code aman dari SQL Injection
$code = mysqli_real_escape_string($con, $code);

$getEmailQuery = mysqli_query($con, "SELECT Email FROM resetpassword WHERE code = '$code'");
if(!$getEmailQuery || mysqli_num_rows($getEmailQuery) == 0) {
    exit("Can't find page");
}

$message = ""; // Variable untuk menyimpan pesan yang akan ditampilkan dalam pop-up

if(isset($_POST["Password"])) {
    $password = $_POST["Password"];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $row = mysqli_fetch_array($getEmailQuery);
    $email = $row["Email"];

    // Menggunakan prepared statement untuk keamanan
    $stmt = $con->prepare("UPDATE users SET Password = ? WHERE Email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $success = $stmt->execute();

    if($success) {
        $stmt = $con->prepare("DELETE FROM resetpassword WHERE code = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        
        // Set pesan untuk pop-up
        $message = "Password Berhasil Diperbarui";
    }
    else {
        // Set pesan untuk pop-up
        $message = "Gagal Memperbarui Password";
    }
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
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .content-box p {
            position: absolute;
            right: 600px;
            top: 495px;
        }

        .content-box #lupapas {
            position: absolute;
            right: 627px;
            top: 520px;
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
            margin-top: 85px;
            margin-left: -235px;
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
        <h1 style="margin-bottom: 0;">Reset Password</h1>
        <hr style="width: 100%; margin-bottom: 20px; border: 3px solid #2697FF;">
        <form method="POST">
            <label for="Password">Password</label>
            <div class="password-toggle">
                <input type="password" name="Password" id="passwordInput" required>
                <span class="toggle-icon" onclick="togglePasswordVisibility()"></span>
            </div>
            <div class="container-btn">
                <button class="btnn" type="submit" name="submit">Update Password</button>
            </div>
        </form>
    </div>
    <div style="text-align: right; border-radius: 10px; font-size: 10px;">
        <button style="font-size: 20;" class="btn" onclick="window.location.href='log-kontak.php';"><img src="Gambar/Picture4.png" alt="Kontak" style="width: 30px; height: 30px; margin-right: 15px;">Hubungi Kami</button>
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

<script>
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
<script>
        <?php if($message): ?>
            alert("<?php echo $message; ?>");
            window.location.href = "log-login.php"; // Arahkan ke halaman login setelah menampilkan pesan pop-up
        <?php endif; ?>
    </script>
</body>
</html>
