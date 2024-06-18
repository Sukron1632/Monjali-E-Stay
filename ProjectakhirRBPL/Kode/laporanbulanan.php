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
                <a href="logout.php">Logout</a>
                <div class="underline"></div>
            </li>
        </ul>
    </div>
    <div style="display: flex; justify-content: space-around;">
        <a href="laporanpenyewa.php"><button class="judul" 
            style="background-color: #009688;
            border-color: #009688;
            color: white;
            font-size: 22px;
            justify-content: center;
            align-items: center; 
            text-align: center;
            margin-top: 80px;
            border-radius: 10px;
            width: 610px;
            height: 100px;
            margin-left: 40px;
            ">
                Laporan Data Penyewa
        </button></a>
        <a href="laporanbulanan.php"><button class="judul" 
            style="background-color: #FFBF73;
            border-color: #FFBF73;
            color: white;
            font-size: 22px;
            justify-content: center;
            align-items: center; 
            text-align: center;
            margin-top: 80px;
            border-radius: 10px;
            width: 610px;
            height: 100px;
            margin-left: 40px;
            ">
                Laporan Bulanan
        </button></a>
    </div>
    <div class="cardkonten" style="background-color: #009688;
    color: whitesmoke;
    margin-top: 80px;
    border-radius: 10px;
    width: 1425px;
    height: 300px;
    margin-left: 50px;
    padding-left: 10px;
    padding-right: 10px;">
      <div style="padding: 0px; display: flex;justify-content: space-around;">
        <div>
            <center style="font-size: 20px;">
                Laporan Pemasukan
            </center>
            <br><br>
            <table>
                <tr>
                  <th>ID Kamar</th>
                  <th>ID Penyewa</th>
                  <th>Nama Penyewa</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Total Pembayaran</th>
                  <th>Bukti Pembayaran</th>
                </tr>
                <tr>
                <?php 
include "koneksi.php";
$query = "SELECT * FROM pembayaran2 WHERE status_konfirmasi = 1";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $tanggal_bayar = date("d-m-Y", strtotime($row["tanggal"])); // Ubah format tanggal
?>
    <tr>
        <td class="t-d"><?php echo $row["id_kamar"]; ?></td>
        <td class="t-d"><?php echo $row["id_user"]; ?></td>
        <td class="t-d"><?php echo $row["nama_penyewa"]; ?></td>
        <td class="t-d"><?php echo $tanggal_bayar; ?></td>
        <td class="t-d"><?php echo $row["total_bayar"]; ?></td>
        <td class="t-d">
            <?php
            $id = $row["id_kamar"];
            echo '<a href="download.php?id=' . $id . '">Download Bukti</a><br>';
            ?>
        </td>
    </tr>
<?php
    }
} else {
    echo "<tr><td colspan='6'>Tidak ada data yang telah dikonfirmasi.</td></tr>";
}
?>
                  </tr>  
    
              </table>
        </div>
        <div>
            <center style="font-size: 20px;">
                Laporan Pengeluaran
            </center>
            <br>
            <table>
                <tr>
                  <th>Listrik</th>
                  <th>Internet</th>
                  <th>Air</th>
                  <th>Lain - Lain</th>
                </tr>
                <?php 
                include "koneksi.php";
                $query="SELECT * FROM pengeluaran";
                $result=mysqli_query($connect, $query);

                if(mysqli_num_rows($result)){
                    while($row = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td class="t-d"> <?php echo $row["listrik"] ?></td>
                <td class="t-d"> <?php echo $row["air"] ?></td>
                <td class="t-d"> <?php echo $row["wifi"] ?></td>
                <td class="t-d"> <?php echo $row["lain"] ?></td>

            </tr>
            <?php
                 }
                }
                else{
                    echo "";
                }
            ?>
              </table>
        </div>
      </div>
      <div>
        <br>
        <form action="generate_report.php" method="post">
        <button type="submit" style="border-radius: 5px; border-color: #FFBF73; background-color: #FFBF73; color: white; height: 30px; width: 180px; margin-left: 1140px;">Cetak Laporan</button>
    </form>
      </div>
    </div>
    <!-- CONTENT 1 SELESAI -->
 </div>
</body>
</html>