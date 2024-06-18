<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="navbar.css"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .profile{
            display: flex;
            justify-content: center; 
            align-items: center; 
            background-color:#025454;
            opacity: 0.7;
            height: 50px; 
            width: 300px; 
            border-radius: 10px; 
            color:white;
            margin-right:25px;
        }
    </style>
</head>
<body style=" background-image: url('asset/logo.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: 950px;">
    <div>
    <!-- CONTENT 1 -->
    <div class="content1">
    <br>
    
        <div>
        
        <br>
        <center style="font-size: 30px;">PROFILE</center>
        <br><br>
        <table >
        <?php 
            include "koneksi.php";
            session_start(); 

            if ($_SESSION['status'] != 'login') {
                header("location:login.php");
                exit();
            }

            // Ambil username dari sesi
            $username = $_SESSION['username'];

            // Query untuk mendapatkan data pengguna yang login
            $query = "SELECT * FROM user WHERE username = ?";
            $stmt = mysqli_prepare($connect, $query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Periksa apakah ada data pengguna yang ditemukan
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                    <td></td>
                    <td>Username<br><br><div class="profile"><?php echo $row["username"] ?></td>
                    <td>Password<br><br><div class="profile"><?php echo $row["password"] ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama<br><br><div class="profile"><?php echo $row["nama_penyewa"] ?></td>
                    <td>Alamat<br><br><div class="profile"><?php echo $row["alamat"] ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Status<br><br><div class="profile"><?php echo $row["status"] ?></td>
                    <td>No. Handphone<br><br><div class="profile"><?php echo $row["no_hp"] ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama Orang Tua<br><br><div class="profile"><?php echo $row["nama_orangtua"] ?></td>
                    <td>No. Handphone Orang Tua<br><br><div class="profile"><?php echo $row["no_orangtua"] ?></td>
                </tr>
            <?php
                 }
                }
                else{
                    echo "0 Result";
                }
            ?>
                <tr>
                    <td></td>
                    <td><br>
                    <a href="historipembayaran.php"><Button style="height: 50px; width: 300px; border-radius: 10px;border-color: white; color: white; background-color: #83D3D3;">History Pembayaran</Button></a>
                    <br><a href="index.php"><Button style="height: 50px; width: 300px; border-radius: 10px;border-color: white; color: white; background-color: #83D3D3;">Kembali</Button></a>
                </td>
                    <td>
                        <br><center><a href="https://t.me/+1WKyvV9Ki7phZjBl"><Button style="height: 30px; width: 200px; border-radius: 10px;border-color: white; color: white; background-color: #83D3D3;">Masuk Grup Telegram</Button></a></center>
                        <br><center><a href="https://chat.whatsapp.com/EnsNgV29ZBa5B2hPKLI0ni"><Button style="height: 30px; width: 200px; border-radius: 10px;border-color: white; color: white; background-color: #83D3D3;">Masuk Grup WA</Button></a></center>
                    </td>
                    
                    
                </tr>
            </table>
            <br><br><br><center><colspan="2"><input type="submit" name="kirim" value="KIRIM" style="width: 280px; height:40px; color: white; background-color: #83D3D3; border-radius:12px; border-color:white; font-size:15px;">
        </div>
    </div>
    <!-- CONTENT 1 SELESAI -->
 </div>
</body>
</html>