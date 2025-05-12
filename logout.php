<?php
require_once __DIR__ . '/app/vendor/autoload.php';

use App\Controllers\AuthController;

$authController = new AuthController();
$authController->logout();

header('Location: /login.php');
exit;