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
    padding-top: 30px;">
    </div>
    <!-- CONTENT 1 SELESAI -->
 </div>
</body>
</html>