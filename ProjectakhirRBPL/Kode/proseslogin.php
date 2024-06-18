<?php
session_start(); // Memulai sesi
include 'koneksi.php';

// Ambil data username dan password dari URL
$username = $_GET['username'];
$password = $_GET['password'];

// Hash password
$hashed_password = md5($password);

// Lakukan query untuk memeriksa kredensial pengguna
$query = "SELECT id_user, role, password FROM user WHERE username = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$cek = mysqli_fetch_assoc($result);

// Jika ada hasil dari query
if ($cek) {
    // Verifikasi password
    if (md5($password) === $cek['password']) {
        // Mulai sesi dan atur informasi sesi
        $_SESSION['id_user'] = $cek['id_user']; // Simpan id_penyewa dalam session
        $_SESSION['username'] = $username;
        $_SESSION['status'] = 'login';
        
        // Redirect sesuai dengan peran pengguna
        if ($cek['role'] == "admin") {
            header("location: kirimpesan.php");
            exit();
        } elseif ($cek['role'] == "operasional") {
            header("location: indexoperasional.php");
            exit();
        } else {
            header("location: index.php");
            exit();
        }
    } else {
        // Jika password tidak cocok
        header("location: login.php?error=password");
        exit();
    }
} else {
    // Jika pengguna tidak ditemukan
    header("location: login.php?error=user_not_found");
    exit();
}

// Tutup statement dan koneksi
mysqli_stmt_close($stmt);
mysqli_close($connect);
?>
