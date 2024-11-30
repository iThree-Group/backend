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

// Ambil parameter region dari URL
$region = isset($_GET['region']) ? $conn->real_escape_string($_GET['region']) : '';

if (empty($region)) {
    echo "Wilayah tidak ditemukan.";
    exit();
}

// Query untuk mendapatkan detail bank sampah berdasarkan wilayah
$sql = "SELECT bank_id, bank_name, bank_address, bank_operating_hours 
        FROM bank_locations 
        WHERE region = '$region'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Bank Sampah - <?php echo htmlspecialchars($region); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Poppins', 'Arial', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-green-700 font-bold text-lg">LESTARI</a>
            <ul class="flex space-x-8 text-gray-700">
                <li><a href="#" class="hover:text-green-700">Home</a></li>
                <li><a href="#" class="hover:text-green-700">Tentang Kami</a></li>
                <li class="relative group">
                    <a href="#" class="hover:text-green-700">Layanan</a>
                    <ul class="absolute left-0 mt-2 w-40 bg-white shadow-lg hidden group-hover:block">
                        <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-green-100">Layanan 1</a></li>
                        <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-green-100">Layanan 2</a></li>
                    </ul>
                </li>
                <li><a href="#" class="hover:text-green-700">Blog</a></li>
                <li><a href="#" class="hover:text-green-700">Kontak Kami</a></li>
            </ul>
            <img src="https://via.placeholder.com/40" alt="User Avatar" class="rounded-full border w-10 h-10">
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-green-700 font-bold text-2xl mb-2">
                <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($region); ?>
            </h1>
        </div>

        <div class="bg-green-700 text-white text-center py-4 rounded-md mb-4">
            <h2 class="text-lg font-bold">
                <i class="fas fa-recycle"></i> Detail Bank Sampah
            </h2>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <p class="text-sm text-green-700 mb-6">
                <?php echo $result->num_rows; ?> bank sampah tersedia
            </p>

            <!-- Locations -->
            <div class="space-y-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <a href="lokasi.php?bank_id=<?php echo $row['bank_id']; ?>" class="block">
                        <div class="border rounded-md p-4 bg-white shadow hover:bg-green-100 transition">
                            <h3 class="font-bold text-lg text-green-700">
                                <?php echo htmlspecialchars($row['bank_name']); ?>
                            </h3>
                            <p class="text-gray-600">
                                <?php echo htmlspecialchars($row['bank_address']); ?>
                            </p>
                            <p class="text-gray-500 text-sm">
                                Jam Operasional: <?php echo htmlspecialchars($row['bank_operating_hours']); ?>
                            </p>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600">
                Tidak ada bank sampah di wilayah ini.
            </p>
        <?php endif; ?>

        <div class="text-center mt-8">
            <a href="lokasi_bank_sampah.php" class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600">
                Kembali
            </a>
        </div>
    </div>

    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>

<?php
$conn->close();
?>
