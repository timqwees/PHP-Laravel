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
use PDO;

class AuthController
{
    /**
     * @var [type]
     */
    private static $db;
    /**
     * @var [type]
     */
    private $network;

    private $user;
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
    private $path_login = '/login.php';
    /**
     * @var [type]
     */
    private $path_regist = '/regist.php';
    /**
     * @var [type]
     */
    private $path_logout = '/logout.php';

    public function __construct()
    {
        self::$db = Database::getConnection();
        $this->network = new Network();
        $this->user = new User();
        $this->verifyTable = Network::onTableCheck($this->className);
    }

    /**
     * @return [type]
     */
    public function onLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = $_POST['mail'] ?? '';
            $password = $_POST['password'] ?? '';
            // $remember_password = $_POST['remember-password'] ?? '';

            if (empty($mail) || empty($password)) {
                $_SESSION['error'] = 'Пожалуйста, заполните все поля';
                Network::onRedirect($this->path_login);
                exit;
            }

            try {
                $this->verifyTable;//check table
                $stmt = $this->network->QuaryRequest__Auth['onLogin_fetchUser_ByMail'];
                $stmt->execute([$mail]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'mail' => $user['mail'],
                        'performer_customer' => $user['performer_customer'],
                        'session' => $user['session']
                    ];
                    $this->user->updateSessionStatus('on', $_SESSION['user']['id']);
                    Network::onRedirect('/contractorPA.php');
                    exit;
                } else {
                    $_SESSION['error'] = 'Неверное имя пользователя или пароль';
                    Network::onRedirect($this->path_login);
                    exit;
                }
            } catch (\PDOException $e) {
                $_SESSION['error'] = 'Ошибка при входе в систему';
                Network::onRedirect($this->path_login);
                exit;
            }
        }
    }

    /**
     * @return [type]
     */
    public function onRegist()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = (string) trim($_POST['mail'] ?? '');
            $username = (string) trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $performer_customer = (string) ($_POST['performer-customer'] ?? '');

            // Валидация
            if (empty($username) || empty($password) || empty($performer_customer) || empty($mail)) {
                $_SESSION['error'] = 'Пожалуйста, заполните все поля';
                Network::onRedirect($this->path_regist);
                exit;
            }

            if (strlen($username) < 3) {
                $_SESSION['error'] = 'Имя пользователя должно содержать минимум 3 символа';
                Network::onRedirect($this->path_regist);
                exit;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Пароль должен содержать минимум 6 символов';
                Network::onRedirect($this->path_regist);
                exit;
            }

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Неверный формат почты';
                Network::onRedirect($this->path_regist);
                exit;
            }

            if ($performer_customer !== 'performer' && $performer_customer !== 'order') {
                $_SESSION['error'] = 'Вы должны выбрать роль';
                Network::onRedirect($this->path_regist);
                exit;
            }

            try {
                $this->verifyTable;//check table
                $stmt = $this->network->QuaryRequest__Auth['onRegist_fetchUser_ByUsername'];
                $stmt->execute([$username]);
                if ($stmt->fetchColumn() > 0) {
                    $_SESSION['error'] = "Пользователь с именем: $username уже существует";
                    Network::onRedirect($this->path_regist);
                    exit;
                }

                $stmt = $this->network->QuaryRequest__Auth['onRegist_fetchUser_ByMail'];
                $stmt->execute([$mail]);
                if ($stmt->fetchColumn() > 0) {
                    $_SESSION['error'] = "Почта: $mail уже существует";
                    Network::onRedirect($this->path_regist);
                    exit;
                }

                $stmt = $this->network->QuaryRequest__Auth['onRegist_Create_User'];
                $stmt->execute([
                    $username,
                    $mail,
                    $performer_customer,
                    password_hash($password, PASSWORD_DEFAULT),
                    'on'//session
                ]);

                $_SESSION['success'] = "Регистрация успешна! $username, Теперь вы можете войти";
                Network::onRedirect($this->path_login);
                exit;
            } catch (\PDOException $e) {
                $_SESSION['error'] = 'Ошибка при регистрации: ' . $e->getMessage();
                Network::onRedirect($this->path_regist);
                exit;
            }
        }
    }

    /**
     * @return [type]
     */
    public function logout()
    {
        session_start();
        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
            $userModel = new User();
            $userModel->updateSessionStatus('off', $_SESSION['user']['id']);
        }
        session_destroy();
        unset($_SESSION['user']);
        Network::onRedirect($this->path_login);
        exit;
    }
}