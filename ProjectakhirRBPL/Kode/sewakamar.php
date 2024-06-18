<html>
<head>
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="navbar.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
include "koneksi.php"; 
$deskripsi_kamar = array();
$gambar_kamar = array();

for ($i = 1; $i <= 9; $i++) {
    $query = "SELECT deskripsi, gambar FROM kamar WHERE id = $i";
    $result = mysqli_query($connect, $query); 

    
    if (!$result) {
        
        die("Query failed: " . mysqli_error($connect));
    }

    
    $deskripsi = "";
    $gambar = "";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $deskripsi = $row["deskripsi"];
        
        $gambar = 'data:image/jpeg;base64,' . base64_encode($row["gambar"]);
    }

    
    $deskripsi_kamar[] = $deskripsi;
    $gambar_kamar[] = $gambar;
}


mysqli_close($connect);
?>

    <div class="navbar-container sticky-top">
        <ul>
            <li class="nav-link">
                <a href="index.php">Home
                </a>
                <div class="underline"></div>
            </li>
            <li class="nav-link">
                <a href="profile.php">    Profile</a>
                <div class="underline"></div>
            </li>
            <li class="nav-link active-link">
                <a href="#">    Sewa kamar</a>
                <div class="underline"></div>
            </li>
            <li class="nav-link">
                <a class="btn" href="logout.php">    Logout</a>
                <div class="underline"></div>
            </li>
        </ul>
    </div>
    <?php
include "koneksi.php"; 
$deskripsi_kamar = array();
$gambar_kamar = array();

// Mendapatkan deskripsi dan gambar kamar
for ($i = 1; $i <= 9; $i++) {
    $query = "SELECT deskripsi, gambar FROM kamar WHERE id = $i";
    $result = mysqli_query($connect, $query); 

    if (!$result) {
        die("Query failed: " . mysqli_error($connect));
    }

    $deskripsi = "";
    $gambar = "";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $deskripsi = $row["deskripsi"];
        $gambar = 'data:image/jpeg;base64,' . base64_encode($row["gambar"]);
    }

    $deskripsi_kamar[] = $deskripsi;
    $gambar_kamar[] = $gambar;
}

// Memeriksa status konfirmasi pembayaran untuk setiap kamar
for ($i = 1; $i <= 9; $i++) {
    $id_kamar = $i;
    $query_pembayaran = "SELECT status_konfirmasi FROM pembayaran2 WHERE id_kamar = $id_kamar";
    $result_pembayaran = mysqli_query($connect, $query_pembayaran);

    // Menginisialisasi status konfirmasi
    $status_konfirmasi = 0; // Default: Kamar tersedia

    // Memeriksa apakah query pembayaran mengembalikan hasil atau tidak
    if ($result_pembayaran && mysqli_num_rows($result_pembayaran) > 0) {
        // Mengambil semua status konfirmasi untuk kamar ini
        while ($row_pembayaran = mysqli_fetch_assoc($result_pembayaran)) {
            // Memeriksa setiap status konfirmasi
            $status_konfirmasi = $row_pembayaran["status_konfirmasi"];

            // Jika ada status konfirmasi yang sudah terisi, langsung keluar dari loop
            if ($status_konfirmasi == 1) {
                break;
            }
        }
    }

    // Menyesuaikan deskripsi kamar berdasarkan status konfirmasi
    if ($status_konfirmasi == 1) {
        $deskripsi_kamar[$i - 1] = "Kamar sudah Terisi";
    }
}

mysqli_close($connect);
?>

<!--CONTENT START-->
<div class="container py-5">
    <h1 class="text-center">Sewa Kamar</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
        <?php for ($i = 1; $i <= 9; $i++) : ?>
            <div class="col">
                <div class="card">
                    <h5 class="text-center">Kamar <?php echo $i; ?></h5>
                    <img src="<?php echo $gambar_kamar[$i - 1]; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><?php echo $deskripsi_kamar[$i - 1]; ?></p>
                    </div>
                    <?php if ($deskripsi_kamar[$i - 1] != "Kamar sudah Terisi") : ?>
                        <div class="mb-5 d-flex justify-content-around">
                            <a href="formsewakamar.php?id=<?php echo $i; ?>" class="btn btn-warning">Sewa</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>
<!--CONTENT END-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>