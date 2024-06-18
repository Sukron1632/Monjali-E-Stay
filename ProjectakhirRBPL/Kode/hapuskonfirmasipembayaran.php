<?php 
    include "koneksi.php";
    $id_pembayaran=$_GET['id_pembayaran'];
    $query="DELETE  FROM pembayaran2 WHERE id_pembayaran='$id_pembayaran'";
    $result=mysqli_query($connect, $query);
if($result){
    header("location: konfirmasi.php");?>


<?php
}else{
    echo "Record gagal dihappus" . mysqli_error($connect);
}
?>

