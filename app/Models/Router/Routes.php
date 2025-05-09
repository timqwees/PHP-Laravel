<?php
/**
 * 
 *  _____                                                                                _____ 
 * ( ___ )                                                                              ( ___ )
 *  |   |~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|   | 
 *  |   |                                                                                |   | 
 *  |   |                                                                                |   | 
 *  |   |    ________  ___       __   _______   _______   ________                       |   | 
 *  |   |   |\   __  \|\  \     |\  \|\  ___ \ |\  ___ \ |\   ____\                      |   | 
 *  |   |   \ \  \|\  \ \  \    \ \  \ \   __/|\ \   __/|\ \  \___|_                     |   | 
 *  |   |    \ \  \\\  \ \  \  __\ \  \ \  \_|/_\ \  \_|/_\ \_____  \                    |   | 
 *  |   |     \ \  \\\  \ \  \|\__\_\  \ \  \_|\ \ \  \_|\ \|____|\  \                   |   | 
 *  |   |      \ \_____  \ \____________\ \_______\ \_______\____\_\  \                  |   | 
 *  |   |       \|___| \__\|____________|\|_______|\|_______|\_________\                 |   | 
 *  |   |             \|__|                                 \|_________|                 |   | 
 *  |   |    ________  ________  ________  _______   ________  ________  ________        |   | 
 *  |   |   |\   ____\|\   __  \|\   __  \|\  ___ \ |\   __  \|\   __  \|\   __  \       |   | 
 *  |   |   \ \  \___|\ \  \|\  \ \  \|\  \ \   __/|\ \  \|\  \ \  \|\  \ \  \|\  \      |   | 
 *  |   |    \ \  \    \ \  \\\  \ \   _  _\ \  \_|/_\ \   ____\ \   _  _\ \  \\\  \     |   | 
 *  |   |     \ \  \____\ \  \\\  \ \  \\  \\ \  \_|\ \ \  \___|\ \  \\  \\ \  \\\  \    |   | 
 *  |   |      \ \_______\ \_______\ \__\\ _\\ \_______\ \__\    \ \__\\ _\\ \_______\   |   | 
 *  |   |       \|_______|\|_______|\|__|\|__|\|_______|\|__|     \|__|\|__|\|_______|   |   | 
 *  |   |                                                                                |   | 
 *  |   |                                                                                |   | 
 *  |___|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|___| 
 * (_____)                                                                              (_____)
 * 
 * Эта программа является свободным программным обеспечением: вы можете распространять ее и/или модифицировать
 * в соответствии с условиями GNU General Public License, опубликованными
 * Фондом свободного программного обеспечения (Free Software Foundation), либо в версии 3 Лицензии, либо (по вашему выбору) в любой более поздней версии.
 *
 * @author TimQwees
 * @link https://github.com/TimQwees/Qwees_CorePro
 * 
 */

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
  // echo '<script>console.log("TimQwees_CorePro - onEnable");</script>';
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
  include dirname(__DIR__, 3) . '/public/pages/login/login.php';
  exit();
 }
 public static function on_Login()
 {
  include dirname(__DIR__, 3) . '/public/pages/login/login.php';
  exit();
 }
 public static function on_Regist()
 {
  include dirname(__DIR__, 3) . '/public/pages/regist/regist.php';
  exit();
 }

 public static function on_Account()
 {
  include dirname(__DIR__, 3) . '/public/pages/account/index.php';
  exit();
 }

 public static function on_Blogs()
 {
  include dirname(__DIR__, 3) . '/public/pages/account/blogs.php';
  exit();
 }

 public static function on_Setting()
 {
  include dirname(__DIR__, 3) . '/public/pages/account/setting.php';
  exit();
 }

 public static function on_Logout()
 {
  include dirname(__DIR__, 3) . '/public/pages/logout/logout.php';
  exit();
 }
}