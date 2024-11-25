<?php
include 'config.php'; // Memasukkan file koneksi database

// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $jenis_sampah = $_POST['jenis_sampah'];
    $kategori_detail = $_POST['kategori_detail'];
    $berat = $_POST['berat'];

    // Validasi input
    if (!empty($email) && !empty($jenis_sampah) && !empty($kategori_detail) && $berat > 0) {
        // Query untuk memasukkan data ke tabel
        $query = "INSERT INTO penerimaan_sampah (email, jenis_sampah, kategori_detail, berat)
                  VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssd", $email, $jenis_sampah, $kategori_detail, $berat);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='input_penerimaan.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data.');</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua kolom dengan benar.');</script>";
    }
}
?>

// ini hanya untuk saya mencoba menampilkan nya
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Penerimaan Sampah</title>
    <link rel="stylesheet" href="styles.css"> <!-- File CSS -->
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1>Input Data Penerimaan Sampah</h1>
            <form action="" method="POST">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email user" required>

                <label>Jenis Sampah</label>
                <select name="jenis_sampah" required>
                    <option value="">Pilih Jenis Sampah</option>
                    <option value="Plastik">Plastik</option>
                    <option value="Kertas">Kertas</option>
                    <option value="Logam">Logam</option>
                </select>

                <label>Kategori Detail</label>
                <select name="kategori_detail" required>
                    <option value="">Pilih Kategori Detail</option>
                    <option value="Botol Plastik">Botol Plastik</option>
                    <option value="Kardus">Kardus</option>
                    <option value="Kaleng">Kaleng</option>
                </select>

                <label>Berat Sampah (kg)</label>
                <input type="number" name="berat" step="0.1" min="0" placeholder="0" required>

                <button type="submit" class="btn-submit">Kirim Data Penerimaan</button>
            </form>
        </div>
    </div>
</body>
</html>
