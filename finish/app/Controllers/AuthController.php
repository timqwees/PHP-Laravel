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
use PDO;

class AuthController
{
    private static $db;
    private $network;
    private $verifyTable;
    private $className = 'users_php';

    public function __construct()
    {
        self::$db = Database::getConnection();
        $this->network = new Network();
        $this->verifyTable = Network::onTableCheck($this->className);
    }

    public function onLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Пожалуйста, заполните все поля';
                Network::onRedirect('/login.php');
                exit;
            }

            try {
                $this->verifyTable;//check table
                $stmt = $this->network->QuaryRequest__Auth['onLogin_fetchUser_ByUsernanme'];
                $stmt->execute([$username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'group' => $user['group']
                    ];
                    Network::onRedirect('/index.php');
                    exit;
                } else {
                    $_SESSION['error'] = 'Неверное имя пользователя или пароль';
                    Network::onRedirect('/login.php');
                    exit;
                }
            } catch (\PDOException $e) {
                $_SESSION['error'] = 'Ошибка при входе в систему';
                Network::onRedirect('/login.php');
                exit;
            }
        }
    }

    public function onRegist()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = (string) trim($_POST['mail'] ?? '');
            $username = (string) trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $group = (int) ($_POST['group'] ?? 0);

            // Валидация
            if (empty($username) || empty($password) || empty($group) || empty($mail)) {
                $_SESSION['error'] = 'Пожалуйста, заполните все поля';
                Network::onRedirect('/login.php?form=register');
                exit;
            }

            if (strlen($username) < 3) {
                $_SESSION['error'] = 'Имя пользователя должно содержать минимум 3 символа';
                Network::onRedirect('/login.php?form=register');
                exit;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Пароль должен содержать минимум 6 символов';
                Network::onRedirect('/login.php?form=register');
                exit;
            }

            if ($group < 100 || $group > 999) {
                $_SESSION['error'] = 'Неверный номер группы';
                Network::onRedirect('/login.php?form=register');
                exit;
            }

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Неверный формат почты';
                Network::onRedirect('/login.php?form=register');
                exit;
            }

            try {
                $this->verifyTable;//check table
                $stmt = $this->network->QuaryRequest__Auth['onRegist_fetchUser_ByUsername'];
                $stmt->execute([$username]);
                if ($stmt->fetchColumn() > 0) {
                    $_SESSION['error'] = "Пользователь с именем: $username уже существует";
                    Network::onRedirect('/login.php?form=register');
                    exit;
                }

                $stmt = $this->network->QuaryRequest__Auth['onRegist_fetchUser_ByMail'];
                $stmt->execute([$mail]);
                if ($stmt->fetchColumn() > 0) {
                    $_SESSION['error'] = "Почта: $mail уже существует";
                    Network::onRedirect('/login.php?form=register');
                    exit;
                }

                $stmt = $this->network->QuaryRequest__Auth['onRegist_Create_User'];
                $stmt->execute([
                    $username,
                    $group,
                    password_hash($password, PASSWORD_DEFAULT),
                    $mail,
                    'on'
                ]);

                $_SESSION['success'] = "Регистрация успешна! $username, Теперь вы можете войти";
                Network::onRedirect('/login.php');
                exit;
            } catch (\PDOException $e) {
                $_SESSION['error'] = 'Ошибка при регистрации: ' . $e->getMessage();
                Network::onRedirect('/login.php?form=register');
                exit;
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        unset($_SESSION['user']);
        Network::onRedirect('/login.php');
        exit;
    }
}