<?php
include('../php/db_connection.php');

// Cek apakah ada parameter 'region' yang dikirimkan menggunakan POST
if (isset($_POST['region']) && !empty($_POST['region'])) {
    $region = mysqli_real_escape_string($conn, $_POST['region']);

    // Query untuk mengambil data bank sampah berdasarkan region
    $query = "SELECT * FROM bank_locations WHERE region = '$region'";
    $result = mysqli_query($conn, $query);
    
    // Memeriksa apakah ada bank sampah yang ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Mengembalikan data bank sampah dalam format HTML
        while ($bank = mysqli_fetch_assoc($result)) {
            echo '<input type="radio" name="bank_id" value="' . $bank['bank_id'] . '" id="bank_' . $bank['bank_id'] . '">';
            echo '<label for="bank_' . $bank['bank_id'] . '">' . $bank['bank_name'] . ' (' . $bank['bank_address'] . ')</label><br>';
        }
    } else {
        echo 'No banks found in this region.';
    }
} else {
    echo 'Invalid region.';
}
?>
