<?php 
    include "koneksi.php";
    $username=$_GET['username'];
    $password = md5($_GET['password']);
    $nama=$_GET['nama_penyewa'];
    $alamat=$_GET['alamat'];
    $status=$_GET['status'];
    $nohp=$_GET['no_hp'];
    $namaortu=$_GET['nama_orangtua'];
    $noortu=$_GET['no_orangtua'];
    $role=$_GET['role'];
    
    

    $sql="INSERT INTO user (username, password, nama_penyewa, alamat, status, no_hp, nama_orangtua, no_orangtua, role)
    VALUE ('$username', '$password', '$nama', '$alamat', '$status', '$nohp', '$namaortu', '$noortu', '$role')";

if(mysqli_query($connect, $sql)){
    header('location: login.php');?>
    <?php
}
else{
    echo "Record gagal dibuat" . mysqli_error($connect);
}

mysqli_close($connect);
?>