<?php
session_start(); // Mulai sesi

include "koneksi.php";

$id_kamar = isset($_GET['id']) ? $_GET['id'] : '';

$query = "SELECT deskripsi, gambar FROM kamar WHERE id = $id_kamar";
$result = mysqli_query($connect, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $deskripsi_kamar = $row['deskripsi'];
    $gambar_kamar = 'data:image/jpeg;base64,' . base64_encode($row['gambar']);
} else {
    $deskripsi_kamar = "Deskripsi tidak tersedia";
    $gambar_kamar = "asset/default.jpg"; 
}

mysqli_close($connect);
?>

<html>
<head>
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="navbar.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
      .bot-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background-color: #009688;
    width: 90%;
    padding: 20px;
    margin: 20px auto 0; 
    transform: translateY(-300px)
  }


  .left-container{
    flex: 1;
    text-align: center;
    background-color:#FFBF73;
    border-radius: 15px;
    color:white;
  }
  .right-container {
    flex: 2;
    text-align: center;
    margin-right: 200px;
    color:white;
    margin-left: 50;
    background-color:#FFBF73;
    border-radius: 15px;
  }

  .left-container button{
    display: block;
    margin: 10px auto;
    color:white;
    background-color: #009688;
    border:none;
    border-radius: 3px;
  }
  .right-container button {
    display: block;
    margin: 10px auto;
    background-color: #009688;
    width: 300px;
    color:white;
    border:none;
    border-radius: 3px;
  }

  .corner-button {
    position: absolute;
    bottom: 10px;
    right: 10px;
    color:white;
    background-color: #FFBF73;
    border: none;
    border-radius: 3px;
    margin-bottom: 20px;
    margin-right: 50px;
  }
</style>

<body>
<div class="navbar-container sticky-top">
    <ul style="display: flex; justify-content: space-between; align-items: center; list-style-type: none; padding: 0; margin: 0; width: 100%;">
        <li class="nav-link">
            <a href="sewakamar.php">Kembali</a>
            <div class="underline"></div>
        </li>
        <li style="margin-right: auto; padding:auto;">
            <div class="navbar-title" style="font-weight: bold; font-size: 1.2em; background-color: #009688;">Sewa Kamar</div>
        </li>
        <li></li><li></li>
    </ul>
</div>

<div class="outer-container">
  <div class="inner-container">
  <div class="image">
    <img src="<?php echo $gambar_kamar; ?>" alt="Gambar" class="gambar-kecil">
</div>
<div class="description">
    <h2>Deskripsi Kamar</h2>
    <p><?php echo $deskripsi_kamar; ?></p>
</div>
    <div class="action">
    <form action="uploadbukti.php?id=<?php echo $id_kamar; ?>" method="post" enctype="multipart/form-data">
    <input type="number" name="qty[<?php echo $id_kamar; ?>]" min="0" placeholder="Lama Sewa(Bulan)">
      <button class="tombol">Harga Sewa = Rp. 500.000 / Bulan</button>
    </div>
  </div>
</div>
<div class="bot-container">
  <div class="left-container">
    <p>Metode Pembayaran</p>
    <button>Online</button>
  </div>
  <div class="right-container">
    <p>Transaksi</p>
    <button>0412 XXXX XXXX</button>
      <button type="submit" name="submit">
      <input type="file" name="fileToUpload" id="fileToUpload"></button>
  </div>
  <button class="corner-button" type="submit" name="submit">Selesai</button>
</div>

</body>
</html>

    <!--CONTENT END-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
