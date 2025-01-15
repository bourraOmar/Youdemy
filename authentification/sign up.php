<?php

require_once '../classes/role.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!empty($_SESSION)) {
  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Education</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>

<body class="bg-gray-100">
  <!-- Preloader -->
  <div id="preloader-active" class="fixed inset-0 w-full h-full bg-white flex items-center justify-center z-50">
    <div class="preloader-inner relative">
      <div class="preloader-circle animate-spin rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
      <div class="preloader-img absolute inset-0 flex justify-center items-center">
        <img src="assets/img/logo/loder.png" alt="Loading..." class="h-8">
      </div>
    </div>
  </div>

  <!-- Header -->
  <header class="bg-white shadow-lg sticky top-0 z-40">
    <div class="container mx-auto px-6 py-4">
      <div class="flex items-center justify-between">
        <div class="logo">
          <a href="index.html"><img src="assets/img/logo/logo.png" alt="Logo" class="h-8"></a>
        </div>
        <nav class="hidden md:flex space-x-8 items-center">
          <a href="index.html" class="text-gray-700 hover:text-blue-500 transition duration-300">Home</a>
          <a href="courses.html" class="text-gray-700 hover:text-blue-500 transition duration-300">Courses</a>
          <a href="about.html" class="text-gray-700 hover:text-blue-500 transition duration-300">About</a>
          <a href="#" class="text-gray-700 hover:text-blue-500 transition duration-300">Blog</a>
          <a href="contact.html" class="text-gray-700 hover:text-blue-500 transition duration-300">Contact</a>
          <a href="../authentification/sign up.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Join</a>
          <a href="../authentification/login.php" class="bg-transparent border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-500 hover:text-white transition duration-300">Log in</a>
        </nav>
        <div class="md:hidden">
          <button class="mobile-menu-button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-500 to-blue-600 text-white py-24">
      <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-bold mb-4 animate__animated animate__fadeInDown">Create Your Account</h1>
        <p class="text-xl mb-8 animate__animated animate__fadeInUp">Join our community and start learning today.</p>
      </div>
    </section>

    <!-- Sign Up Form Section -->
    <section class="container mx-auto px-6 py-16">
      <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300 animate__animated animate__fadeInUp">
        <h2 class="text-3xl font-bold mb-8 text-center">Sign Up</h2>
        <form class="space-y-6" mthode="post">
          <div>
            <label for="name" class="block text-gray-700 mb-2">Full Name</label>
            <input type="text" name="name" placeholder="Enter your full name" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
          </div>
          <div>
            <label for="email" class="block text-gray-700 mb-2">Email</label>
            <input type="email" name="email" placeholder="Enter your email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="Roleselect" type="email" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none">
              <?php
              $rows = role::getallroles();
              foreach ($rows as $row) {
                echo "<option value='" . $row['role_id'] . "'>" . $row['title'] . "</option>";
              } ?>
            </select>
          </div>
          <div>
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" id="password" placeholder="Enter your password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
          </div>
          <div>
            <label for="confirm-password" class="block text-gray-700 mb-2">Confirm Password</label>
            <input type="password" id="confirm-password" placeholder="Confirm your password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="terms" class="mr-2">
            <label for="terms" class="text-gray-700">I agree to the <a href="#" class="text-blue-500 hover:text-blue-600">terms and conditions</a></label>
          </div>
          <button type="submit" class="w-full bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition duration-300">Sign Up</button>
        </form>
        <div class="mt-6 text-center">
          <p class="text-gray-600">Already have an account? <a href="login.html" class="text-blue-500 hover:text-blue-600">Log in</a></p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <img src="assets/img/logo/logo2_footer.png" alt="Footer Logo" class="mb-4">
          <p class="text-gray-400">The automated process starts as soon as your clothes go into the machine.</p>
          <div class="flex space-x-4 mt-4">
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-pinterest-p"></i></a>
          </div>
        </div>
        <div>
          <h4 class="text-lg font-bold mb-4">Our Solutions</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">Design & Creatives</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Telecommunication</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Restaurant</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Programing</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Architecture</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-bold mb-4">Support</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">Design & Creatives</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Telecommunication</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Restaurant</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Programing</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Architecture</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-bold mb-4">Company</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">Design & Creatives</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Telecommunication</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Restaurant</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Programing</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Architecture</a></li>
          </ul>
        </div>
      </div>
      <div class="border-t border-gray-700 mt-8 pt-8 text-center">
        <p class="text-gray-400">© 2023 All rights reserved | This template is made with <i class="fa fa-heart text-red-500"></i> by <a href="https://colorlib.com" class="text-blue-500 hover:text-blue-400">Colorlib</a></p>
      </div>
    </div>
  </footer>

  <!-- Scroll Up Button -->
  <div id="back-top" class="fixed bottom-4 right-4">
    <a href="#" class="bg-blue-500 text-white p-3 rounded-full shadow-lg hover:bg-blue-600 transition duration-300">
      <i class="fas fa-level-up-alt"></i>
    </a>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
  <script>
    // Preloader
    window.addEventListener('load', function() {
      document.getElementById('preloader-active').style.display = 'none';
    });

    // Mobile Menu
    document.querySelector('.mobile-menu-button').addEventListener('click', function() {
      document.querySelector('nav').classList.toggle('hidden');
    });
  </script>
</body>

</html>

<?php

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  $type = $message['type'];
  $text = $message['text'];

  echo "
        <script>
            Swal.fire({
                icon: '$type',
                title: '$type',
                text: '$text',
                confirmButtonText: 'OK'
            });
        </script>
    ";

  unset($_SESSION['message']);
}
?>