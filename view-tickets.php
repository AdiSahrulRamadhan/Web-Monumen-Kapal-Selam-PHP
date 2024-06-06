<?php
include 'cek-login.php';

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "testing");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$id = $_SESSION['UserID'];

$sql = "SELECT * FROM tiket WHERE UserID = $id ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["payment-proof"])) {
    // Proses unggah bukti pembayaran
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["payment-proof"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["payment-proof"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        die("File bukan gambar.");
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        die("Maaf, file sudah ada.");
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["payment-proof"]["size"] > 500000) {
        die("Maaf, file Anda terlalu besar.");
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        die("Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.");
        $uploadOk = 0;
    }

    // If everything is ok, try to upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["payment-proof"]["tmp_name"], $target_file)) {
            // Update record in the database with payment proof file name
            $bukti_pembayaran = htmlspecialchars(basename($_FILES["payment-proof"]["name"]));
            $sql_update = "UPDATE tiket SET bukti_pembayaran = '$bukti_pembayaran' WHERE UserID = $id AND status_tiket = 'Belum Terkonfirmasi' ORDER BY id DESC LIMIT 1";
            if (mysqli_query($conn, $sql_update)) {
                echo "<script>alert('Pembelian Tiket Berhasil No Tiket Anda $id.'); window.location.href='beli-tiket.php';</script>";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            die("Maaf, terjadi kesalahan saat mengunggah file Anda.");
        }
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
            min-height: calc(100vh - 120px);
            background-image: url('Gambar/Picture15.png'); 
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content-box {
            text-align: justify;
            color: black; 
            background-color: white;
            width: 80%;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: solid;
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

        .container h2 {
            margin-bottom: 15px;
            text-align: center;
            color: black;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
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
            font-size: 18px;
        }

        .form-control {
            border-radius: 5px;
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
                <a href="#" class="dropdown-toggle">Tiket</a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a href="tiket.php">Informasi Tiket</a></li>
                    <li><a href="beli-tiket.php">Beli Tiket</a></li>
                    <li><a href="profile.php#account-info" data-toggle="tab">Tiket Saya</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i></a>
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
            <div class="container">
                <h2>Tiket Saya</h2>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama Pembeli</th>
                                <th>No. Telp</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Tiket</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['nama_pembeli']); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                                    <td><?php echo htmlspecialchars($row['jumlah_tiket']); ?></td>
                                    <td><?php echo htmlspecialchars($row['total_harga']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tgl_pembayaran']); ?></td>
                                    <td><?php echo htmlspecialchars($row['metode_pembayaran']); ?></td>
                                    <td><?php echo htmlspecialchars($row['status_tiket']); ?></td>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Anda belum memiliki tiket.</p>
                <?php endif; ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="payment-proof" class="label">Unggah Bukti Pembayaran</label>
                        <input type="file" name="payment-proof" id="payment-proof" class="form-control-file" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn">Unggah Bukti Pembayaran</button>
                    </div>
                </form>
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
