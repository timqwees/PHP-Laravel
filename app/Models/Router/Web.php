<?php

namespace App\Models\Router;

class Web
{
 public function __construct()
 {
  echo '<script>console.log("TimQwees_CorePro - onEnable");</script>';
 }

 public function error_404(string $patch)
 {
  include dirname(__DIR__, 2) . '/Models/Router/view/404/404.html';//2 уровень APP
  exit();
 }

 public function on_Main()
 {
  include dirname(__DIR__, 3) . '/public/login.php';
  exit();
 }
}