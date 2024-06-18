<?php
// Konfigurasi database
$host = 'localhost';
$db = 'kosputri';
$user = 'root';
$pass = '';

// Membuat koneksi ke database
$mysqli = new mysqli($host, $user, $pass, $db);

// Memeriksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Fungsi untuk menulis data ke file CSV
function write_csv($filename, $data) {
    $file = fopen($filename, 'w');

    // Menulis header CSV
    if (!empty($data)) {
        fputcsv($file, array_keys($data[0]));
    }

    // Menulis data CSV
    foreach ($data as $row) {
        fputcsv($file, $row);
    }

    fclose($file);
}

// Mengambil data dari tabel penyewa
$result = $mysqli->query("SELECT * FROM penyewa");
$penyewa = [];
while ($row = $result->fetch_assoc()) {
    $penyewa[] = $row;
}

// Mengambil data tertentu dari tabel pemasukan dengan JOIN ke tabel penyewa
$query_pemasukan = "
    SELECT 
        pemasukan.id_pemasukan,
        pemasukan.id_user,
        pemasukan.id_kamar,
        penyewa.nama_penyewa AS nama_penyewa,
        pemasukan.tanggal,
        pemasukan.total_bayar
    FROM pemasukan
    JOIN penyewa ON pemasukan.id_user = penyewa.id_user
";

$result = $mysqli->query($query_pemasukan);
if (!$result) {
    die("Query Error: " . $mysqli->error);
}

$pemasukan = [];
while ($row = $result->fetch_assoc()) {
    // Memformat tanggal ke format d-m-Y
    $row['tanggal'] = date('d-m-Y', strtotime($row['tanggal']));
    $pemasukan[] = $row;
}

// Mengambil data dari tabel pengeluaran
$result = $mysqli->query("SELECT * FROM pengeluaran");
$pengeluaran = [];
while ($row = $result->fetch_assoc()) {
    // Memformat tanggal ke format d-m-Y jika ada kolom tanggal di tabel pengeluaran
    if (isset($row['tanggal'])) {
        $row['tanggal'] = date('d-m-Y', strtotime($row['tanggal']));
    }
    $pengeluaran[] = $row;
}

// Menulis data ke file CSV
write_csv('laporan_penyewa.csv', $penyewa);
write_csv('laporan_pemasukan.csv', $pemasukan);
write_csv('laporan_pengeluaran.csv', $pengeluaran);

echo "Laporan telah berhasil dibuat dalam bentuk file CSV.";

// Menutup koneksi database
$mysqli->close();
?>
