<?php
include "koneksi.php";

if (isset($_GET['id_pembayaran'])) {
    $id_pembayaran = $_GET['id_pembayaran'];

    // Query untuk mendapatkan detail pembayaran
    $query = "SELECT * FROM pembayaran2 WHERE id_pembayaran = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id_pembayaran);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_kamar = $row['id_kamar'];
        $id_user = $row['id_user'];
        $nama_penyewa = $row['nama_penyewa'];
        $tanggal_pembayaran = $row['tanggal'];
        $total = $row['total_bayar'];
        $bukti = $row['bukti'];

        // Masukkan data ke dalam tabel pemasukan
        $insert_query = "INSERT INTO pemasukan (id_kamar, id_user, nama_penyewa, tanggal, total_bayar, bukti) 
                         VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($insert_query);
        $stmt->bind_param("iisdss", $id_kamar, $id_user, $nama_penyewa, $tanggal_pembayaran, $total, $bukti);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Update status_konfirmasi menjadi 1 (terkonfirmasi)
            $update_query = "UPDATE pembayaran2 SET status_konfirmasi = 1 WHERE id_pembayaran = ?";
            $stmt = $connect->prepare($update_query);
            $stmt->bind_param("i", $id_pembayaran);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("location: laporanbulanan.php");
            } else {
                echo "Gagal mengupdate status konfirmasi pembayaran.";
                echo $tanggal_pembayaran;
            }
        } else {
            echo "Gagal memasukkan data ke tabel pemasukan.";
        }
    } else {
        echo "Data pembayaran tidak ditemukan.";
    }

    $stmt->close();
} else {
    echo "Permintaan tidak valid.";
}
?>
