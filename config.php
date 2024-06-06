<?php
$con = mysqli_connect("localhost", "root", "", "testing");

if(mysqli_connect_errno()) {
    echo "Gagal Koneksi Database : " . mysqli_connect_errno();
}
?>