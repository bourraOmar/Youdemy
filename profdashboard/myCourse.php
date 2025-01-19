<?php
require_once '../classes/category.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 2) {
    header('Location: ../index.php');
    exit();
}

if ($_SESSION['user_status'] === 'waiting') {
    header("Location: ../pages/statusPending.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>My Courses | Education</title>
    <style>
        .preloader-circle {
            border-top-color: #F97316;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-orange-50 to-teal-50 font-sans">

    <!-- Preloader -->
    <div id="preloader-active" class="fixed inset-0 w-full h-full bg-white flex items-center justify-center z-50">
        <div class="preloader-inner relative">
            <div class="preloader-circle animate-spin rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
            <div class="preloader-img absolute inset-0 flex justify-center items-center">
                <img src="../assets/img/logo/loder.png" alt="Loading..." class="h-8">
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-gradient-to-r from-teal-500 to-orange-500 shadow-lg sticky top-0 z-40">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="logo">
                    <a href="../Youdemy/index.php"><img src="../assets/img/logo/logo.png" alt="Logo" class="h-8"></a>
                </div>
                <nav class="hidden md:flex space-x-8 items-center">
                    <a href="../profdashboard/dashboardTeacher.php" class="text-gray-700 hover:text-teal-500 transition duration-300">Dashboard</a>
                    <a href="../profdashboard/createCours.php" class="text-gray-700 hover:text-teal-500 transition duration-300">Create Course</a>
                    <a href="../profdashboard/myCourse.php" class="text-gray-700 hover:text-teal-500 transition duration-300">My Courses</a>
                    <a href="../Handling/AuthHandl.php">
                        <button class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600">Logout</button>
                    </a>
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

    <div class="flex">
        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-teal-800">My Courses</h1>
                <div class="flex space-x-4">
                    <input type="text" placeholder="Search courses..." class="border p-2 rounded-md focus:ring-2 focus:ring-orange-500" />
                    <select class="border p-2 rounded-md focus:ring-2 focus:ring-orange-500">
                        <option>All Categories</option>
                        <?php
                        $rows = Category::showCategories();
                        foreach ($rows as $row) { ?>
                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['name'] ?></option>
                        <?php } ?>
                    </select>
                    <a href="../profdashboard/createCours.php" class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition duration-300">
                        Create New Course
                    </a>
                </div>
            </div>

            <!-- Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card 1 -->
                <?php
                $courses = Cours::showspecificsCours($_SESSION['user_id']);

                foreach ($courses as $cours) {
                    $counts = Cours::CountenrollCourses($cours->getId());
                ?>
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="<?php echo $cours->getcourseImage() ?>" alt="Course thumbnail" class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="font-semibold"><?php echo $cours->gettitle() ?></h3>
                            </div>
                            <div class="flex items-center mb-4">
                                <span class="text-gray-600"><?php echo $counts['enroll_Count']  ?> students</span>
                                <span class="text-gray-400 mx-2">•</span>
                                <?php  ?>
                                <span class="text-gray-600"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-purple-600 font-bold"><?php echo $cours->getprice() ?></span>
                                <div class="flex space-x-2">
                                    <a href="../Handling/editCourseHandling.php?id=<?php echo $cours->getId() ?>"><button class="text-blue-600 hover:text-blue-800">Edit</button></a>
                                    <a href="../Handling/deletecoursehandling.php?id=<?php echo $cours->getId() ?>"><button class="text-gray-600 hover:text-gray-800">Delete</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <img src="../assets/img/logo/logo2_footer.png" alt="Footer Logo" class="mb-4">
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
                        <li><a href="#" class="text-gray-400 hover:text-white">Programming</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Architecture</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Design & Creatives</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Telecommunication</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Restaurant</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Programming</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Architecture</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Design & Creatives</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Telecommunication</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Restaurant</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Programming</a></li>
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
        <a href="#" class="bg-teal-500 text-white p-3 rounded-full shadow-lg hover:bg-teal-600 transition duration-300">
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