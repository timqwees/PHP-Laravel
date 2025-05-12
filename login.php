<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\AuthController;
use App\Models\Network\Network;

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Если пользователь уже авторизован, перенаправляем на личный кабинет
if (isset($_SESSION['user']['id'])) {
  Network::onRedirect('/contractorPA.php');
  exit;
}

$authController = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail']) && isset($_POST['password'])) {
  $authController->onLogin();
}

//HTML
include __DIR__ . '/viewHTML/login.html';
?>