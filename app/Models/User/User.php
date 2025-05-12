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

namespace App\Models\User;

use App\Config\Database;
use App\Models\Network\Network;
use PDO;

class User
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
    private $className = 'users';
    /**
     * @var [type]
     */
    private $network;
    /**
     * @var string
     */
    private $path_login = '/login.php';

    public function __construct()
    {
        self::$db = Database::getConnection();
        $this->network = new Network();
        $this->verifyTable = Network::onTableCheck($this->className);
    }

    /**
     * @param string $type
     * @param int $index
     * 
     * @return [type]
     */
    public function getUser(string $type, int $index)
    {
        try {
            $this->verifyTable;//check table
            switch ($type) {
                case 'id':
                    $stmt = $this->network->QuaryRequest__User['getUser_id'];
                    $stmt->execute([$index]);
                    break;
                case 'username':
                    $stmt = $this->network->QuaryRequest__User['getUser_username'];
                    $stmt->execute([$index]);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * @param array $fields Array of fields to update with their values
     * @param int $userId User ID to update
     * 
     * @return bool
     */
    public function onUpdateProfile(string $tableName, array $fields, int $userId)
    {
        try {
            $this->verifyTable;//check table

            foreach ($fields as $column => $value) {
                Network::onColumnExists($column, $tableName);
            }

            $setClause = [];
            $params = [];

            foreach ($fields as $column => $value) {
                $setClause[] = "`$column` = ?";
                $params[] = $value;
            }

            // Add userId to params
            $params[] = $userId;

            $sql = "UPDATE " . $this->className . " SET " . implode(', ', $setClause) . " WHERE id = ?";
            $stmt = self::$db->prepare($sql);

            return $stmt->execute($params);
        } catch (\PDOException $e) {
            error_log("Error updating profile: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Загружает файл и возвращает путь к нему
     * @param array $file Массив с данными файла из $_FILES
     * @param string $prefix Префикс для имени файла (обычно ID пользователя)
     * @param string|null $customName Пользовательское имя файла (без расширения)
     * @return string|false Путь к файлу или false в случае ошибки
     */
    function uploadFile(array $file, string $prefix = '', ?string $customName = null): string|false
    {
        try {
            // Проверяем тип файла
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file['type'], $allowedTypes)) {
                throw new \Exception('Недопустимый тип файла. Разрешены только JPG, PNG и GIF.');
            }

            // Проверяем размер файла (максимум 5MB)
            if ($file['size'] > 5 * 1024 * 1024) {
                throw new \Exception('Размер файла превышает 5MB.');
            }

            $uploadPath = __DIR__ . '/../../../public/avatar';

            if (!is_dir($uploadPath)) {
                if (!mkdir($uploadPath, 0777, true)) {
                    throw new \Exception('Не удалось создать директорию для загрузки.');
                }
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            // Формируем имя файла
            if ($customName !== null) {
                // Очищаем пользовательское имя от небезопасных символов
                $customName = preg_replace('/[^a-zA-Z0-9_-]/', '', $customName);
                $fileName = $customName . ".$ext";
            } else {
                $fileName = $prefix . '_' . time() . ".$ext";
            }

            $fullPath = "$uploadPath/$fileName";

            // Проверяем, существует ли файл с таким именем
            if (file_exists($fullPath)) {
                // Добавляем временную метку к имени файла
                $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '_' . time() . ".$ext";
                $fullPath = "$uploadPath/$fileName";
            }

            if (!move_uploaded_file($file['tmp_name'], $fullPath)) {
                throw new \Exception('Ошибка при загрузке файла на сервер.');
            }

            // Возвращаем относительный путь для сохранения в БД
            return "avatar/$fileName";
        } catch (\Exception $e) {
            error_log("Ошибка при загрузке файла: " . $e->getMessage());
            return false;
        }
    }

    /**
     * @param mixed $index
     * 
     * @return [type]
     */
    public function onSessionUser(int $index)
    {
        try {
            if ($index === 0) {
                Network::onRedirect($this->path_login);
                session_destroy();
                return false;
            }

            $this->verifyTable; //check table
            $stmt = $this->network->QuaryRequest__User['onSessionUser_id'];
            $stmt->execute([$index]);

            if ($stmt->rowCount() === 1) {
                $found = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($found['session'] === 'off') {//сессия отключена / вышел с аккаунта
                    Network::onRedirect($this->path_login);
                    session_destroy();
                    return false;
                }
                return true;
            }

            Network::onRedirect($this->path_login);
            session_destroy();
            return false;
        } catch (\PDOException $e) {
            error_log("Ошибка при проверке пользователя: " . $e->getMessage());
            Network::onRedirect($this->path_login);
            session_destroy();
            return false;
        }
    }

    /**
     * @param string $status
     * @param int $userId
     * 
     * @return [type]
     */
    public function updateSessionStatus(string $status, int $userId)
    {
        try {
            $this->verifyTable;
            $stmt = $this->network->QuaryRequest__User['onUpdateSession'];
            $stmt->execute([$status, $userId]);
            return true;
        } catch (\PDOException $e) {
            error_log("Ошибка при обновлении статуса сессии: " . $e->getMessage());
            return false;
        }
    }
}