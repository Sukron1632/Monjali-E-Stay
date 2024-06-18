<?php
session_start(); // Memulai sesi
include "koneksi.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    // Jika belum login, arahkan kembali ke halaman login
    header("Location: login.php");
    exit(); // Hentikan eksekusi skrip selanjutnya
}

$id_penyewa = $_SESSION['id_user'];

// Ambil nama_penyewa dari tabel user berdasarkan id_penyewa
$query_nama_penyewa = "SELECT nama_penyewa FROM user WHERE id_user = ?";
$stmt_nama_penyewa = mysqli_prepare($connect, $query_nama_penyewa);
if (!$stmt_nama_penyewa) {
    die("Gagal mempersiapkan statement: " . mysqli_error($connect));
}

mysqli_stmt_bind_param($stmt_nama_penyewa, "i", $id_penyewa);
if (!mysqli_stmt_execute($stmt_nama_penyewa)) {
    die("Gagal mengeksekusi statement: " . mysqli_error($connect));
}

mysqli_stmt_store_result($stmt_nama_penyewa);

// Bind hasil query ke variabel
mysqli_stmt_bind_result($stmt_nama_penyewa, $nama_penyewa);

// Fetch hasil query
mysqli_stmt_fetch($stmt_nama_penyewa);

mysqli_stmt_close($stmt_nama_penyewa);

// Periksa apakah tombol submit ditekan
if (isset($_POST["submit"])) {
    // Ambil id_kamar dari URL
    $id_kamar = isset($_GET['id']) ? $_GET['id'] : '';

    // Jika id_kamar tidak ada, tampilkan pesan error
    if (empty($id_kamar)) {
        die("Error: ID kamar tidak ditemukan.");
    }

    // Mengambil nilai qty dari input number
    $qty = isset($_POST['qty'][$id_kamar]) ? (int)$_POST['qty'][$id_kamar] : 0;
    $harga_per_bulan = 500000;
    $total_bayar = $qty * $harga_per_bulan;

    // Mendapatkan tanggal pembayaran saat ini
    $tanggal_pembayaran = date('Y-m-d');

    // Persiapkan query untuk menyimpan total bayar, tanggal, dan qty ke dalam database pembayaran2
    $query_pembayaran2 = "INSERT INTO pembayaran2 (id_kamar, id_user, nama_penyewa, total_bayar, tanggal, bukti, lama_sewa) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_pembayaran2 = mysqli_prepare($connect, $query_pembayaran2);

    if (!$stmt_pembayaran2) {
        die("Gagal mempersiapkan statement: " . mysqli_error($connect));
    }

    // Upload file jika ada
    if ($_FILES["fileToUpload"]["error"] == 0) {
        // Lakukan proses upload file
        $fileContent = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);

        // Bind parameter ke statement
        mysqli_stmt_bind_param($stmt_pembayaran2, "iisissi", $id_kamar, $id_penyewa, $nama_penyewa, $total_bayar, $tanggal_pembayaran, $fileContent, $qty);

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt_pembayaran2)) {
            $id_pembayaran = mysqli_insert_id($connect); // Dapatkan id_pembayaran yang baru saja dimasukkan

            // Ambil data dari tabel user berdasarkan id_user
            $query_user = "SELECT username, password, alamat, status, no_hp, nama_orangtua, no_orangtua FROM user WHERE id_user = ?";
            $stmt_user = mysqli_prepare($connect, $query_user);
            if (!$stmt_user) {
                die("Gagal mempersiapkan statement: " . mysqli_error($connect));
            }
            mysqli_stmt_bind_param($stmt_user, "i", $id_penyewa);
            if (!mysqli_stmt_execute($stmt_user)) {
                die("Gagal mengeksekusi statement: " . mysqli_error($connect));
            }
            mysqli_stmt_bind_result($stmt_user, $username, $password, $alamat, $status, $no_hp, $nama_orangtua, $no_orangtua);
            mysqli_stmt_fetch($stmt_user);
            mysqli_stmt_close($stmt_user);

            // Persiapkan query untuk menyimpan data ke dalam tabel penyewa
            $query_penyewa = "INSERT INTO penyewa (id_laporanpenyewa, id_kamar, id_user, nama_penyewa, username, password, alamat, status, no_hp, nama_orangtua, no_orangtua) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_penyewa = mysqli_prepare($connect, $query_penyewa);
            if (!$stmt_penyewa) {
                die("Gagal mempersiapkan statement: " . mysqli_error($connect));
            }
            mysqli_stmt_bind_param($stmt_penyewa, "iissssssss", $id_kamar, $id_penyewa, $nama_penyewa, $username, $password, $alamat, $status, $no_hp, $nama_orangtua, $no_orangtua);
            if (!mysqli_stmt_execute($stmt_penyewa)) {
                die("Gagal memasukkan data ke dalam tabel penyewa: " . mysqli_error($connect));
            }
            mysqli_stmt_close($stmt_penyewa);

            echo "File " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " berhasil diupload.";

            // Redirect ke halaman yang sesuai setelah pembayaran selesai
            header("Location: index.php");
            exit(); // Hentikan eksekusi skrip selanjutnya setelah redirect
        } else {
            die("Gagal memasukkan total bayar ke database pembayaran2: " . mysqli_error($connect));
        }
    } else {
        die("Gagal mengupload file bukti pembayaran.");
    }

    // Tutup statement
    mysqli_stmt_close($stmt_pembayaran2);
}

// Tutup koneksi ke database
mysqli_close($connect);
?>
