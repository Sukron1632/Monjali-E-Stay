<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link rel="stylesheet" type="text/css" href="navbar.css"/>
    <style>
       table {
  border-collapse: collapse;
  width: 100%;
}


th, td {
  padding: 8px;
  text-align: center;
  border-bottom: 1px solid #DDD;
}

tr:hover {background-color: #007a6d;}
        </style>
</head>
<body style=" background-image: url('asset/logo.jpg');
background-repeat: no-repeat;
background-position: center;
background-attachment: fixed;
background-size: 950px;">
    <!-- CONTENT 1 MULAI -->
    <div class="navbar-container">
        <ul>
            <li class="nav-link active-link">
                <a href="indexadmin.php">Home
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
    <div class="judul" 
    style="background-color: #009688;
    color: white;
    font-size: 25px;
    justify-content: center;
    align-items: center; 
    text-align: center;
    margin-top: 80px;
    border-radius: 10px;
    width: 1450px;
    height: 70px;
    margin-left: 40px;
    padding-top: 45px;">
        Konfirmasi Pembayaran
    </div>
    <div class="cardkonten" style="background-color: #009688;
    color: whitesmoke;
    margin-top: 80px;
    border-radius: 10px;
    width: 1425px;
    height: 300px;
    margin-left: 50px;
    padding-top: 30px;">
      <div style="padding: 20px;">
        <table>
        <tr>
              <th>ID Kamar</th>
              <th>ID Penyewa</th>
              <th>Nama Penyewa</th>
              <th>Lama Sewa</th>
              <th>Total Bayar</th>
              <th>Tanggal Bayar</th>
              <th>Bukti Pembayaran</th>
              <th>Konfirmasi</th>
            </tr>
            <?php 
        include "koneksi.php";
        $query = "SELECT * FROM pembayaran2";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td class="t-d"><?php echo $row["id_kamar"]; ?></td>
        <td class="t-d"><?php echo $row["id_user"]; ?></td>
        <td class="t-d"><?php echo $row["nama_penyewa"]; ?></td>
        <td class="t-d"><?php echo $row["lama_sewa"]; ?></td>
        <td class="t-d"><?php echo $row["total_bayar"]; ?></td>
        <td class="t-d"><?php echo $row["tanggal"]; ?></td>
        <td class="t-d">
            <?php
            $id = $row["id_kamar"]; // Assuming 'id_kamar' is a unique identifier
            echo '<a href="download.php?id=' . $id . '">Download Bukti</a><br>';
            ?>
        </td>
        <td class="t-d"><a href="konfirmasipembayaran.php?id_pembayaran=<?php echo $row['id_pembayaran']; ?>" style="text-decoration:none;background-color: green; color: white; border-radius:5px; padding:5px;">Konfirmasi</a>
        <a href="hapuskonfirmasipembayaran.php?id_pembayaran=<?php echo $row['id_pembayaran']; ?>" style="text-decoration:none;background-color: red; color: white; border-radius:5px; padding:5px;">Hapus</a>
        </td>



    </tr>
    <?php
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
        }
    ?>
          </table>
      </div>
      <div 
      style="width: 500px;
      height: 30px;
      margin-left: 1300px;"
      >
      </div>
    </div>
    <!-- CONTENT 1 SELESAI -->
 </div>
</body>
</html>