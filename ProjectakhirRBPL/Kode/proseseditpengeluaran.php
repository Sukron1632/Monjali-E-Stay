<?php
    include "koneksi.php";

    // Check if the form is submitted
    if (isset($_GET['kirim'])) {
        $id_pengeluaran = $_GET['id_pengeluaran'];
        $listrik = $_GET['listrik'];
        $air = $_GET['air'];
        $wifi = $_GET['wifi'];
        $lain = $_GET['lain'];

        // Update query
        $query = "UPDATE pengeluaran SET listrik='$listrik', air='$air', wifi='$wifi', lain='$lain' WHERE id_pengeluaran='$id_pengeluaran'";
        $result = mysqli_query($connect, $query);

        // Redirect or display an error message based on the result
        if ($result) {
            header("location: indexoperasional.php");
        } else {
            echo "Record gagal diupdate: " . mysqli_error($connect);
        }
    } else {
        echo "Form not submitted correctly.";
    }
?>
