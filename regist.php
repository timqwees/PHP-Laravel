<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\AuthController;
use App\Models\Network\Network;

session_start();
if (isset($_SESSION['user'])) {
  Network::onRedirect('/contractorPA.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  (new AuthController())->onRegist();
}

//HTML
include __DIR__ . '/viewHTML/regist.html';
?>