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

use PDO;
use RuntimeException;
use App\Models\Network\Network;
class Database
{
    // Параметры подключения к базе данных
    private const DB_HOST = 's125.craft-hosting.ru';
    private const DB_PORT = '3306';
    private const DB_USERNAME = 'bdp472_s1';
    private const DB_PASSWORD = '123456';
    private const DB_NAME = 'bdp472_s1';
    private static $instance = [];

    public static function getConnection()
    {
        if (empty(self::$instance)) {
            try {
                $options = [
                    PDO::ATTR_PERSISTENT => true, // Постоянное соединение
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false, // Отключаем эмуляцию для лучшей производительности
                    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true, // Используем буферизованные запросы
                    PDO::ATTR_TIMEOUT => 1, // Таймаут в секундах
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4;
                        SET SESSION sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
                        SET SESSION innodb_lock_wait_timeout=5;
                        SET SESSION wait_timeout=60;
                        SET SESSION interactive_timeout=60;
                        SET SESSION net_read_timeout=10;
                        SET SESSION net_write_timeout=10;
                        SET SESSION max_execution_time=1000;"
                ];

                $dsn = "mysql:host=" . self::DB_HOST .
                    ";port=" . self::DB_PORT .
                    ";dbname=" . self::DB_NAME .
                    ";charset=utf8mb4";

                self::$instance = new PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD, $options);

                return self::$instance;
            } catch (\PDOException $e) {
                error_log("ошибка подключения к базе данных: " . $e->getMessage());
                Network::onRedirect('/login.php');
                throw new RuntimeException('Ошибка подключения к базе данных. Пожалуйста, проверьте настройки.');
            }
        }

        return self::$instance;//PDO
    }

    public static function closeConnection()
    {
        self::$instance = [];
    }
}