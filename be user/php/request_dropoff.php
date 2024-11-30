<?php
session_start();
include('../db/db_connection.php');

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: php/signin.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil daftar region dari tabel bank_locations
$regionQuery = "SELECT DISTINCT region FROM bank_locations";
$regions = mysqli_query($conn, $regionQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bank_id']) && !empty($_POST['bank_id'])) {
    $bank_id = $_POST['bank_id'];

    // Insert drop off request into drop_off_request table
    $insertQuery = "INSERT INTO drop_off_request (user_id, bank_id, drop_off_request_created_at, drop_off_request_updated_at) 
                    VALUES ('$user_id', '$bank_id', NOW(), NOW())";
    
    if (mysqli_query($conn, $insertQuery)) {
        $_SESSION['message'] = "Request for drop-off created successfully!";
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['error'] = "Error creating drop-off request.";
    }
}
?>

<h2>Request Drop-off</h2>

<?php
// Display success or error message if set
if (isset($_SESSION['message'])) {
    echo "<p style='color: green;'>".$_SESSION['message']."</p>";
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo "<p style='color: red;'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}
?>

<form method="POST" action="request_dropoff.php">
    <label for="region">Select Region:</label>
    <select id="region" name="region" onchange="loadBanks(this.value)">
        <option value="">-- Select Region --</option>
        <?php while ($region = mysqli_fetch_assoc($regions)): ?>
            <option value="<?= $region['region'] ?>"><?= $region['region'] ?></option>
        <?php endwhile; ?>
    </select>

    <div id="banks-container">
        <!-- Banks will be loaded here based on region selection -->
    </div>

    <button type="submit">Request Drop-off</button>
</form>

<script>
// Function to load banks based on selected region
function loadBanks(region) {
    if (region === "") {
        document.getElementById("banks-container").innerHTML = "";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "load_banks.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("banks-container").innerHTML = xhr.responseText;
        }
    };
    xhr.send("region=" + region);
}
</script>
