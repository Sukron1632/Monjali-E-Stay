<html>
<head>
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="navbar.css"/>
</head>
<body style=" background-image: url('asset/logo.jpg');
background-repeat: no-repeat;
background-position: center;
background-attachment: fixed;
background-size: 1050px;
max-height: 10%;">
<?php
session_start(); // Memulai sesi
include "koneksi.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    // Jika belum login, arahkan kembali ke halaman login
    header("Location: login.php");
    exit(); // Hentikan eksekusi skrip selanjutnya
}?>
     <div class="navbar-container">
        <ul>
            <li class="nav-link active-link">
                <a href="index.php">Home
                </a>
                <div class="underline"></div>
            </li>
            <li class="nav-link">
                <a href="konfirmasi.php">Konfirmasi Pembayaran</a>
                <div class="underline"></div>
            </li>
            <li class="nav-link">
                <a href="laporan.php">Laporan</a>
                <div class="underline"></div>
            </li>
            <li class="nav-link">
                <a href="logout.php">Logout</a>
                <div class="underline"></div>
            </li>
        </ul>
    </div>
    <!--CONTENT START-->
    <center><h1 style="text-decoration: solid;">ASRAMA MONJALI</h1></center>

    <div class="bg-text">
        <h2>DESKRIPSI ASRAMA PUTRI MONJALI</h2>
        <p>Selamat datang di Asrama Putri Monjali, sebuah tempat tinggal yang nyaman dan aman bagi mahasiswi di Kampus Baru UHO. Terletak strategis di JL. H.E.A. Mokodompit, 
            Lorong Perintis, Asrama Putri Monjali menawarkan lingkungan yang mendukung untuk belajar dan beristirahat.</p>
        <p>Didirikan pada tahun 2007, asrama ini memiliki 42 kamar yang tersebar di dua lantai. Setiap kamar didesain dengan mempertimbangkan
             kenyamanan dan privasi penghuni, menjadikannya tempat yang ideal untuk tinggal selama masa studi Anda.</p>
        <p>Kami menyediakan fasilitas parkir yang luas, sehingga Anda tidak perlu khawatir tentang tempat penyimpanan kendaraan Anda. Untuk keamanan tambahan, area asrama dilengkapi dengan CCTV yang beroperasi 24 jam. Kami juga menyediakan 
            layanan Wi-Fi cepat dan stabil, memastikan Anda tetap terhubung untuk keperluan akademis maupun hiburan.Dengan kombinasi fasilitas lengkap dan lokasi yang strategis, Asrama Putri Monjali adalah pilihan terbaik 
            untuk Anda yang mencari hunian nyaman dan aman selama menempuh pendidikan di Kampus Baru UHO.</p>
      </div>
    <!--CONTENT END-->
</body>
</html>