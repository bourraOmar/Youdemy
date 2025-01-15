<?php
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
    <title>Login Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation bar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <ul class="flex gap-9">
                    <a href="../index.php"><li>Home</li></a>
                    <a href="../pages/cours.php"><li>Cours</li></a>
                </ul>
                
                <div class="flex items-center space-x-4">
                <a href="../pages/login.php"><button class="text-purple-700 px-4 py-2 rounded-md">Login</button></a>
                <a href="../pages/sign_up.php"><button class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">sign up</button></a>
                </div>
                
            </div>
        </div>
    </nav>

    <main class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold">Welcome Back</h2>
                <p class="mt-2 text-gray-600">Please login to your account</p>
            </div>
            
            <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow" method="post" action="../Handling/AuthHandl.php">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                </div>

                <button type="submit" name="signinsubmit" class="w-full bg-primary py-2 px-4 border border-transparent rounded-md text-sm font-medium btn-hover focus:outline-none bg-purple-600 hover:bg-purple-700">
                    Log In
                </button>

                <div class="text-center text-sm text-gray-600">
                    Not registered yet? 
                    <a href="../pages/sign_up.php" class="font-medium text-purpel-600 hover:text-purpel-500">Create an account</a>
                </div>
            </form>
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
        </div>
    </main>
</body>
</html>



handler



<?php
session_start();

require_once '../classes/user.php';

if(isset($_POST['Createacc'])){
try{
    if($_POST['Roleselect'] == 3){
        User::signup($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['Roleselect'], $_POST['password'], 'Active');
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'Account created successfully! You can now login.'
        ];
        header('Location: ../pages/login.php');
        exit();
    } else {
        User::signup($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['Roleselect'], $_POST['password'], 'waiting');
        $_SESSION['message'] = [
            'type' => 'info',
            'text' => 'Account created successfully, but is awaiting approval.'
        ];
        header('Location: ../index.php');
        exit();
    }
} catch (Exception $e) {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'An unexpected error occurred. Please try again.'
        ];
        header('Location: ../pages/sign_up.php');
        exit();
    }
}

if (isset($_POST['signinsubmit'])) {
    try {
        $user = User::signin($_POST['email'], $_POST['password']);
        
        if ($user->getStatus() === 'waiting') {
            $_SESSION['message'] = [
                'type' => 'info',
                'text' => 'Your account is pending approval. Please contact support.'
            ];
            header('Location: ../pages/status_pending.php');
            exit;
        } elseif ($user->getStatus() === 'active') {
            if($user->getrole() == 1){
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Welcome Admin!'
                ];
                header('Location: ../pages/adminDashboard.php');
                exit();
            }
            if($user->getrole() == 2){
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Welcome Instructor!'
                ];
                header('Location: ../pages/prof_dashboard.php');
                exit();
            }
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Welcome back!'
            ];
            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Your account is not active. Please contact support.'
            ];
            header('Location: ../pages/status_banned.php');
            exit();
        }

    } catch (Exception $e) {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => $e->getMessage()
        ];
        header('Location: ../pages/login.php');
        exit();
    }
}

user::logOut();
$_SESSION['message'] = [
    'type' => 'success',
    'text' => 'You have successfully logged out.'
];
header('Location: ../index.php');
exit();


?>










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
    <title>Login Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation bar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <ul class="flex gap-9">
                    <a href="../index.php"><li>Home</li></a>
                    <a href="../pages/cours.php"><li>Cours</li></a>
                </ul>
                <div class="flex items-center space-x-4">
                <a href="../pages/login.php"><button class=" text-purple-700 px-4 py-2 rounded-md">Login</button></a>
                <a href="../pages/sign_up.php"><button class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">sign up</button></a>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold">Create Account</h2>
                <p class="mt-2 text-gray-600">Join us</p>
            </div>
            
            <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow" method="POST" action="../Handling/AuthHandl.php">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input name="prenom" type="text" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input name="nom" type="text" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input name="email" type="email" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="Roleselect" type="email" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none">
                    <?php
                        $rows = role::getallroles();
                        foreach($rows as $row){ 
                            echo "<option value='" . $row['role_id'] . "'>" . $row['name'] . "</option>";
                        } ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input name="password" type="password" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none">
                </div>

                <button name="Createacc"  type="submit" class="w-full bg-primary py-2 px-4 border border-transparent rounded-md text-sm font-medium btn-hover focus:outline-none bg-purple-600 hover:bg-purple-700">
                    Create Account
                </button>

                <div class="text-center text-sm text-gray-600">
                    Already have an account? 
                    <a href="../pages/login.php" class="font-medium text-purpel-600 hover:text-purpel-500">Log in</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
