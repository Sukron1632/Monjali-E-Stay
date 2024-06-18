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
    <form class="a-content" action="proseseditpengeluaran.php" method="get">
    <br>
    <center style="font-size: 30px;">INPUT PENGELUARAN</center>
    <br><br>
    <table>
        <?php
            include "koneksi.php";
            if (isset($_GET['id_pengeluaran'])) {
                $id_pengeluaran = $_GET['id_pengeluaran'];
                $query = "SELECT * FROM pengeluaran WHERE id_pengeluaran = '$id_pengeluaran'";
                $result = mysqli_query($connect, $query);

                while ($row = mysqli_fetch_array($result)) {
        ?>
                    <tr>
                        <td></td>
                        <td class="transparant">
                            Listrik<br><br>
                            <input type="text" name="listrik" placeholder="  Rp." style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque; margin-right:25px" value="<?php echo $row['listrik']; ?>">
                        </td>
                        <td>
                            Air<br><br>
                            <input type="text" name="air" placeholder="  Rp." style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" value="<?php echo $row['air']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Internet<br><br>
                            <input type="text" name="wifi" placeholder="  Rp." style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" value="<?php echo $row['wifi']; ?>">
                        </td>
                        <td>
                            Lain - Lain<br><br>
                            <input type="text" name="lain" placeholder="  Rp." style="opacity: 0.7;height: 50px; width: 300px; border-radius: 10px; border-color:bisque;" value="<?php echo $row['lain']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><br>
                            <center>
                                <input type="hidden" name="id_pengeluaran" value="<?php echo $id_pengeluaran; ?>">
                                <input type="submit" name="kirim" value="Simpan" style="height: 30px; width: 200px; border-radius: 10px;border-color: white; color: white; background-color: #FFBF73; border-radius:12px; border-color:white; font-size:15px;">
                            </center>
                        </td>
                    </tr>
        <?php
                }
            } else {
                echo "Error: id_pengeluaran is not set.";
            }
        ?>
    </table>
</form>

        </div>
    </div>
    <!-- CONTENT 1 SELESAI -->
 </div>
</body>
</html>