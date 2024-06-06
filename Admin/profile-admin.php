<?php
include '../cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: profile-admin.php");
    exit;
}
$id = $_SESSION['UserID'];

// Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "testing");

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $updateQuery = "UPDATE users SET Username='$username', namaLengkap='$name', Email='$email' WHERE UserID=$id";
    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['message'] = "Profil berhasil diperbarui!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Terjadi kesalahan saat memperbarui profil: " . mysqli_error($conn);
        $_SESSION['message_type'] = "error";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Mengambil data user dari database
$userQuery = "SELECT * FROM users WHERE UserID = $id";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);


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
            background-color: #f1f1f1; 
        }

        .dropdown-menu li a {
            font-size: 15px;
        }
        
        .btn {
            background-color: #0A4773E5;
            color: white;
            border-radius: 10px;
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

        .content {
            margin-left: 0;
            padding: 20px;
            padding-top: 20px; 
            transition: margin-left 0.3s;
        }

        .content.shift {
            margin-left: 240px;
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
        
        .btn {
            background-color: #0A4773E5;
            color: white;
            border-radius: 10px;
        }

        .hidden {
            display: none;
        }
        
        footer {
            background-color: #2D2C2C;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            margin-left: 0;
            transition: margin-left 0.3s;
        }

        footer.shift {
            margin-left: 240px; 
        }

        .footer-left, .footer-right {
            color: white;
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
<body>
    <div class="content" id="content">
    <div class="container py-4">
        <div class="card" style="height: 70vh; border-radius: 15px; background-color: rgba(0, 0, 0, 0.4)">
            <div class="row no-gutters row-bordered">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general" style="border-radius: 15px; background-color: transparent;">Profile</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password" style="border-radius: 15px; background-color: transparent;">Change password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                    <div class="tab-pane fade show active" id="account-general">
                        <hr class="border-light m-0">
                        <div class="card-body">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label class="form-label" style="border-radius: 15px; background-color: transparent;">Username</label>
                                    <input type="text" name="username" class="form-control mb-1" value="<?php echo htmlspecialchars($user['Username']); ?>" style="border-radius: 15px; background-color: transparent;">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="border-radius: 15px; background-color: transparent;">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['namaLengkap']); ?>" style="border-radius: 15px; background-color: transparent;">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" style="border-radius: 15px; background-color: transparent;">E-mail</label>
                                    <input type="text" name="email" class="form-control mb-1" value="<?php echo htmlspecialchars($user['Email']); ?>" style="border-radius: 15px; background-color: transparent;">
                                </div>
                                <div class="text-right mt-5">
                                    <button type="submit" class="btn">Save changes</button>&nbsp;
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                        <div class="tab-pane fade" id="account-change-password">
                        <hr class="border-light m-0">
                        <div class="card-body pb-2">
                            <form method="POST" action="ubah-password.php">
                                <div class="form-group">
                                    <label class="form-label">Current password</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New password</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Repeat new password</label>
                                    <input type="password" name="repeat_new_password" class="form-control" required>
                                </div>
                                <div class="text-right mt-5">
                                    <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <footer id="footer">
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
    <?php if (isset($_SESSION['message'])): ?>
        var messageType = '<?php echo $_SESSION['message_type']; ?>';
        var message = '<?php echo $_SESSION['message']; ?>';
        if (messageType == 'success') {
            alert(message);
        } else if (messageType == 'error') {
            alert(message);
        }
        <?php
        // Clear the session message after displaying it
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
    <?php endif; ?>
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
  $('#tiket-info').removeClass('show active');
  $('#ticket-tab').tab('show');
  $('#tiket-infoo').addClass('show active').removeClass('hidden');
}
function goBack() {
  $('#tiket-infoo').removeClass('show active');
  $('#account-tab').tab('show');
  $('#tiket-info').addClass('show active').removeClass('hidden');
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

    // Konfigurasi grafik
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