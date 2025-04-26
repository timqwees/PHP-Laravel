<?php

namespace App\Controllers;

use App\Config\Database;

class AuthController {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Пожалуйста, заполните все поля';
                header('Location: /public/login.php');
                exit;
            }

            try {
                $stmt = $this->db->prepare("SELECT * FROM users_php WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'group' => $user['group']
                    ];
                    header('Location: /public/index.php');
                    exit;
                } else {
                    $_SESSION['error'] = 'Неверное имя пользователя или пароль';
                    header('Location: /public/login.php');
                    exit;
                }
            } catch (\PDOException $e) {
                $_SESSION['error'] = 'Ошибка при входе в систему';
                header('Location: /public/login.php');
                exit;
            }
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');//обрежим имя пользователя
            $password = $_POST['password'] ?? '';
            $group = (int)($_POST['group'] ?? 0);

            // Валидация
            if (empty($username) || empty($password) || empty($group)) {
                $_SESSION['error'] = 'Пожалуйста, заполните все поля';
                header('Location: /public/login.php?form=register');
                exit;
            }

            if (strlen($username) < 3) {
                $_SESSION['error'] = 'Имя пользователя должно содержать минимум 3 символа';
                header('Location: /public/login.php?form=register');
                exit;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Пароль должен содержать минимум 6 символов';
                header('Location: /public/login.php?form=register');
                exit;
            }

            if ($group < 100 || $group > 999) {
                $_SESSION['error'] = 'Неверный номер группы';
                header('Location: /public/login.php?form=register');
                exit;
            }

            try {
                // Проверка существования пользователя
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM users_php WHERE username = ?");
                $stmt->execute([$username]);
                if ($stmt->fetchColumn() > 0) {
                    $_SESSION['error'] = 'Пользователь с таким именем уже существует';
                    header('Location: /public/login.php?form=register');
                    exit;
                }

                // Регистрация
                $stmt = $this->db->prepare("INSERT INTO users_php (username, `group`, password) VALUES (?, ?, ?)");
                $stmt->execute([
                    $username,
                    $group,
                    password_hash($password, PASSWORD_DEFAULT)
                ]);

                $_SESSION['success'] = 'Регистрация успешна! Теперь вы можете войти';
                header('Location: /public/login.php');
                exit;
            } catch (\PDOException $e) {
                $_SESSION['error'] = 'Ошибка при регистрации: ' . $e->getMessage();
                header('Location: /public/login.php?form=register');
                exit;
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        unset($_SESSION['user']);
        header('Location: /public/login.php');
        exit;
    }
} 