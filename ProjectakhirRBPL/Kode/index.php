<?php
session_start(); // Memulai sesi
include "koneksi.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    // Jika belum login, arahkan kembali ke halaman login
    header("Location: login.php");
    exit(); // Hentikan eksekusi skrip selanjutnya
}

$notification_color = ''; // Warna notifikasi (default: tidak ada)
$notification_text = ''; // Teks notifikasi (default: tidak ada)
$show_sewa_kamar = true; // Apakah menampilkan navbar sewa kamar (default: ya)

// Ambil id_user dari sesi yang sedang login
$id_user = $_SESSION['id_user'];

// Logika notifikasi
$hari_ini = date('Y-m-d');

$query = "
SELECT 
    id_user,
    nama_penyewa, 
    tanggal, 
    lama_sewa,
    status_konfirmasi
FROM 
    pembayaran2
WHERE
    id_user = $id_user
";

$result = $connect->query($query);
if (!$result) {
    die("Query error: " . $connect->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_user = $row['id_user'];
        $nama_penyewa = $row['nama_penyewa'];
        $tanggal_sewa = $row['tanggal'];
        $lama_sewa = $row['lama_sewa'];
        $status_konfirmasi = $row['status_konfirmasi'];

        $tanggal_h_minus_3 = date('Y-m-d', strtotime("$tanggal_sewa +$lama_sewa months -3 days"));
        $tanggal_h = date('Y-m-d', strtotime("$tanggal_sewa +$lama_sewa months"));

        // Mengecek apakah hari ini adalah H-3 atau H
        if ($hari_ini == $tanggal_h_minus_3 || $hari_ini == $tanggal_h) {
            $notification_color = 'yellow'; // Atur warna notifikasi
            $notification_text = 'Durasi sewa tinggal 3 hari'; // Atur teks notifikasi
            break; // Keluar dari loop setelah menemukan notifikasi
        }
    }
}

// Logika notifikasi setelah hari H
if (isset($tanggal_h) && $hari_ini > $tanggal_h) {
    $notification_color = 'red'; // Atur warna notifikasi
    $notification_text = 'Durasi kos telah habis'; // Atur teks notifikasi
}

// Cek apakah user sudah ada di tabel pembayaran2
if ($result->num_rows === 0 || $hari_ini < $tanggal_h_minus_3) {
    $show_sewa_kamar = false; // Jika belum, jangan tampilkan navbar sewa kamar
}

?>

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

    <!-- Navbar dengan notifikasi -->
    <?php if ($notification_color != ''): ?>
    <div class="navbar-container" style="background-color: <?php echo $notification_color; ?>;">
        <ul>
            <li class="nav-link active-link">
                <a href="index.php">Home</a>
                <div class="underline"></div>
            </li>
            <li class="nav-link">
                <a href="profile.php">Profile</a>
                <div class="underline"></div>
            </li>
            <?php if ($show_sewa_kamar): ?>
                <li class="nav-link">
                    <a href="sewakamar.php">Sewa Kamar</a>
                    <div class="underline"></div>
                </li>
            <?php endif; ?>
            <li class="nav-link">
                <a href="logout.php">Logout</a>
                <div class="underline"></div>
            </li>
            <li class="notification" style="color: white;"><?php echo $notification_text; ?></li>
        </ul>
    </div>
    <?php else: ?>
    <!-- Navbar tanpa notifikasi -->
    <div class="navbar-container">
        <ul>
            <li class="nav-link active-link">
                <a href="index.php">Home</a>
                <div class="underline"></div>
            </li>
            <li class="nav-link">
                <a href="profile.php">Profile</a>
                <div class="underline"></div>
            </li>
            <?php if ($show_sewa_kamar || $result->num_rows === 0): ?>
                <li class="nav-link">
                    <a href="sewakamar.php">Sewa Kamar</a>
                    <div class="underline"></div>
                </li>
            <?php endif; ?>
            <li class="nav-link">
                <a href="logout.php">Logout</a>
                <div class="underline"></div>
            </li>
        </ul>
    </div>
    <?php endif; ?>

    <!--CONTENT START-->
    <center><h1 style="text-decoration: solid;">ASRAMA MONJALI</h1></center>
    <div class="bg-text">
        <h2>DESKRIPSI ASRAMA PUTRI MON
, sebuah tempat tinggal yang nyaman dan aman bagi mahasiswi di Kampus Baru UHO. Terletak strategis di JL. H.E.A. Mokodompit, 
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