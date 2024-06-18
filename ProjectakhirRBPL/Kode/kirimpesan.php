<?php
include "koneksi.php";

$botToken = "7470231666:AAGFIvHJuktUD-Le5_WrFIoZOiSGYpzMj_U"; // Ganti dengan token bot Telegram Anda

$hari_ini = date('Y-m-d');

$query = "
SELECT 
    id_user,
    id_kamar,
    nama_penyewa, 
    tanggal, 
    lama_sewa,
    status_konfirmasi
FROM 
    pembayaran2
";

$result = $connect->query($query);
if (!$result) {
    die("Query error: " . $connect->error);
}

$message_sent = false; // Flag untuk menandai apakah pesan telah terkirim
$messages = array(); // Definisikan array untuk menyimpan pesan

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_user = $row['id_user'];
        $id_kamar = $row['id_kamar'];
        $nama_penyewa = $row['nama_penyewa'];
        $tanggal_sewa = $row['tanggal'];
        $lama_sewa = $row['lama_sewa'];
        $status_konfirmasi = $row['status_konfirmasi'];

        $tanggal_h_minus_3 = date('Y-m-d', strtotime("$tanggal_sewa +$lama_sewa months -3 days"));
        $tanggal_h = date('Y-m-d', strtotime("$tanggal_sewa +$lama_sewa months"));

        // Mengecek apakah hari ini adalah H-3 atau H
        if ($hari_ini == $tanggal_h_minus_3 || $hari_ini == $tanggal_h) {
            $message = "";
            if ($hari_ini == $tanggal_h_minus_3) {
                $message = "Masa sewa kos Anda tinggal 3 hari.";
            } elseif ($hari_ini == $tanggal_h) {
                $message = "Masa sewa Anda sudah berakhir.";
            }
            $message .= "\nNama Penyewa: $nama_penyewa \nNomor Kamar: $id_kamar";

            // Tambahkan pesan ke dalam array untuk dicetak dan dikirimkan nanti
            $messages[] = $message;
        }
    }
}

// Cetak pesan-pesan yang akan dikirimkan ke Telegram
foreach ($messages as $message) {
    echo $message . "<br>";
}

// Mengirimkan pesan ke Telegram setelah semua pengecekan selesai
foreach ($messages as $message) {
    // Nomor HP penerima atau chat ID grup di Telegram
    $chatId = "-1002158021058"; 

    // URL API untuk mengirim pesan
    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    // Data yang akan dikirim melalui POST
    $data = [
        'chat_id' => $chatId,
        'text' => $message
    ];

    // Menggunakan curl untuk mengirim POST request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    // Cek apakah ada kesalahan dalam pengiriman
    if ($response === false) {
        echo "Gagal mengirim pesan ke Telegram: " . curl_error($ch);
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            echo "Gagal mengirim pesan ke Telegram. Kode HTTP: $httpCode<br>";
            echo "Response: $response<br>";
        } else {
            $message_sent = true; // Pesan berhasil terkirim
        }
    }

    curl_close($ch);
}

// Jika tidak ada pesan yang dikirim, tampilkan pesan ini
if (!$message_sent) {
    echo "Tidak ada pesan yang dikirim.";
} else {
    echo "Pesan berhasil dikirim.";
    header("Location: indexadmin.php"); // Redirect setelah pesan berhasil dikirim
}

$connect->close();
?>
