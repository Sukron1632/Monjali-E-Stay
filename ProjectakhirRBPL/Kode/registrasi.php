<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style=" background-image: url('asset/logo.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: 1100px;">
    <div>
    <!-- CONTENT 1 -->
    <div class="content1">
    <br>
        <form class="a-content" action="prosesregistrasi.php" method="get">
        <br>
        <center style="font-size: 30px;">REGISTRASI</center>
        <br><br>
        <table>
                <tr>
                    <td></td>
                    <td>Username<br><br><input type="text" name="username" size="20" placeholder="  Username Anda" style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque; margin-right:25px" required></td>
                    <td>Password<br><br><input type="password" name="password" size="20" placeholder="  Password Anda" style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama<br><br><input type="text" name="nama_penyewa" size="20" placeholder="  Nama Anda" style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                    <td>Alamat<br><br><input type="text" name="alamat" size="20" placeholder="  Alamat Anda" style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Status<br><br><input type="text" name="status" size="20" placeholder="  Status" style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                    <td>No. Handphone<br><br><input type="text" name="no_hp" size="20" placeholder="  No. Handphone" style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama Orang Tua<br><br><input type="text" name="nama_orangtua" size="20" placeholder="  Nama orang tua" style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                    <td>No. Handphone Orang Tua<br><br><input type="text" name="no_orangtua" size="20" placeholder="  No. Handphone Orang Tua" style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                </tr>
            </table>
            <br><input type="checkbox"required> Dengan ini saya membaca, memahami, <br>dan menyetujui hal-hal yang tercantum pada <br><a href="persetujuan.php">Syarat dan Ketentuan dan Kebijakan Privasi yang berlaku</a><br>
            <br><br><br><center><colspan="2"><input type="submit" name="kirim" value="KIRIM" style="width: 280px; height:40px; color: white; background-color: #83D3D3; border-radius:12px; border-color:white; font-size:15px;">
                <br>Have an account? 
            <a href="login.php" style="text-decoration: black;">Login!</a></center>
            
        </form>

        </div>
    </div>
    <!-- CONTENT 1 SELESAI -->
 </div>
</body>
</html>