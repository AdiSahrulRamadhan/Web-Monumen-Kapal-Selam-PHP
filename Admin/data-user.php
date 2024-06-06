<?php
include '../cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: data-user.php");
    exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        
        // Delete related records in the tiket table
        $deleteTiketQuery = "DELETE FROM tiket WHERE UserID = $id";
        $conn->query($deleteTiketQuery);
        
        // Now delete the user
        $deleteUserQuery = "DELETE FROM users WHERE UserID = $id";
        $conn->query($deleteUserQuery);
    }
}

// Define how many results you want per page
$results_per_page = 5;

// Find out the number of results stored in the database
$result = $conn->query("SELECT COUNT(UserID) AS total FROM users WHERE lvl = 2");
$row = $result->fetch_assoc();
$total_results = $row['total'];

// Determine number of total pages available
$total_pages = ceil($total_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, min($page, $total_pages)); // Ensure $page is between 1 and $total_pages

// Determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page - 1) * $results_per_page;

// Retrieve selected results from database and display them on page
$sql = "SELECT UserID, Username, namalengkap, Email, Password FROM users WHERE lvl = 2 LIMIT $this_page_first_result, $results_per_page";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
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
                <a href="#" class="dropdown-toggle">Tiket</a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a href="tiket.php">Informasi Tiket</a></li>
                    <li><a href="beli-tiket.php">Beli Tiket</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i></a>
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
            <a class="list-group-item list-group-item-action active" href="data-user.php">Data User</a>
            <a class="list-group-item list-group-item-action" href="data-admin.php">Data Admin</a>
            <a class="list-group-item list-group-item-action" href="tiket-admin.php">Data Tiket</a>
            <a class="list-group-item list-group-item-action" href="ulasan-admin.php">Ulasan Pengunjung</a>
            <a class="list-group-item list-group-item-action" href="grafik-admin.php">Grafik Pengunjung</a>
        </div>
    </div>
    <div class="content" id="content">
        <div class="container-fluid py-4">
            <div class="card" id="ticket-table-card">
                <div class="card-body">
                    <h5 class="font-weight-bold mb-3">Data User</h5>
                    <table class="table table-bordered" id="ticket-table">
                        <thead>
                            <tr>
                                <th>ID User</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['UserID']) ?></td>
                                    <td><?= htmlspecialchars($user['Username']) ?></td>
                                    <td><?= htmlspecialchars($user['namalengkap']) ?></td>
                                    <td><?= htmlspecialchars($user['Email']) ?></td>
                                    <td><?= htmlspecialchars($user['Password']) ?></td>
                                    <td>
                                        <form method="POST" class="delete-form" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['UserID']) ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button type="submit" class="btn btn-link" style="background-color: red; color: white;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("show");
            document.getElementById("content").classList.toggle("shift");
        }

        $(document).ready(function() {
            $('#hamburger').on('click', function() {
                $('#sidebar').toggleClass('show');
                $('#content').toggleClass('shift');
            });

            $('#close-btn').on('click', function() {
                $('#sidebar').removeClass('show');
                $('#content').removeClass('shift');
            });

            $('.delete-form').on('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
