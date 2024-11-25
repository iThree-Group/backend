<?php
include 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $update_query = "UPDATE status_penerimaan_sampah SET status = 'ditolak' WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditolak!'); window.location='status_penerimaan.php';</script>";
    } else {
        echo "<script>alert('Gagal menolak data.'); window.location='status_penerimaan.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid.'); window.location='status_penerimaan.php';</script>";
}
?>
