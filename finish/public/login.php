<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

session_start();
if (isset($_SESSION['user'])) {
    header('Location: /public/index.php');
    exit;
}

$authController = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'login') {
            $authController->onLogin();
        } elseif ($_POST['action'] === 'register') {
            $authController->onRegist();
        }
    }
}

// Определяем, какую форму показывать
$showRegister = isset($_GET['form']) && $_GET['form'] === 'register';

//HTML
include __DIR__ . '/view/auth.html';
?>