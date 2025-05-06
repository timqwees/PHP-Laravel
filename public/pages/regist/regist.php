<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Models\Network\Network;
use App\Models\Network\Message;

if (isset($_SESSION['user'])) {
 Network::onRedirect(Network::$path_account);
 exit();
}

$authController = new AuthController();

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 try {
  $authController->onRegist();
 } catch (\Exception $e) {
  $_SESSION['error'] = $e->getMessage();
 }
}

$message = Message::controll();

//HTML
include __DIR__ . '/view/regist.html';
?>