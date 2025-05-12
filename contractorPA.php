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

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User\User;
use App\Models\Article\Article;
use App\Models\Network\Network;

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$userModel = new User();
$userModel->onSessionUser($_SESSION['user']['id'] ?? 0);
//check session user 
//проверка на авторизацию

$currentUser = $userModel->getUser('id', $_SESSION['user']['id']);

if (!$currentUser) {
  session_destroy();
  Network::onRedirect('/log-in.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exit'])) {
  if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
    $userModel->updateSessionStatus('off', $_SESSION['user']['id']);
    session_destroy();
    Network::onRedirect('/log-in.php');
    exit;
  }
}

// Обработка создания поста услуги
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_article'])) {
  $title = trim($_POST['title'] ?? '');
  $description = trim($_POST['description'] ?? '');

  if (empty($title) || empty($description)) {
    $_SESSION['error'] = 'Пожалуйста, заполните все поля';
  } else {
    $articleModel = new Article();
    if ($articleModel->addArticle($title, $description, $_SESSION['user']['id'])) {
      $_SESSION['success'] = 'Статья успешно создана';
    } else {
      $_SESSION['error'] = 'Ошибка при создании статьи';
    }
  }
}

// Обработка обновления профиля
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['profile__form'])) {
  $fields = [
    'username' => $_POST['username'] ?? '',
    'phone' => $_POST['phone'] ?? '',
    'mail' => $_POST['mail'] ?? '',
    'company' => $_POST['company'] ?? '',
    'avatar' => $_POST['avatar'] ?? ''
  ];

  // Обработка загрузки аватара
  if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    // Получаем желаемое имя файла из формы или используем имя пользователя
    $customName = $_POST['avatar_name'] ?? $_POST['username'] ?? null;
    $avatarPath = $userModel->uploadFile($_FILES['avatar'], $_SESSION['user']['id'], $customName);
    if ($avatarPath !== false) {
      $fields['avatar'] = $avatarPath;
    } else {
      $_SESSION['error'] = 'Ошибка при загрузке аватара';
    }
  }

  if ($userModel->onUpdateProfile('users', $fields, $_SESSION['user']['id'])) {
    $_SESSION['success'] = 'Профиль успешно обновлен';
  } else {
    $_SESSION['error'] = 'Ошибка при обновлении профиля';
  }

  Network::onRedirect('/contractorPA.php');
}

// Получаем все статьи
$articleModel = new Article();
$articles = $articleModel->getArticleAll();
$listMyArticle = $articleModel->getListMyArticle();

//HTML
include __DIR__ . '/viewHTML/account.html';
?>