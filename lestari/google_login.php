<?php
require_once 'vendor/autoload.php';

// Konfigurasi Google Client
$client = new Google_Client();
$client->setClientId('129836007956-8ev2qo17o6128aq6ucjnu44g86vtfmlu.apps.googleusercontent.com'); // Ganti dengan Client ID Anda
$client->setClientSecret('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'); // Ganti dengan Client Secret Anda
$client->setRedirectUri('http://localhost/lestari'); // Ganti sesuai konfigurasi redirect URI
$client->addScope('email');
$client->addScope('profile');

// Jika tidak ada kode, arahkan ke URL login Google
if (!isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
    // Tukar kode dengan akses token
    $client->authenticate($_GET['code']);
    $token = $client->getAccessToken();
    $client->setAccessToken($token);

    // Ambil informasi pengguna
    $google_service = new Google_Service_Oauth2($client);
    $user_info = $google_service->userinfo->get();

    // Tampilkan data pengguna
    echo "Name: " . $user_info->name . "<br>";
    echo "Email: " . $user_info->email . "<br>";
    echo "Picture: <img src='" . $user_info->picture . "'><br>";
}
?>
