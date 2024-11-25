<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti jika menggunakan username lain
$password = ""; // Ganti jika menggunakan password lain
$dbname = "lestari";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses registrasi
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Validasi input
    if (empty($name) || empty($email) || empty($password) || empty($address) || empty($phone)) {
        echo "Semua field wajib diisi!";
    } else {
        // Simpan ke database
        $sql = "INSERT INTO users (name, email, password, address, phone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $password, $address, $phone);

        if ($stmt->execute()) {
            echo "Registrasi berhasil!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
