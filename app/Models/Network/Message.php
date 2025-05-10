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

namespace App\Models\Network;

class Message
{
 public static function set($type, $message)
 {
  $_SESSION['notification'] = [
   'type' => $type,
   'message' => $message
  ];
 }

 /**
  * @return [type]
  * 
  * @example Message::getAll();
  * @description возвращяем ответ сообщения и удаляем его из сессии / get message response and delete it from session
  * 
  */
 public static function getAll()
 {
  if (isset($_SESSION['notification'])) {
   $message = $_SESSION['notification'];//array
   unset($_SESSION['notification']);
   return $message;
  }
  return null;
 }

 //check isset $_SESSION['notification']
 /**
  * @return [type]
  * 
  * @example Message::has();
  * @description проверяет, существует ли $_SESSION['notification'] / check isset $_SESSION['notification']
  * 
  */
 public static function has()
 {
  return isset($_SESSION['notification']);
 }

 //return !isset $_SESSION['notification']
 /**
  * @return [type]
  * 
  * @example Message::null();
  * @description возвращает массив или null / return array or null
  * 
  */
 public static function null()
 {
  return ['type' => '', 'message' => ''];
 }

 // message  arrray or null
 /**
  * @return [type]
  * 
  * @example Message::controll();
  * @description автоматически проверяет, существует ли $_SESSION['notification'] и возвращает массив или null / automatically check isset $_SESSION['notification'] and return array or null
  * 
  */
 public static function controll()
 {
  return Message::has() ? Message::getAll() : Message::null();
 }

}