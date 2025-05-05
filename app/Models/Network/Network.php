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
use App\Models\Router\Web;
use App\Controllers\AuthController;
class Network
{
    private static $db;
    private static $patterns = [
        '~^search/login$~' => [Web::class, 'on_Main'],       // search/login
    ];
    public $QuaryRequest__Article = [];//array

    public $QuaryRequest__User = [];//array
    public $QuaryRequest__Auth = [];//array

    public static $table_users = 'users_php';
    public static $table_articles = 'articles';

    //### PUBLIC PATH ###
    public $path_login = 'search/login';
    public $path_index = 'search/index';//non-search
    public $path_regist = 'search/login?form=register';
    public $path_logout = 'search/logout';

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
                        error_log("Таблица '$type' не найдена в системе после попытки создания.\nБыла создана базовая таблица с названием '$type'");
                        self::$db->exec($sql);
                    }
                    return false;
            }

            if (!self::onTableExists($type)) {//false
                error_log("Таблица '$type' не зарегистрирована");
                return false;
            }

            return true;

        } catch (\PDOException $e) {
            error_log("Ошибка PDO при проверке/создании таблицы '$type': " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param string $tableName
     * 
     * @return bool
     */
    private static function onTableExists(string $tableName)
    {
        try {
            $stmt = self::$db->query("SHOW TABLES LIKE '$tableName'");
            return $stmt->rowCount() > 0;//true существует or false несуществует
        } catch (\PDOException $e) {
            error_log("Ошибка при проверке существования таблицы '$tableName': " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param string $columnName
     * @param string $tableName
     * 
     * @return [type]
     */
    public static function onColumnExists(string $columnName, string $tableName)
    {
        try {
            $stmt = self::$db->query("SHOW COLUMNS FROM " . $tableName . " LIKE '$columnName'");

            if ($stmt->rowCount() === 0) {
                $sql = "ALTER TABLE " . $tableName . " ADD COLUMN `$columnName` VARCHAR(255)";
                self::$db->exec($sql);
                error_log("Создание новой колонки '$columnName' в таблице '$tableName'");
            }

            return true;
        } catch (\PDOException $e) {
            error_log("Ошибка при проверке/создании колонки '$columnName' в таблице '$tableName': " . $e->getMessage());
            return false;
        }
    }


    public static function onRedirect(string $path)
    {
        try {
            if (empty($path)) {
                throw new \Exception("Путь для перенаправления не может быть пустым");
            }

            // Очищаем путь от директории "/public"
            $cleanPath = str_replace('/search', '', $path);

            if (ob_get_level()) {
                ob_end_clean(); // чистим буфер вывода
            }

            if (headers_sent($file, $line)) {
                throw new \Exception("Заголовки уже были отправлены в файле $file на строке $line");
            }

            header("Location: " . ltrim($cleanPath, '/'));
            (new Network())->onRoute();//вызываем метод на маршрутизацию
            exit();//обязательно выйдим с цикла
        } catch (\Exception $e) {
            error_log("Ошибка при перенаправлении: " . $e->getMessage());

            if (!headers_sent()) {
                header("HTTP/1.1 500 Internal Server Error");
                echo "Произошла ошибка при перенаправлении. Пожалуйста, попробуйте позже.";
                exit();
            }
            return false;
        }
    }

    public function onRoute()
    {
        self::onAutoloadRegister();

        // Получаем текущий маршрут из .htaccess
        if (isset($_SERVER['REDIRECT_URL'])) {
            $route = trim($_SERVER['REDIRECT_URL'], '/');
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

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new AuthController())->onLogin();
                    exit();
                }
                break;
            }
        }
        if (!$findRoute) {
            header("HTTP/1.1 404 Страница не найдена");
            (new Web())->error_404('/' . $route);
            exit();
        }
    }


    // description: если не используем composer, то вызываем этот метод для загрузки классов
    public static function onAutoloadRegister(
    ): void {
        spl_autoload_register(function ($className) {

            $filePath = dirname(__DIR__) . '/' . str_replace(['\\', 'App\Models'], ['/', ''], $className) . '.php';

            if (file_exists($filePath)) {//have't file
                require_once $filePath;
            } else {
                die("ошибка загрузки класса '$className'. Файл не существует по пути: $filePath");
            }
        });
    }

    /**
     * @return [type]
     */
    public function preparerRequestArticle()
    {
        if (empty($this->QuaryRequest__Article)) {
            $this->QuaryRequest__Article = [
                'addArticle' => self::$db->prepare("INSERT INTO " . self::$table_articles . " (title, content, user_id, created_at) VALUES (?, ?, ?, NOW())"),
                'removeArticle' => self::$db->prepare("DELETE FROM " . self::$table_articles . " WHERE id = ? AND user_id = ?"),
                'getArticleAll' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user ON art.user_id = user.id ORDER BY art.created_at DESC"),
                'getAllArticleById' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user ON art.user_id = user.id WHERE art.user_id = ?"),
                'getListMyArticle' => self::$db->prepare("SELECT * FROM " . self::$table_articles . " WHERE user_id = ? ORDER BY created_at DESC"),
                'getMyArticle' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user ON art.user_id = user.id WHERE user.id = ? AND art.id = ?"),
                'currentArticle' => self::$db->prepare("SELECT art.*, user.username FROM " . self::$table_articles . " art JOIN users_php user WHERE art.user_id = ? AND art.id = ?"),
                'onUpdateArticle' => self::$db->prepare("UPDATE " . self::$table_articles . " SET title = ?, content = ?, created_at = NOW() WHERE id = ? AND user_id = ?"),
            ];
        }
        return $this->QuaryRequest__Article;
    }

    /**
     * @return [type]
     */
    public function preparerRequestUser()
    {
        if (empty($this->QuaryRequest__User)) {
            $this->QuaryRequest__User = [
                'getUser_id' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE id = ?"),
                'getUser_username' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE username = ?"),
                'onSessionUser_id' => self::$db->prepare("SELECT `session` FROM " . self::$table_users . " WHERE id = ?"),
                'onSessionUser_session' => self::$db->prepare("SELECT `session` FROM " . self::$table_users . " WHERE id = ?"),
                'onUpdateSession' => self::$db->prepare("UPDATE " . self::$table_users . " SET `session` = ? WHERE id = ?"),
            ];
        }
        return $this->QuaryRequest__User;
    }

    /**
     * @return [type]
     */
    public function preparerRequestAuth()
    {
        if (empty($this->QuaryRequest__Auth)) {
            $this->QuaryRequest__Auth = [
                'onLogin_fetchUser_ByUsernanme' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE username = ?"),
                'onLogin_fetchUser_ByMail' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE mail = ?"),
                'onRegist_fetchUser_ByUsername' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE username = ?"),
                'onRegist_fetchUser_ByMail' => self::$db->prepare("SELECT * FROM " . self::$table_users . " WHERE mail = ?"),
                'onRegist_Create_User' => self::$db->prepare("INSERT INTO " . self::$table_users . " (username, mail, password, session) VALUES (?, ?, ?, ?)"),
            ];
        }
        return $this->QuaryRequest__Auth;
    }
}