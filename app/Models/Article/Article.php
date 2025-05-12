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

namespace App\Models\Article;

use App\Config\Database;
use App\Models\Network\Network;
use PDO;

class Article
{
    /**
     * @var [type]
     */
    private static $db;
    /**
     * @var [type]
     */
    private $verifyTable;
    /**
     * @var [type]
     */
    private $className = 'poster';
    /**
     * @var [type]
     */
    private $network;
    /**
     * @var [type]
     */
    private $path_login = '/log-in.php';

    public function __construct()
    {
        self::$db = Database::getConnection();
        $this->network = new Network();
        $this->verifyTable = Network::onTableCheck($this->className);
    }
    /**
     * @param string $title
     * @param string $content
     * @param int $userId
     * 
     * @return [type]
     */
    public function addArticle(string $title, string $content, int $userId)
    {
        try {
            $stmt = $this->network->QuaryRequest__Article['addArticle'];
            if ($stmt->execute([$title, $content, $userId])) {
                return self::$db->lastInsertId();
            }
            return false;
        } catch (\PDOException $e) {
            error_log("Ошибка при создании статьи: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param int $id
     * @param int $userId
     * 
     * @return [type]
     */
    public function removeArticle(int $id, int $userId)
    {
        try {
            $this->verifyTable;

            self::$db->beginTransaction();

            $stmt = $this->network->QuaryRequest__Article['removeArticle'];
            $result = $stmt->execute([$id, $userId]);

            if ($result) {
                self::$db->commit();
                return true;
            }

            self::$db->rollBack();
            return false;
        } catch (\PDOException $e) {
            if (self::$db->inTransaction()) {
                self::$db->rollBack();
            }
            error_log("Ошибка при удалении статьи: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param int $user_index
     * @param int $article_index
     * 
     * @return [type]
     */
    public function currentArticle(int $user_index, int $article_index)
    {
        try {
            $this->verifyTable; // check table
            $stmt = $this->network->QuaryRequest__Article['currentArticle'];
            $stmt->execute([$user_index, $article_index]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } catch (\PDOException $e) {
            error_log("Ошибка при получении статьи: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @return [type]
     */
    public function getArticleAll()
    {
        try {
            $stmt = $this->network->QuaryRequest__Article['getArticleAll'];
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Ошибка при получении статей: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param mixed $user_index
     * 
     * @return [type]
     */
    public function getAllArticleById($user_index)
    {
        try {
            $stmt = $this->network->QuaryRequest__Article['getAllArticleById'];
            $stmt->execute([$user_index]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Ошибка при получении статьи: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @return [type]
     */
    public function getListMyArticle()
    {
        try {
            $stmt = $this->network->QuaryRequest__Article['getListMyArticle'];
            $stmt->execute([$_SESSION['user']['id']]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Ошибка при получении статей пользователя: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param mixed $art_index
     * 
     * @return [type]
     */
    public function getMyArticle(int $user_index, int $article_index)
    {
        try {
            $stmt = $this->network->QuaryRequest__Article['getMyArticle'];
            $stmt->execute([$user_index, $article_index]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Ошибка при получении статей пользователя: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param string $title
     * @param string $content
     * @param int $articleId
     * @param int $userId
     * 
     * @return [type]
     */
    public function onUpdateArticle(string $title, string $content, int $articleId, int $userId)
    {
        try {
            $stmt = $this->network->QuaryRequest__Article['onUpdateArticle'];
            return $stmt->execute([$title, $content, $articleId, $userId]);
        } catch (\PDOException $e) {
            error_log("Ошибка при обновлении статьи: " . $e->getMessage());
            return false;
        }
    }
}