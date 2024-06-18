<?php
include "koneksi.php"; // Include your database connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert id to integer for security

    // Query to fetch the BLOB data
    $query = "SELECT bukti FROM pembayaran2 WHERE id_kamar = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($blob_data);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Ensure output buffering is off
        if (ob_get_length()) ob_end_clean();

        // Set headers to initiate file download
        header('Content-Description: File Transfer');
        header('Content-Type: image/jpeg'); // Use correct content type
        header('Content-Disposition: attachment; filename="bukti_pembayaran_' . $id . '.jpg"');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($blob_data));

        // Output the image data
        echo $blob_data;
        exit;
    } else {
        echo "No data found!";
    }

    $stmt->close();
} else {
    echo "Invalid request!";
}
?>
