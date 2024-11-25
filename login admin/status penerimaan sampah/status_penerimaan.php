<?php
include 'config.php'; // Koneksi ke database

// Filter data dari form
$status_filter = $_GET['status'] ?? 'Semua Status';
$jenis_filter = $_GET['jenis'] ?? 'Semua Jenis Sampah';
$tanggal_filter = $_GET['tanggal'] ?? '';

// Query untuk menampilkan data
$query = "SELECT * FROM status_penerimaan_sampah WHERE 1=1";

// Filter berdasarkan status
if ($status_filter !== 'Semua Status') {
    $query .= " AND status = '$status_filter'";
}

// Filter berdasarkan jenis sampah
if ($jenis_filter !== 'Semua Jenis Sampah') {
    $query .= " AND jenis_sampah = '$jenis_filter'";
}

// Filter berdasarkan tanggal
if (!empty($tanggal_filter)) {
    $query .= " AND tanggal = '$tanggal_filter'";
}

$result = $conn->query($query);
?>


// ini hanya untuk saya mencoba menampilkan nya
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Penerimaan Sampah</title>
    <link rel="stylesheet" href="styles.css"> <!-- Tambahkan CSS untuk styling -->
</head>
<body>
    <div class="container">
        <h1>Status Penerimaan Sampah</h1>

        <!-- Form Filter -->
        <form method="GET" action="">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="Semua Status">Semua Status</option>
                <option value="menunggu" <?= $status_filter === 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                <option value="selesai" <?= $status_filter === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="ditolak" <?= $status_filter === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
            </select>

            <label for="jenis">Jenis Sampah:</label>
            <select name="jenis" id="jenis">
                <option value="Semua Jenis Sampah">Semua Jenis Sampah</option>
                <option value="Plastik" <?= $jenis_filter === 'Plastik' ? 'selected' : '' ?>>Plastik</option>
                <option value="Kertas" <?= $jenis_filter === 'Kertas' ? 'selected' : '' ?>>Kertas</option>
                <option value="Logam" <?= $jenis_filter === 'Logam' ? 'selected' : '' ?>>Logam</option>
            </select>

            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" value="<?= $tanggal_filter ?>">

            <button type="submit">Filter</button>
        </form>

        <!-- Tabel Data -->
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Nama User</th>
                    <th>Jenis Sampah</th>
                    <th>Berat</th>
                    <th>Status</th>
                    <th>Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['tanggal']}</td>
                            <td>{$row['nama_user']}</td>
                            <td>{$row['jenis_sampah']}</td>
                            <td>{$row['berat']} Kg</td>
                            <td><span class='" . ($row['status'] == 'menunggu' ? 'status-menunggu' : ($row['status'] == 'selesai' ? 'status-selesai' : 'status-ditolak')) . "'>{$row['status']}</span></td>
                            <td>{$row['poin']}</td>
                            <td>";
                        if ($row['status'] == 'menunggu') {
                            echo "
                                <a href='verifikasi.php?id={$row['id']}' class='btn-verifikasi'>Verifikasi</a>
                                <a href='tolak.php?id={$row['id']}' class='btn-tolak'>Tolak</a>";
                        } else {
                            echo "-";
                        }
                        echo "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
