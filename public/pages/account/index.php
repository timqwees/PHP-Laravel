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

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\User\User;
use App\Models\Article\Article;
use App\Models\Network\Network;
use App\Models\Network\Message;

// Проверяем авторизацию
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connect message[]
$message = Message::controll();
//connect userModel
$userModel = new User();
//connect articleModel
$articleModel = new Article();

if (isset($_SESSION['user']['id'])) {
    $currentUser = $userModel->getUser('id', $_SESSION['user']['id']);
    if ($currentUser) {
        $articles = $articleModel->getListMyArticle($currentUser['id']);
    } else {
        Message::set('error', 'Пользователь не найден');
        Network::onRedirect(Network::$path_login);
        exit();
    }
} else {
    $currentUser = false;
    Message::set('error', 'Вы не авторизованы');
    Network::onRedirect(Network::$path_login);
    exit();
}

//post update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $newGroup = (int) $_POST['group'] ?? 0;
    if ($newGroup >= 100 && $newGroup <= 999) {
        $userModel->onUpdateProfile(User::$table_users, ['group' => $newGroup], $_SESSION['user']['id']);
        $currentUser['group'] = $newGroup;
        Message::set('success', 'Профиль успешно обновлен');
    } else {
        Message::set('error', 'Неверный номер группы');
    }
}

// Обработка создания статьи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_article'])) {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (empty($title) || empty($content)) {
        Message::set('error', 'Пожалуйста, заполните все поля');
    } else {
        $articleModel = new Article();
        if ($articleModel->addArticle($title, $content, $_SESSION['user']['id'])) {
            Message::set('success', 'Статья успешно создана');
        } else {
            Message::set('error', 'Ошибка при создании статьи');
        }
    }
}

//HTML
include __DIR__ . '/view/index.html';
?>