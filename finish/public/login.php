<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

// Проверяем, авторизован ли пользователь
session_start();
if (isset($_SESSION['user'])) {
    header('Location: /public/index.php');
    exit;
}

$authController = new AuthController();

// Обработка форм
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'login') {
            $authController->login();
        } elseif ($_POST['action'] === 'register') {
            $authController->register();
        }
    }
}

// Определяем, какую форму показывать
$showRegister = isset($_GET['form']) && $_GET['form'] === 'register';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация - TimQwees Technology</title>
    <meta name="description" content="Войдите в систему или зарегистрируйтесь">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="shortcut icon" href="src/timqwees/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container <?php echo $showRegister ? 'active' : ''; ?>">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <div class="form-box login">
            <form method="POST" action="/public/login.php">
                <input type="hidden" name="action" value="login">
                <h1>Вход</h1>
                <div class="input-box">
                    <div class="control_icon">
                        <input name="username" type="text" placeholder="Имя пользователя" required>
                        <i class='bx bxs-user'></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="control_icon">
                        <input name="password" type="password" placeholder="Пароль" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                </div>
                <button type="submit" class="btn">Войти</button>
            </form>
        </div>

        <div class="form-box register">
            <form method="POST" action="/public/login.php">
                <input type="hidden" name="action" value="register">
                <h1>Регистрация</h1>
                <div class="input-box">
                    <div class="control_icon">
                        <input name="username" type="text" placeholder="Имя пользователя" required minlength="3">
                        <i class='bx bxs-user'></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="control_icon">
                        <input name="group" type="number" placeholder="Номер группы" required min="100" max="999">
                        <i class='bx bxs-group'></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="control_icon">
                        <input name="password" type="password" placeholder="Пароль" required minlength="6">
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                </div>
                <button type="submit" class="btn">Зарегистрироваться</button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Добро пожаловать!</h1>
                <p>Нет аккаунта?</p>
                <a href="/public/login.php?form=register" class="btn">Создать</a>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Добро пожаловать!</h1>
                <p>Уже есть аккаунт?</p>
                <a href="/public/login.php?form=login" class="btn">Войти</a>
            </div>
        </div>
    </div>

    <script>
        // Добавляем класс active к контейнеру при загрузке страницы, если нужно показать форму регистрации
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.container');
            if (window.location.search.includes('form=register')) {
                container.classList.add('active');
            }
        });
    </script>
</body>
</html> 