<?php
session_start();
require_once '../classes/user.php';

if(isset($_POST['signup'])){
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
        echo 'cha3ban3: ' . $e->getMessage();
    }
}
if (isset($_POST['login'])) {
    try {
        $user = User::signin($_POST['email'], $_POST['password']);
        
        if ($user->getStatus() === 'waiting') {
            $_SESSION['message'] = [
                'type' => 'info',
                'text' => 'Your account is pending approval. Please contact support.'
            ];
        } elseif ($user->getStatus() === 'active') {
            if($user->getrole() == 1){
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Welcome Admin!'
                ];
            }
            if($user->getrole() == 2){
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Welcome Instructor!'
                ];
            }
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Welcome back!'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Your account is not active. Please contact support.'
            ];
        }

    } catch (Exception $e) {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => $e->getMessage()
        ];
    }
}

user::logOut();
$_SESSION['message'] = [
    'type' => 'success',
    'text' => 'You have successfully logged out.'
];


?>