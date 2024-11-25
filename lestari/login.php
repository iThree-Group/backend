<?php
session_start();

// Koneksi ke database
$host = "localhost"; // Ganti sesuai konfigurasi Anda
$user = "root";      // Username database
$password = "";      // Password database
$dbname = "lestari"; // Nama database

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($email) || empty($password)) {
        echo "Email dan password harus diisi!";
        exit;
    }

    // Hashing password check (jika password disimpan dalam bentuk hash)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) { // Jika menggunakan `password_hash` untuk hashing
            $_SESSION['user'] = $user;
            header("Location: dashboard.php"); // Redirect ke dashboard
            exit;
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Email tidak ditemukan!";
    }

    $stmt->close();
}

$conn->close();
?>
