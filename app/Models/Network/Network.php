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

use App\Config\Database;
use App\Models\Router\Routes;
use App\Config\Session;
use App\Models\Network\Message;

class Network extends Session
{
    private static $db;

    //### PATTERNS ROUTER PAGE ###
    private static $patterns = [
        '~^$~' => [Routes::class, 'on_Main'],       // https://exemple.com/
        '~^search/login$~' => [Routes::class, 'on_Login'], // https://exemple.com/search/login
        '~^search/regist$~' => [Routes::class, 'on_Regist'], // https://exemple.com/search/regist
        '~^search/account$~' => [Routes::class, 'on_Account'], // https://exemple.com/search/account
        '~^search/account/blogs$~' => [Routes::class, 'on_Blogs'], // https://exemple.com/search/account/blogs
        '~^search/account/setting$~' => [Routes::class, 'on_Setting'], // https://exemple.com/search/account/setting
        '~^search/logout$~' => [Routes::class, 'on_Logout'], // https://exemple.com/search/logout
    ];

    //### REQUEST FUNCTION IN DATABASE ###
    public $QuaryRequest__Article = [];//array
    public $QuaryRequest__User = [];//array
    public $QuaryRequest__Auth = [];//array

    //### LIST TABLES INT0 DATABASE ###
    public static $table_users = 'users_php';
    public static $table_articles = 'articles';

    //### PUBLIC PATH ###
    public static $path_login = 'search/login';
    public static $path_regist = 'search/regist';//not in the search
    public static $path_account = 'search/account';//not in the search
    public static $path_logout = 'search/logout';//not in the search

    public function __construct(
    ) {
        self::$db = Database::getConnection();
        self::onTableCheck(self::$table_users);
        self::onTableCheck(self::$table_articles);
        $this->preparerRequestArticle();
        $this->preparerRequestUser();
        $this->preparerRequestAuth();
    }

    /**
     * @param string $type
     * 
     * @return [type]
     * 
     * @example $this->onTableCheck('Имя таблицы')
     * @description автопроверка на существование таблицы и автосоздание несущетвующей / auto-checking for the existence of a table and auto-creating a nonessential one
     * 
     */
    public static function onTableCheck(string $type)
    {
        try {
            switch (strtolower($type)) {
                case 'users':
                case 'user':
                case 'users_php':
                    if (!self::onTableExists(self::$table_users)) {//false

                        $sql = "CREATE TABLE IF NOT EXISTS `" . self::$table_users . "` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mail varchar(50) NOT NULL,
            username varchar(50) NOT NULL,
            password varchar(255) NOT NULL,
            session VARCHAR(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                        self::$db->exec($sql);
                    }
                    break;

                case 'articles':
                case 'article':
                case 'art':
                case 'poster':
                case 'post':
                    if (!self::onTableExists(self::$table_articles)) {//false

                        $sql = "CREATE TABLE IF NOT EXISTS `" . self::$table_articles . "` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    FOREIGN KEY (user_id) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                        self::$db->exec($sql);
                    }
                    break;

                default:
                    if (!self::onTableExists($type)) {//false

                        $sql = "CREATE TABLE IF NOT EXISTS `$type` (
                   id INT AUTO_INCREMENT PRIMARY KEY,
                   title VARCHAR(255) NOT NULL
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                        message::set('error', "Таблица '$type' не найдена в системе после попытки создания.\nБыла создана базовая таблица с названием '$type'");
                        self::$db->exec($sql);
                    }
                    return false;
            }

            if (!self::onTableExists($type)) {//false
                message::set('error', "Таблица '$type' не зарегистрирована");
                return false;
            }

            return true;

        } catch (\PDOException $e) {
            message::set('error', "Ошибка PDO при проверке/создании таблицы '$type': " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param string $tableName
     * @return bool
     * 
     * @example $this->onTableCheck('Имя таблицы')
     * @description автопроверка на существование таблицы и автосоздание несущетвующей / auto-checking for the existence of a table and auto-creating a nonessential one
     * 
     */
    private static function onTableExists(string $tableName)
    {
        try {
            $stmt = self::$db->query("SHOW TABLES LIKE '$tableName'");
            return $stmt->rowCount() > 0;//true существует or false несуществует
        } catch (\PDOException $e) {
            message::set('error', "Ошибка при проверке существования таблицы '$tableName': " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param string $columnName
     * @param string $tableName
     * @return [type]
     * 
     * @example $this->onColumnExists('Имя колонки', 'Имя таблицы');
     * @description автопроверка на существование колонок в таблице и автосоздание колонки / auto-checking coluns in table and auto-creating column if have not
     * 
     */
    public static function onColumnExists(string $columnName, string $tableName)
    {
        try {
            $stmt = self::$db->query("SHOW COLUMNS FROM " . $tableName . " LIKE '$columnName'");

            if ($stmt->rowCount() === 0) {
                $sql = "ALTER TABLE " . $tableName . " ADD COLUMN `$columnName` VARCHAR(255)";
                self::$db->exec($sql);
                message::set('error', "Создание новой колонки '$columnName' в таблице '$tableName'");
            }

            return true;
        } catch (\PDOException $e) {
            message::set('error', "Ошибка при проверке/создании колонки '$columnName' в таблице '$tableName': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Summary of onRedirect
     * @param string $path
     * @throws \Exception
     * @return bool
     * 
     * @example $this->onRedirect('Путь начиная с корневой директории');
     * @description переадресация к страницам / redirect to page in workspace
     * 
     */
    public static function onRedirect(string $path)
    {
        try {
            if (empty($path)) {
                throw new \Exception("Путь для перенаправления не может быть пустым");
            }

            // Убираем дублирование search в пути
            $path = preg_replace('#^/search/search/#', '/search/', $path);
            $path = preg_replace('#^search/search/#', 'search/', $path);

            // Проверяем на бесконечные редиректы
            if ($_SERVER['REQUEST_URI'] === $path) {
                throw new \Exception("Обнаружен циклический редирект на: " . $path);
            }

            // Добавляем слеш в начало, если его нет
            if (strpos($path, '/') !== 0) {
                $path = '/' . $path;
            }

            if (ob_get_level()) {
                ob_end_clean(); // чистим буфер вывода
            }

            if (headers_sent($file, $line)) {
                throw new \Exception("Заголовки уже были отправлены в файле $file на строке $line");
            }

            header("Location: " . $path, true, 302);
            exit();

        } catch (\Exception $e) {
            message::set('error', "Ошибка при перенаправлении: " . $e->getMessage());

            if (!headers_sent()) {
                header("HTTP/1.1 500 Internal Server Error");
                echo "Произошла внутренняя ошибка. Пожалуйста, проверьте ваше интернет соединение!";
                exit();
            } else {
                return false;
            }
        }
    }

    /**
     * 
     * @example $this->onRoute();
     * @description служит для запуска маршрутизации на сайте / it's need to turn on routing on the site
     * 
     */
    public function onRoute()
    {
        self::onAutoloadRegister();

        // Получаем текущий маршрут из .htaccess
        if (isset($_GET['route'])) {
            $route = trim($_GET['route'], '/');
        } else {
            $route = trim($_SERVER['REQUEST_URI'], '/');
        }
        $findRoute = false;

        foreach (self::$patterns as $pattern => $controllerAndAction) {
            if (preg_match($pattern, $route, $matches)) {
                $findRoute = true; // для выхода из цикла и подтверждения что маршрут найден
                unset($matches[0]);// удаляет первый элемент массива
                $action = $controllerAndAction[1]; // sayHello
                $controller = new $controllerAndAction[0];// App\Models\Page\Window
                $controller->$action(...$matches);
                break;
            }
        }
        if (!$findRoute) {
            header("HTTP/1.1 404 Страница не найдена");
            (new Routes())->error_404('/' . $route);
            exit();
        }
    }


    /**
     * @return [type]
     * 
     * @example $this->onAutoloadRegister();
     * @description служит для загрузки классов / it's need to load classes
     * 
     */
    public static function onAutoloadRegister(
    ): void {
        spl_autoload_register(function ($className) {

            $filePath = dirname(__DIR__) . '/' . str_replace(['\\', 'App\Models'], ['/', ''], $className) . '.php';

            if (file_exists($filePath)) {//have't file
                require_once $filePath;
            } else {
                message::set('error', "Ошибка загрузки класса '$className'. Файл не существует по пути: $filePath");
            }
        });
    }

    /**
     * @return [type]
     * 
     * @example $this->preparerRequestArticle();
     * @description служит для подготовки запросов к базе данных / it's need to prepare requests to the database
     * 
     */
    public function preparerRequestArticle()
    {
        if (empty($this->QuaryRequest__Article)) {
            $this->QuaryRequest__Article = [
                'addArticle' => self::$db->prepare("INSERT INTO " . self::$table_articles . " (title, content, user_id, created_at) VALUES (?, ?, ?, NOW())"),
                'removeArticle' => self::$db->prepare("DELETE FROM " . self::$table_articles . " WHERE id = ? AND user_id = ?"),
                'getArticleAll' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user ON art.user_id = user.id ORDER BY art.created_at DESC"),
                'getAllArticleById' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user ON art.user_id = user.id WHERE art.user_id = ?"),
                'getListMyArticle' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user ON art.user_id = user.id WHERE user.id = ? ORDER BY art.created_at DESC"),
                'getMyArticle' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user ON art.user_id = user.id WHERE user.id = ? AND art.id = ?"),
                'currentArticle' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user ON art.user_id = user.id WHERE art.user_id = ? AND art.id = ?"),
                'onUpdateArticle' => self::$db->prepare("UPDATE " . self::$table_articles . " SET title = ?, content = ?, created_at = NOW() WHERE id = ? AND user_id = ?"),
            ];
        }
        return $this->QuaryRequest__Article;
    }

    /**
     * @return [type]
     * 
     * @example $this->preparerRequestUser();
     * @description служит для подготовки запросов к базе данных / it's need to prepare requests to the database
     * 
     */
    public function preparerRequestUser()
    {
        if (empty($this->QuaryRequest__User)) {
            $this->QuaryRequest__User = [
                'getUser_id' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE id = ?"),
                'getUser_username' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE username = ?"),
                'getUser_email' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE mail = ?"),
                'onSessionUser_id' => self::$db->prepare("SELECT `session` FROM " . self::$table_users . " WHERE id = ?"),
                'onSessionUser_session' => self::$db->prepare("SELECT `session` FROM " . self::$table_users . " WHERE id = ?"),
                'onUpdateSession' => self::$db->prepare("UPDATE " . self::$table_users . " SET `session` = ? WHERE id = ?"),
            ];
        }
        return $this->QuaryRequest__User;
    }

    /**
     * @return [type]
     * 
     * @example $this->preparerRequestAuth();
     * @description служит для подготовки запросов к базе данных / it's need to prepare requests to the database
     * 
     */
    public function preparerRequestAuth()
    {
        if (empty($this->QuaryRequest__Auth)) {
            $this->QuaryRequest__Auth = [
                'onLogin_fetchUser_ByUsernanme' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE username = ?"),
                'onLogin_fetchUser_ByMail' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE mail = ?"),
                'onRegist_fetchUser_ByUsername' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE username = ?"),
                'onRegist_fetchUser_ByMail' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE mail = ?"),
                'onRegist_Create_User' => self::$db->prepare("INSERT INTO " . self::$table_users . " (username, mail, password, `group`, session) VALUES (?, ?, ?, ?, ?)"),
            ];
        }
        return $this->QuaryRequest__Auth;
    }
}