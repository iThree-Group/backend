<?php
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validasi email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Periksa apakah email ada di database
        $query = "SELECT * FROM admin WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Jika email ditemukan, buat token reset password
            $token = bin2hex(random_bytes(32));
            $query_token = "INSERT INTO password_resets (email, token) VALUES (?, ?)";
            $stmt_token = $conn->prepare($query_token);
            $stmt_token->bind_param("ss", $email, $token);
            $stmt_token->execute();

            // URL untuk reset password
            $reset_url = "http://yourdomain.com/new_password.php?token=$token";

            // Kirim email ke pengguna (gunakan library seperti PHPMailer untuk pengiriman email)
            $subject = "Reset Password";
            $message = "Klik tautan berikut untuk mereset password Anda: $reset_url";
            $headers = "From: admin@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "<script>alert('Email reset password telah dikirim. Periksa inbox Anda.');</script>";
            } else {
                echo "<script>alert('Gagal mengirim email. Coba lagi nanti.');</script>";
            }
        } else {
            echo "<script>alert('Email tidak ditemukan.');</script>";
        }
    } else {
        echo "<script>alert('Masukkan email yang valid.');</script>";
    }
}
?>

