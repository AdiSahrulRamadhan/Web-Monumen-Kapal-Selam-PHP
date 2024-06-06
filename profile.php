<?php
include 'cek-login.php'; 

if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: profile.php");
    exit;
}

$id = $_SESSION['UserID'];

// Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "testing");

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data tiket dari database dan langsung memperbarui status tiket yang kadaluwarsa
$updateExpiredTicketsQuery = "UPDATE tiket SET status_tiket = 'Kadaluwarsa' WHERE UserID = $id AND status_tiket != 'Kadaluwarsa' AND tgl_pembayaran < DATE_SUB(NOW(), INTERVAL 1 DAY)";
mysqli_query($conn, $updateExpiredTicketsQuery);

// Mengambil data tiket dari database
$query = "SELECT * FROM tiket WHERE UserID = $id";
$result = mysqli_query($conn, $query);

// Menyimpan data tiket dalam array
$tickets = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tickets[] = $row;
    }
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
            margin-top: 45px;
        }

        .footer-left, .footer-right {
            color: white;
        }
        .card-custom {
            width: 115%; /* Increase the width as needed */
            margin: auto;
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
            <a href="#" class="dropdown-toggle">Tiket
            </a><ul class="dropdown-menu" aria-labelledby="profileDropdown">
                <li><a href="tiket.php">Informasi Tiket</a></li>
                <li><a href="beli-tiket.php">Beli Tiket</a></li>
                <li><a href="#account-info" data-toggle="tab">Tiket Saya</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                <li><a href="#account-general" data-toggle="tab">Profile Saya</a></li>
                <li><a href="#account-change-password" data-toggle="tab">Ubah Password</a></li>
                <li><a href="#account-info" data-toggle="tab">Tiket Saya</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div class="container py-4">
    <h4 class="font-weight-bold mb-4">Pengaturan Akun</h4>
    <div class="card card-custom" style="border-radius: 15px; background-color: rgba(0, 0, 0, 0.4)">
        <div class="row no-gutters row-bordered">
            <div class="col-md-2 pt-0">
                <div class="list-group list-group-flush account-settings-links">
                    <a class="list-group-item list-group-item-action active" data-toggle="list"
                        href="#account-general" style="border-radius: 15px; background-color: transparent;">Profile</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list"
                        href="#account-change-password" style="border-radius: 15px; background-color: transparent;">Change password</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list"
                        href="#account-info" style="border-radius: 15px; background-color: transparent;">Tiket Saya</a>
                </div>
            </div>
            <div class="col-md-10">
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
                    <div class="tab-pane fade show " id="account-info">
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <h5 class="font-weight-bold mb-3">Tiket Saya</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kode Tiket</th>
                                            <th>Atas Nama</th>
                                            <th>Tanggal Pembayaran</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status Tiket</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tickets as $ticket) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($ticket['id']); ?></td>
                                                <td><?php echo htmlspecialchars($ticket['nama_pembeli']); ?></td>
                                                <td><?php echo htmlspecialchars($ticket['tgl_pembayaran']); ?></td>
                                                <td><?php echo htmlspecialchars($ticket['jumlah_tiket']); ?></td>
                                                <td><?php echo "Rp. " . number_format($ticket['total_harga'], 0, ',', '.'); ?></td>
                                                <td><?php echo htmlspecialchars($ticket['metode_pembayaran']); ?></td>
                                                <td>
                                                    <a href="uploads/<?php echo htmlspecialchars($ticket['bukti_pembayaran']); ?>" download>
                                                        Download
                                                    </a>
                                                </td>
                                                <td><?php echo htmlspecialchars($ticket['status_tiket']); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <div class="tab-pane fade" id="account-info">
                        <div class="table-responsive">
                            <table class="table card-table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Tiket</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Jumlah Tiket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tickets as $ticket): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($ticket['TicketID']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['NamaTiket']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['TglKunjungan']); ?></td>
                                        <td><?php echo htmlspecialchars($ticket['JumlahTiket']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='print_tickets.php'">Print</button>&nbsp;
                            <button type="button" class="btn btn-default" onclick="window.location.href='cancel_tickets.php'">Cancel</button>
                        </div>
                    </div>
                </div>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
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
</script>
<script>
function showTicket(kodeTiket) {
  // Ganti dengan logika untuk menampilkan detail tiket berdasarkan kodeTiket
  $('#account-info').removeClass('show active');
  $('#ticket-tab').tab('show');
  $('#account-infoo').addClass('show active').removeClass('hidden');
}
function goBack() {
  $('#account-infoo').removeClass('show active');
  $('#account-tab').tab('show');
  $('#account-info').addClass('show active').removeClass('hidden');
}
</script>

</body>
</html>
