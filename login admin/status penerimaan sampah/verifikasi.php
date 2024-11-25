<?php
include 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Ambil data sampah berdasarkan ID
    $query = "SELECT * FROM status_penerimaan_sampah WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $poin = $data['berat'] * 10; // Contoh: 10 poin per Kg

        // Update status dan poin
        $update_query = "UPDATE status_penerimaan_sampah SET status = 'selesai', poin = ? WHERE id = ?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param("ii", $poin, $id);

        if ($stmt_update->execute()) {
            echo "<script>alert('Data berhasil diverifikasi!'); window.location='status_penerimaan.php';</script>";
        } else {
            echo "<script>alert('Gagal memverifikasi data.'); window.location='status_penerimaan.php';</script>";
        }
    }
} else {
    echo "<script>alert('ID tidak valid.'); window.location='status_penerimaan.php';</script>";
}
?>
