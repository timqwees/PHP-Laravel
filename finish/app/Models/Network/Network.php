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
class Network
{
    private static $db;
    public $QuaryRequest__Article = [];//array

    public $QuaryRequest__User = [];//array
    public $QuaryRequest__Auth = [];//array

    public function __construct(
    ) {
        self::$db = Database::getConnection();
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
                    if (self::onTableExists('users_php')) {//false

                        $sql = "CREATE TABLE IF NOT EXISTS `users_php` (
       id INT AUTO_INCREMENT PRIMARY KEY,
       mail VARCHAR(50) NOT NULL UNIQUE,
       `group` INT NOT NULL,
       `password` VARCHAR(255) NOT NULL,
       username VARCHAR(50) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       `session` VARCHAR(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                        self::$db->exec($sql);
                    }
                    break;

                case 'articles':
                case 'article':
                case 'art':
                    if (!self::onTableExists('articles')) {//false

                        $sql = "CREATE TABLE IF NOT EXISTS `articles` (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    title VARCHAR(255) NOT NULL,
                    content TEXT NOT NULL,
                    user_id INT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES users_php(id) ON DELETE CASCADE
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
                error_log("Таблица '$type' не зарегестрирована");
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
     * Статический метод для быстрого перенаправления
     * @param string $path Путь для перенаправления
     * @return bool
     */

    public static function onRedirect(string $path): bool
    {
        try {
            if (empty($path)) {
                throw new \Exception("Путь для перенаправления не может быть пустым");
            }

            if (ob_get_level()) {
                ob_end_clean();
            }

            if (headers_sent($file, $line)) {
                throw new \Exception("Заголовки уже были отправлены в файле $file на строке $line");
            }

            header("Location: /public/" . ltrim($path, '/'));
            exit();
        } catch (\Exception $e) {
            error_log("Ошибка при перенаправлении: " . $e->getMessage());

            if (!headers_sent()) {
                header("HTTP/1.1 500 Internal Server Error");
                echo "Произошла ошибка при перенаправлении. Пожалуйста, попробуйте позже.";
            }

            return false;
        }
    }

    public function preparerRequestArticle()
    {
        if (empty($this->QuaryRequest__Article)) {
            $this->QuaryRequest__Article = [
                'addArticle' => self::$db->prepare(
                    "INSERT INTO articles (title, content, user_id, created_at) VALUES (?, ?, ?, NOW())"
                ),
                'removeArticle' => self::$db->prepare(
                    "DELETE FROM articles WHERE id = ? AND user_id = ?"
                ),
                'getArticleAll' => self::$db->prepare("
                 SELECT art.*, user.username
                 FROM articles art
                 JOIN users_php user ON art.user_id = user.id
                 ORDER BY art.created_at DESC
             "),
                'getAllArticleById' => self::$db->prepare("
                 SELECT art.*, user.username
                 FROM articles art
                 JOIN users_php user ON art.user_id = user.id
                 WHERE art.user_id = ?
             "),
                'getListMyArticle' => self::$db->prepare("
                 SELECT * FROM articles 
                 WHERE user_id = ? 
                 ORDER BY created_at DESC
             "),
                'getMyArticle' => self::$db->prepare("
                 SELECT art.*, user.username
                 FROM articles art
                 JOIN users_php user ON art.user_id = user.id
                 WHERE user.id = ? AND art.id = ?
             "),
                'currentArticle' => self::$db->prepare("
                 SELECT art.*, user.username
                 FROM articles art
                 JOIN users_php user
                 WHERE art.user_id = ? AND art.id = ?
             "),
                'onUpdateArticle' => self::$db->prepare("
                 UPDATE articles 
                 SET title = ?, content = ?, created_at = NOW() 
                 WHERE id = ? AND user_id = ?
             "),
            ];
        }
        return $this->QuaryRequest__Article;
    }

    public function preparerRequestUser()
    {
        if (empty($this->QuaryRequest__User)) {
            $this->QuaryRequest__User = [
                'getUser_id' => self::$db->prepare("SELECT * FROM users_php WHERE id = ?"),
                'getUser_username' => self::$db->prepare("SELECT * FROM users_php WHERE username = ?"),
                'onUpdateGroup' => self::$db->prepare("UPDATE users_php SET `group` = ? WHERE id = ?"),
                'onSessionUser_id' => self::$db->prepare("SELECT `id` FROM users_php WHERE id = ?"),
                'onSessionUser_session' => self::$db->prepare("SELECT `session` FROM users_php WHERE id = ?"),
            ];
        }
        return $this->QuaryRequest__User;
    }

    public function preparerRequestAuth()
    {
        if (empty($this->QuaryRequest__Auth)) {
            $this->QuaryRequest__Auth = [
                'onLogin_fetchUser_ByUsernanme' => self::$db->prepare("SELECT * FROM users_php WHERE username = ?"),
                'onRegist_fetchUser_ByUsername' => self::$db->prepare("SELECT * FROM users_php WHERE username = ?"),
                'onRegist_fetchUser_ByMail' => self::$db->prepare("SELECT * FROM users_php WHERE mail = ?"),
                'onRegist_Create_User' => self::$db->prepare("INSERT INTO users_php (username, `group`, password, mail, session) VALUES (?, ?, ?, ?, ?)"),
            ];
        }
        return $this->QuaryRequest__Auth;
    }
}