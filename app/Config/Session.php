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

namespace App\Config;

class Session
{
 /**
  * @return [type]
  * 
  * @example Session::init();
  * @description инициализирует сессию и устанавливает параметры / initialize session and set parameters
  * 
  */
 public static function init()
 {
  if (session_status() === PHP_SESSION_NONE) {
   // Устанавливаем параметры сессии
   session_set_cookie_params([
    'lifetime' => 86400, // 24 часа
    'path' => '/',//путь к сессии
    'domain' => 'localhost',
    'secure' => true,//работает только на https (true)
    'httponly' => true,//защита от XSS атак (true)
    'samesite' => 'Lax'//защита от CSRF атак (Lax)
   ]);

   session_start();
  }
 }

 /**
  * @return [type]
  * 
  * @example Session::regenerate();
  * @description регенерирует сессию для защиты от атак / regenerate session for protection against attacks
  * требуеться во всех файлах, где требуеться запрос к данным пользователя
  * 
  */
 public static function regenerate()
 {
  if (session_status() === PHP_SESSION_ACTIVE) {
   session_regenerate_id(true);
  }
 }

 /**
  * @return [type]
  * 
  * @example Session::destroy();
  * @description уничтожает сессию / destroy session
  * 
  */
 public static function destroy()
 {
  if (session_status() === PHP_SESSION_ACTIVE) {
   $_SESSION = array();

   if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
   }

   session_destroy();
  }
 }
}