<?php 
    include "koneksi.php";
    $id_pengeluaran=$_GET['id_pengeluaran'];
    $query="DELETE  FROM pengeluaran WHERE id_pengeluaran='$id_pengeluaran'";
    $result=mysqli_query($connect, $query);
if($result){
    header("location: laporanbulanan.php");?>


<?php
}else{
    echo "Record gagal dihappus" . mysqli_error($connect);
}
?>

