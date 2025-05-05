<?php

namespace App\Models\Router;

use App\Models\Network\Network;

class Routes extends Network
{
 //### SETTING ROUTES ###

 private static $routes = [
  'GET' => [],
  'POST' => []
 ];

 public function __construct()
 {
  echo '<script>console.log("TimQwees_CorePro - onEnable");</script>';
 }

 public static function get($path, $callback)
 {
  self::$routes['GET'][$path] = $callback;
 }

 public static function post($path, $callback)
 {
  self::$routes['POST'][$path] = $callback;
 }

 public static function dispatch()
 {
  $method = $_SERVER['REQUEST_METHOD'];
  $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

  // Удаляем /
  $path = rtrim($path, '/');
  if (empty($path)) {
   $path = '/';
  }

  if (isset(self::$routes[$method][$path])) {
   $callback = self::$routes[$method][$path];

   if (is_callable($callback)) {
    return call_user_func($callback);
   }

   if (is_array($callback)) {
    [$controller, $action] = $callback;
    $controllerInstance = new $controller();
    return $controllerInstance->$action();
   }
  }

  // Если маршрут не найден, показываем 404
  self::error_404($path);
 }

 //### ROUTES PAGE ###

 public static function error_404(string $path)
 {
  include dirname(__DIR__, 2) . '/Models/Router/view/404/404.html';
  exit();
 }

 public static function on_Main()
 {
  include dirname(__DIR__, 3) . '/public/login.php';
  exit();
 }
 public static function on_Login()
 {
  include dirname(__DIR__, 3) . '/public/login.php';
  exit();
 }
 public static function on_Regist()
 {
  include dirname(__DIR__, 3) . '/public/regist.php';
  exit();
 }

 public static function on_Account()
 {
  include dirname(__DIR__, 3) . '/public/index.php';
  exit();
 }
}