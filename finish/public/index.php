<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;

// Проверяем авторизацию
session_start();
if (!isset($_SESSION['user']['id'])) {
    header('Location: /public/login.php');
    exit;
}

// Получаем информацию о текущем пользователе
$userModel = new User();
$currentUser = $userModel->getById($_SESSION['user']['id']);

if (!$currentUser) {
    session_destroy();
    header('Location: /public/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>TimQwees Technology - Account</title>
    <meta content="Пройдите регистрацию, чтобы перейти в онлайн чат политеха" name="description" />
    <meta content="TimQwees Technology" property="og:title" />
    <meta content="Пройдите регистрацию, чтобы перейти в онлайн чат политеха" property="og:description" />
    <meta content="img/favicon.ico" property="og:image" />
    <meta property="og:type" content="website" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <div class="sidebar">
            <div class="profile">
                <div class="profile-img">
                    <img src="https://cdn-icons-png.flaticon.com/512/3385/3385696.png" alt="Developer">
                </div>
                <div class="profile-info">
                    <h2>TimQwees Technology</h2>
                    <p>Группа: <?php echo htmlspecialchars($currentUser['group']); ?></p>
                </div>
            </div>
            <div class="separator"></div>
            <nav>
                <ul>
                    <li>
                        <a href="#" class="active">
                            <div class="icon-box">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <span>Главная</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-box">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </div>
                            <span>Чат</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-box">
                                <ion-icon name="settings-outline"></ion-icon>
                            </div>
                            <span>Настройки</span>
                        </a>
                    </li>
                    <li>
                        <a href="/public/logout.php">
                            <div class="icon-box">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                            <span>Выход</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="article_wrap">
        <article>
            <div class="content">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Apple_Developer_brandmark.svg/2560px-Apple_Developer_brandmark.svg.png" alt="Developer" height="100px">
            <div class="content-text">
                <span>Email: <? echo htmlspecialchars($currentUser['username']); ?>!</span>
                <span>Вы <font style="color: rgb(122, 219, 100);">успешно</font> вошли в систему!</span>
                </div>
            </div>
        </article>

        <article>
            <div class="content">
            <div class="content-text">
                <p>... какая-то информация</p>
                </div>
            </div>
        </article>
        <article>
            <div class="content">
            <div class="content-text">
                <p>... какая-то информация</p>
                </div>
            </div>
        </article>
        </div>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html> 