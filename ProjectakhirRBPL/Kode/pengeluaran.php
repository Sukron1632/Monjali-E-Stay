<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body style=" background-image: url('asset/logo.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: 950px;">
            <script src="format.js"></script>
    <!-- CONTENT 1 -->
    <div>
    <div class="content1">
    <br>
        <form class="a-content" action="inputpengeluaran.php" method="get">
        <br>
        <center style="font-size: 30px;">INPUT PENGELUARAN</center>
        <br><br>
        <table>
                <tr>
                    <td></td>
                    <td class="transparant">Listrik<br><br><input type="text"  name="listrik"  placeholder="  Rp." style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque; margin-right:25px" required></td>
                    <td>Air<br><br><input type="text"  name="air" placeholder="  Rp." style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Internet<br><br><input type="text"  name="wifi"  placeholder="  Rp." style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                    <td>Lain - Lain<br><br><input type="text"  name="lain"  placeholder="  Rp." style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" required></td>
                </tr>
                <tr">
                    <td></td>
                    <td></td>
                    <td><br><center><colspan="2"><input type="submit" name="kirim" value="Simpan" style="height: 30px; width: 200px; border-radius: 10px;border-color: white; color: white; background-color: #FFBF73; border-radius:12px; border-color:white; font-size:15px;"></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
    <!-- CONTENT 1 SELESAI -->
 </div>
</body>
</html>