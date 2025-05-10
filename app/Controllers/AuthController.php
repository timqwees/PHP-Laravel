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

namespace App\Controllers;

use App\Config\Database;
use App\Models\Network\Network;
use App\Models\User\User;
use App\Models\Network\Message;

class AuthController extends Network
{
    private static $db;
    private $network;
    private $user;
    private $verifyTable;

    public function __construct()
    {
        // Инициализируем сессию
        Network::init();

        self::$db = Database::getConnection();
        $this->network = new Network();
        $this->user = new User();
        $this->verifyTable = self::onTableCheck(self::$table_users);
    }

    /**
     * @return [type]
     * 
     * @example $this->onLogin();
     * @description вход в систему / login to system
     * 
     */
    public function onLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            self::onRedirect(self::$path_login);
            return false;
        }

        $mail = trim($_POST['mail'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($mail) || empty($password)) {
            Message::set('error', 'Пожалуйста, заполните все поля');
            self::onRedirect(self::$path_login);
        }

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            Message::set('error', 'Неверный формат почты');
            self::onRedirect(self::$path_login);
        }

        try {
            $user = (new User())->getUser('mail', $mail);

            if ($user && password_verify($password, $user['password'])) {
                // Регенерируем ID сессии
                Network::regenerate();

                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'mail' => $user['mail']
                ];
                Message::set('success', 'Вы успешно вошли в систему');
                return self::onRedirect(self::$path_account);
            } else {
                Message::set('error', 'Неверная почта или пароль');
                return self::onRedirect(self::$path_login);
            }
        } catch (\Exception $e) {
            Message::set('error', 'Произошла ошибка при входе в систему');
            return self::onRedirect(self::$path_login);
        }
    }

    /**
     * @return [type]
     * 
     * @example $this->onRegist();
     * @description регистрация пользователя / register user
     * 
     */
    public function onRegist()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = (string) trim($_POST['mail'] ?? '');
            $username = (string) trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $group = (int) $_POST['group'] ?? '';
            // Валидация
            if (empty($username) || empty($password) || empty($mail) || empty($group)) {
                Message::set('error', 'Пожалуйста, заполните все поля');
                return self::onRedirect(self::$path_regist);
            }

            if (strlen($username) < 3) {
                Message::set('error', 'Имя пользователя должно содержать минимум 3 символа');
                return self::onRedirect(self::$path_regist);
            }

            if (strlen($password) < 6) {
                Message::set('error', 'Пароль должен содержать минимум 6 символов');
                return self::onRedirect(self::$path_regist);
            }

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                Message::set('error', 'Неверный формат почты');
                return self::onRedirect(self::$path_regist);
            }

            try {
                $this->verifyTable;//check table
                $stmt = $this->network->QuaryRequest__Auth['onRegist_fetchUser_ByUsername'];
                $stmt->execute([$username]);
                if ($stmt->fetchColumn() > 0) {
                    Message::set('error', "Пользователь с именем: $username уже существует");
                    self::onRedirect(self::$path_regist);
                    return false;
                }

                $stmt = $this->network->QuaryRequest__Auth['onRegist_fetchUser_ByMail'];
                $stmt->execute([$mail]);
                if ($stmt->fetchColumn() > 0) {
                    Message::set('error', "Почта: $mail уже существует");
                    return self::onRedirect(self::$path_regist);
                }

                $stmt = $this->network->QuaryRequest__Auth['onRegist_Create_User'];
                $stmt->execute([
                    $username,
                    $mail,
                    password_hash($password, PASSWORD_DEFAULT),
                    $group,
                    'on'//session
                ]);

                Message::set('success', "Регистрация успешна! $username, Теперь вы можете войти");
                return self::onRedirect(self::$path_login);
            } catch (\PDOException $e) {
                Message::set('error', 'Ошибка при регистрации: ' . $e->getMessage());
                return self::onRedirect(self::$path_regist);
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
            $userModel = new User();
            $userModel->updateSessionStatus('off', $_SESSION['user']['id']);
        }

        // Уничтожаем сессию
        Network::destroy();

        Message::set('success', 'Вы успешно вышли из системы');
        return self::onRedirect(self::$path_login);
    }
}