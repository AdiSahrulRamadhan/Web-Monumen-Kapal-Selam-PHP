<?php
include '../cek-login.php'; 
if(isset($_SESSION['submit'])) {
    // Jika sesi login tidak ada, arahkan pengguna kembali ke halaman login
    header("Location: ulasan-admin.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangani penghapusan ulasan jika ada permintaan
$message = "";
if(isset($_GET['delete_review_id'])) {
    $review_id = $_GET['delete_review_id'];

    // Hapus ulasan dari database
    $sql = "DELETE FROM review_table WHERE review_id = $review_id";

    if ($conn->query($sql) === TRUE) {
        $message = "Ulasan berhasil dihapus";
    } else {
        $message = "Error: " . $conn->error;
    }

    header("Location: ulasan-admin.php?message=" . urlencode($message));
    exit();
}

// Pagination setup
$results_per_page = 5; // Jumlah ulasan per halaman
$sql = "SELECT COUNT(review_id) AS total FROM review_table";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_results = $row['total'];
$total_pages = ceil($total_results / $results_per_page);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
} elseif ($page > $total_pages) {
    $page = $total_pages;
}

$offset = ($page - 1) * $results_per_page;

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
            <a class="list-group-item list-group-item-action active" href="ulasan-admin.php">Ulasan Pengunjung</a>
            <a class="list-group-item list-group-item-action" href="grafik-admin.php">Grafik Pengunjung</a>
        </div>
    </div>
    

    <div class="content" id="content">
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ulasan Pengunjung</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Ulasan</th>
                            <th>Rating</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            $sql = "SELECT review_id, user_name, user_review, user_rating FROM review_table LIMIT $results_per_page OFFSET $offset";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['user_name'] . "</td>";
                                    echo "<td>" . $row['user_review'] . "</td>";
                                    echo "<td>" . $row['user_rating'] . "/5</td>";
                                    echo "<td>";
                                    echo "<form method='GET' class='delete-form' style='display:inline;' onsubmit='return confirmDelete();'>";
                                    echo "<input type='hidden' name='delete_review_id' value='" . $row['review_id'] . "'>";
                                    echo "<button type='submit' class='btn btn-danger' style='background-color: red; color: white;'>Hapus</button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Tidak ada ulasan.</td></tr>";
                            }

                            $conn->close();
                        ?>
                    </tbody>
                </table>
                
                <!-- Pagination Navigation -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                        if ($page > 1) {
                            echo "<li class='page-item'><a class='page-link' href='ulasan-admin.php?page=" . ($page - 1) . "'>Previous</a></li>";
                        }

                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                echo "<li class='page-item active'><a class='page-link' href='ulasan-admin.php?page=$i'>$i</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='ulasan-admin.php?page=$i'>$i</a></li>";
                            }
                        }

                        if ($page < $total_pages) {
                            echo "<li class='page-item'><a class='page-link' href='ulasan-admin.php?page=" . ($page + 1) . "'>Next</a></li>";
                        }
                        ?>
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

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("show");
        document.getElementById("content").classList.toggle("shift");
        document.getElementById("footer").classList.toggle("shift");
    }

    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus ulasan ini?");
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

    window.onload = function() {
        const params = new URLSearchParams(window.location.search);
        if (params.has('message')) {
            alert(params.get('message'));
        }
    }
</script>

</body>
</html>
