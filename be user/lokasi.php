<?php
// Mulai sesi untuk memastikan pengguna login
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: php/signin.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sampah_2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Ambil data lokasi bank sampah dari database
$bank_id = isset($_GET['bank_id']) ? $conn->real_escape_string($_GET['bank_id']) : '';
if (empty($bank_id)) {
    echo "Bank Sampah tidak ditemukan.";
    exit();
}

// Query database untuk mengambil detail lokasi bank berdasarkan `bank_id`
$sql = "SELECT bank_name, bank_address, bank_operating_hours, kecamatan, kelurahan
        FROM bank_locations
        WHERE bank_id = '$bank_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $bank = $result->fetch_assoc();
} else {
    echo "Detail Bank Sampah tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lestari Drop Off</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }
        header nav a {
            text-decoration: none;
            color: #000;
            margin: 0 15px;
            font-weight: bold;
        }
        header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
        }
        .drop-off-header {
            background-color: #007f3e;
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            font-size: 24px;
            font-weight: bold;
        }
        .drop-off-header img {
            vertical-align: middle;
            margin-right: 10px;
        }
        .drop-off-card {
            
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .drop-off-card h2 {
            color: #007f3e;
            font-size: 20px;
            margin: 0;
        }
        .drop-off-card p {
            margin: 5px 0;
            color: #333;
        }
        .drop-off-card .open-time {
            font-weight: bold;
            margin-top: 10px;
        }
        .drop-off-card .drop-off-button {
            display: inline-block;
            background-color: #007f3e;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 20px;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
        }
        .drop-off-card .drop-off-button img {
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1 style="color: #007f3e;">LESTARI</h1>
        </div>
        <nav>
            <a href="#">Home</a>
            <a href="#">Tentang Kami</a>
            <a href="#">Layanan</a>
            <a href="#">Blog</a>
            <a href="#">Kontak Kami</a>
        </nav>
        <img src="user-profile.jpg" alt="Profile">
    </header>

    <div class="container">
        <div class="drop-off-header">
            <img src="recycle-icon.png" alt="Recycle Icon" width="30"> Drop Off
        </div>
        <div class="drop-off-card">
            <h2><?php echo htmlspecialchars($bank['bank_name']); ?></h2>
            <p><?php echo htmlspecialchars($bank['bank_address']); ?></p>
            <p><strong>Kecamatan:</strong> <?php echo htmlspecialchars($bank['kecamatan']); ?></p>
            <p><strong>Kelurahan:</strong> <?php echo htmlspecialchars($bank['kelurahan']); ?></p>
            <p class="open-time">Buka: <?php echo htmlspecialchars($bank['bank_operating_hours']); ?></p>
            <a href="#" class="drop-off-button">
                <img src="recycle-icon.png" alt="Recycle Icon" width="20"> Drop Off
            </a>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
