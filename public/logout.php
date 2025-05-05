<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

$authController = new AuthController();
$authController->logout(); 