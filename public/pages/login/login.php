<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Models\Network\Network;
use App\Models\Network\Message;
// Инициализируем сессию
Network::init();

if (isset($_SESSION['user'])) {
 Network::onRedirect(Network::$path_account);
 exit();
}

$message = Message::controll();

$authController = new AuthController();

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 try {
  $authController->onLogin();
 } catch (\Exception $e) {
  Message::set('error', $e->getMessage());
 }
}

//HTML
include __DIR__ . '/view/auth.html';
?>