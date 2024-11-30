<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to sign-in page if not logged in
    header("Location: php/signin.php"); // Adjust path as needed
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="./css/styles.css" rel="stylesheet">
  <title>Landing Page - Lestari</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'poppins': ['Poppins', 'sans-serif']
          }
        }
      }
    };
  </script>
  <style>
    .hero1 {
      background-color: #0e7e32;
      color: white;
      text-align: center;
      padding: 50px 20px;
      border-radius: 20px;
      margin: 0 auto;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 800px;
    }

    .hero1 img {
      width: 100px;
      margin-bottom: 20px;
    }

    .hero1 h1 {
      margin: 10px 0;
      font-size: 32px;
      font-weight: bold;
    }

    .hero1 p {
      margin: 10px 0 20px;
      font-size: 18px;
    }

    .hero1 button {
      background-color: #007f3d;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s ease;
    }

    .hero1 button:hover {
      background-color: #005f2c;
    }
  </style>
</head>
<body class="font-poppins">
  <!-- NAVBAR -->
  <div class="navbar bg-light h-[92px] pr-[41px] justify-between">
    <!-- MOBILE SCREEN MODE -->
    <div class="navbar-start pl-[41px]">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h8m-8 6h16" />
          </svg>
        </div>
        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
          <li><a>Item 1</a></li>
          <li>
            <a>Parent</a>
            <ul class="p-2">
              <li><a>Submenu 1</a></li>
              <li><a>Submenu 2</a></li>
            </ul>
          </li>
          <li><a>Item 3</a></li>
        </ul>
      </div>
      <!-- BRAND LOGO -->
      <a href="." class="">
        <img src="./images/Logo.png" alt="Logo Lestari">
      </a>
    </div>
    <!-- DESKTOP MODE -->
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal px-1 text-dark text-base">
        <li><a>Home</a></li>
        <li><a href="./user/tentang.php">Tentang kami</a></li>
        <li>
          <details>
            <summary>Layanan</summary>
            <ul class="bg-light absolute left-1/2 transform -translate-x-1/2 rounded-[10px] border-[1px] shadow-[0px_4px_4px_-0px_rgba(0,0,0,0.25)] border-gray px-[14px] py-[20px] flex-wrap flex items-center gap-[11px] min-w-[475px] h-[144px]">
              <li><button class="btn btn-success w-[142px] shadow-[0px_4px_4px_-0px_rgba(0,0,0,0.25)] rounded-[20px] flex px-2.5 content-center text-light text-base font-medium gap-[10px]">
                <img src="./images/truck.png" class="w-10" alt="">
                <p>Drop Off</p>
              </button></li>
              <li><button class="btn btn-success w-[142px] shadow-[0px_4px_4px_-0px_rgba(0,0,0,0.25)] rounded-[20px] flex px-2.5 content-center text-light text-base font-medium gap-[5px]">
                <img src="./images/reward.png" class="w-10" alt="">
                <p>Rewards</p>
              </button></li>
              <li><button class="btn btn-success w-[142px] shadow-[0px_4px_4px_-0px_rgba(0,0,0,0.25)] rounded-[20px] flex px-2.5 content-center text-light text-base font-medium gap-2">
                <img src="./images/Vector.png" class="w-8" alt="">
                <p>Tutorial</p>
              </button></li>
              <li><button class="btn btn-success w-[171px] shadow-[0px_4px_4px_-0px_rgba(0,0,0,0.25)] rounded-[20px] flex px-2.5 content-center text-light text-base font-medium gap-[6px]">
                <img src="./images/marketplace.png" class="w-10" alt="">
                <p>Marketplace</p>
              </button></li>
            </ul>
          </details>
        </li>
        <li><a>Blog</a></li>
        <li><a>Kontak Kami</a></li>
      </ul>
    </div>
  </div>
  <!-- NAVBAR END -->

  <!-- Hero Section -->
  <section class="py-16 bg-gray-100">
    <div class="hero1">
      <img src="https://via.placeholder.com/100" alt="Truck Icon">
      <h1>Drop Off</h1>
      <p>Antar Langsung Sampahmu ke Bank Sampah Terdekat</p>
      <button onclick="window.location.href='./bank_location.php';">Lihat Lokasi</button>

    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-green to-dark-green text-white py-20">
    <div class="container mx-auto px-4 text-center">
      <div class="flex justify-center">
        <a href="./landingpage.php">
          <img src="./images/Logo.png" alt="Logo Lestari" class="h-20">
        </a>
      </div>
      <p class="mb-4 mt-4">&copy; 2024 LESTARI. All Rights Reserved.</p>
      <div class="space-x-4">
        <a href="#" class="text-white hover:underline">Instagram</a>
        <a href="#" class="text-white hover:underline">Facebook</a>
        <a href="#" class="text-white hover:underline">Twitter</a>
        <a href="#" class="text-white hover:underline">YouTube</a>
      </div>
    </div>
  </footer>
</body>
</html>