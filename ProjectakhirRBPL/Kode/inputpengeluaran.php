<?php 
    include "koneksi.php";
    $id_pengeluaran = $_GET['id_pengeluaran'];
    $listrik=$_GET['listrik'];
    $air = $_GET['air'];
    $wifi=$_GET['wifi'];
    $lain=$_GET['lain'];
    
    

    $sql="INSERT INTO pengeluaran (id_pengeluaran, listrik, air, wifi, lain)
    VALUE ('$id_pengeluaran','$listrik', '$air', '$wifi', '$lain')";

if(mysqli_query($connect, $sql)){
    header('location: indexoperasional.php');?>
    <?php
}
else{
    echo "Data Gagal Disimpan" . mysqli_error($connect);
}

mysqli_close($connect);
?>