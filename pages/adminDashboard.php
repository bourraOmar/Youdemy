<?php
require_once '../classes/admin.php';
require_once '../classes/category.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>YouDemy | Admin Dashboard</title>
    <style>
        .bg-primary {
            background-color:rgb(57, 75, 237);
        }

        .modal.active {
            display: flex;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

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
                    <a href="../Youdemy/index.php"><img src="assets/img/logo/logo.png" alt="Logo" class="h-8"></a>
                </div>
                <nav class="hidden md:flex space-x-8 items-center">
                    <span class="text-gray-600">Admin Panel</span>
                    <a href="../Handling/AuthHandl.php">
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Déconnexion</button></a>

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

    <!-- Main Content -->
    <div class="p-8 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-8">Statistics Overview</h1>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Total Users</h3>
                <p class="text-3xl font-bold">15,234</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Total Courses</h3>
                <p class="text-3xl font-bold">456</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Total Revenue</h3>
                <p class="text-3xl font-bold">$123,456</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Active Instructors</h3>
                <p class="text-3xl font-bold">89</p>
            </div>
        </div>

        <div class="mb-6 flex space-x-4">
            <button onclick="openModal('addCategoryModal')" class="bg-primary px-4 py-2 rounded-lg hover:bg-blue-500 flex items-center text-white">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Category
            </button>
        </div>

        <!-- Category Table -->
        <div class="bg-white rounded-lg shadow-md mt-6 mb-6">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Categories Management</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        $rows = Category::showCategories();
                        foreach ($rows as $row) {
                        ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-gray-900 pr-28"><?php echo $row['category_id'] ?></td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900 pr-20"><?php echo $row['name'] ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-6">
                                        <button class="text-green-600 hover:text-green-800 transition-colors duration-200">Edit</button>
                                        <button class="text-red-600 hover:text-red-800 transition-colors duration-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <h2 class="text-xl font-bold mb-4">Recent Users</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-500">
                            <th class="pb-4">User</th>
                            <th class="pb-4">Role</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4">Actions</th>
                        </tr>
                    </thead>
                    <?php
                    $users = Admin::getallusers();
                    foreach ($users as $user) {
                    ?>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-4"><?php echo $user['prenom'] . " " . $user['nom'] ?></td>
                                <td><?php echo $user['name'] ?></td>
                                <?php if ($user['status'] === 'waiting') { ?>
                                    <td><span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-sm"><?php echo $user['status'] ?></span></td>
                                <?php } else if ($user['status'] === 'active') { ?>
                                    <td><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm"><?php echo $user['status'] ?></span></td>
                                <?php } else if ($user['status'] === 'suspended') { ?>
                                    <td><span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm"><?php echo $user['status'] ?></span></td>
                                <?php } ?>
                                <td>
                                    <div class="flex gap-3">
                                        <form action="../Handling/userHandl.php" method="post">
                                            <input type="hidden" name="action" value="active">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <button type="submit" class="text-green-600 hover:text-green-800">Approve</button>
                                        </form>
                                        <form action="../Handling/userHandl.php" method="post">
                                            <input type="hidden" name="action" value="suspended">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <button type="submit" class="text-red-600 hover:text-red-800">Ban</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-xl font-bold mb-4">Recent Reports</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b pb-4">
                    <div>
                        <p class="font-semibold">Content Report</p>
                        <p class="text-gray-500">Report on "JavaScript Basics" course</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="bg-red-100 text-red-600 px-3 py-1 rounded-md">Review</button>
                        <span class="text-gray-400">2 hours ago</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold">Payment Issue</p>
                        <p class="text-gray-500">Failed payment for course enrollment</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-md">Pending</button>
                        <span class="text-gray-400">5 hours ago</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal z-50">
        <div class="bg-white rounded-lg w-1/3 mx-auto my-auto p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Add New Category</h3>
                <button onclick="closeModal('addCategoryModal')" class="text-gray-500 hover:text-gray-700">×</button>
            </div>
            <form class="space-y-4" method="POST" action="../Handling/categoryHandl.php">
                <div>
                    <label class="block text-sm font-medium mb-1">Category Name</label>
                    <input type="text" name="cat_name" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('addCategoryModal')" class="px-4 py-2 border rounded-lg">Cancel</button>
                    <button type="submit" name="Category_submit" class="px-4 py-2 text-white bg-primary rounded-lg">Add Category</button>
                </div>
            </form>
        </div>
    </div>


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
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
    </script>
</body>

</html>