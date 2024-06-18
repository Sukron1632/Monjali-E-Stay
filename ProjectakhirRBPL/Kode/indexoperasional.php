<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="navbar.css"/>
    <style>
        /* Tambahkan gaya khusus untuk laporan pengeluaran */
        .t-d {
            padding: 10px;
            text-align: center;
        }
        .table-center {
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-collapse: collapse;
            text-align: center;
            margin-left: 50px;
            background-color:#009688 ;
        }
        .table-center th, .table-center td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body style="background-image: url('asset/logo.jpg');
             background-repeat: no-repeat;
             background-position: center;
             background-attachment: fixed;
             background-size: 1050px;
             max-height: 10%;">
    <?php
    session_start(); // Memulai sesi
    include "koneksi.php";

    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['id_user'])) {
        // Jika belum login, arahkan kembali ke halaman login
        header("Location: login.php");
        exit(); // Hentikan eksekusi skrip selanjutnya
    }
    ?>
    <div class="navbar-container">
        <ul>
            <li class="nav-link active-link">
                <a href="indexoperasional.php">Laporan Pengluaran</a>
                <div class="underline"></div>
            </li>
            <li class="nav-link">
                <a href="logout.php">Logout</a>
                <div class="underline"></div>
            </li>
        </ul>
    </div>
    <!-- CONTENT START -->
    <div>
        <br>
        <a href="pengeluaran.php">
            <button style="color: white; margin-left: 170px; border-radius: 5px; background-color: #FFBF73; border-color: #FFBF73;">
                Input Pengeluaran
            </button>
        </a>
        <table class="table-center">
            <tr>
                <th>Listrik</th>
                <th>Internet</th>
                <th>Air</th>
                <th>Lain - Lain</th>
                <th>Aksi</th>
            </tr>
            <?php
            include "koneksi.php";
            $query = "SELECT * FROM pengeluaran";
            $result = mysqli_query($connect, $query);

            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td class="t-d"><?php echo $row["listrik"] ?></td>
                        <td class="t-d"><?php echo $row["air"] ?></td>
                        <td class="t-d"><?php echo $row["wifi"] ?></td>
                        <td class="t-d"><?php echo $row["lain"] ?></td>
                        <td class="t-d">
                            <a href="editpengeluaran.php?id_pengeluaran=<?php echo $row['id_pengeluaran']; ?>"
                               style="text-decoration:none;background-color: rgb(64, 64, 206); color: white; border-radius:5px; padding:5px;">
                                Edit
                            </a>
                            <a href="hapuspengeluaran.php?id_pengeluaran=<?php echo $row['id_pengeluaran']; ?>"
                               style="text-decoration:none;background-color: red; color: white; border-radius:5px; padding:5px;">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "";
            }
            ?>
        </table>
    </div>
    <!-- CONTENT END -->
</body>
</html>