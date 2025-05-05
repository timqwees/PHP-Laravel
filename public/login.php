<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

if (isset($_SESSION['user'])) {
 header('Location: /search/account');
 exit();
}

$authController = new AuthController();

try {
 $_POST['mail'] = 'login';
 $_POST['password'] = 'login';
 $authController->onLogin();
} catch (\Exception $e) {
 echo $e->getMessage();
}

// Определяем, какую форму показывать
$showRegister = isset($_GET['form']) && $_GET['form'] === 'register';
//HTML
include __DIR__ . '/view/auth.html';
?>