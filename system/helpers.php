<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/config.php';

function redirect(string $path)
{
  header("Location: $path");
  die();
}

function setValidationError(string $fieldName, string $message): void
{
  $_SESSION['validation'][$fieldName] = $message;
}

function hasValidationError(string $fieldName): bool
{
  return isset($_SESSION['validation'][$fieldName]);
}

function validationErrorAttr(string $fieldName): string
{
  return isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function validationErrorMessage(string $fieldName): string
{
  $message = $_SESSION['validation'][$fieldName] ?? '';
  unset($_SESSION['validation'][$fieldName]);
  return $message;
}

function setOldValue(string $key, mixed $value): void
{
  $_SESSION['old'][$key] = $value;
}

function old(string $key)
{
  $value = $_SESSION['old'][$key] ?? '';
  unset($_SESSION['old'][$key]);
  return $value;
}

// function uploadFile(array $file, string $prefix = ''): string
// {
//     $uploadPath = __DIR__ . '/../../avatar';

//     if (!is_dir($uploadPath)) {
//         mkdir($uploadPath, 0777, true);
//     }

//     $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
//     $fileName = $prefix . '_' . time() . ".$ext";

//     if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
//         die('Ошибка при загрузке файла на сервер');
//     }

//     return "avatar/$fileName";
// }

function setMessage(string $key, string $message): void
{
  $_SESSION['message'][$key] = $message;
}

function hasMessage(string $key): bool
{
  return isset($_SESSION['message'][$key]);
}

function getMessage(string $key): string
{
  $message = $_SESSION['message'][$key] ?? '';
  unset($_SESSION['message'][$key]);
  return $message;
}

function getPDO(): PDO
{
  try {
    return new \PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8;dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
  } catch (\PDOException $e) {
    die("Connection error: {$e->getMessage()}");
  }
}

function findUser(string $username): array|bool
{
  $pdo = getPDO();

  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute(['username' => $username]);
  return $stmt->fetch(\PDO::FETCH_ASSOC);
}

function findID(string $id): array|bool
{
  $pdo = getPDO();

  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->execute(['id' => $id]);
  return $stmt->fetch(\PDO::FETCH_ASSOC);
}


function currentUser(): array|false
{
  $pdo = getPDO();

  if (!isset($_SESSION['user'])) {
    return false;
  }

  $userId = $_SESSION['user']['id'] ?? null;

  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->execute(['id' => $userId]);
  return $stmt->fetch(\PDO::FETCH_ASSOC);
}


function logout(): void
{
  unset($_SESSION['user']['id']); /* удаление данных */
  redirect('/login.html'); /*переход на страницу авторизации */
}

function checkAuth(): void
{
  if (!isset($_SESSION['user']['id'])) {
    redirect('/login.html');
  }
}

function pass_send($password)
{
  $encrypted_password = "";
  for ($i = 0; $i < strlen($password); $i++) {
    $char = $password[$i];
    if (ctype_alpha($char)) {
      if (ctype_upper($char)) {
        $encrypted_password .= ord($char) - ord('A') + 1 . " ";
      } else {
        $encrypted_password .= ord($char) - ord('a') + 1 . " ";
      }
    } else {
      $encrypted_password .= $char;
    }
  }
  return trim($encrypted_password);
}

function pass_back($encrypted_password)
{
  if (empty($encrypted_password) || !isset($encrypted_password)) {
    return false;
  }
  $decrypted_password = "";
  $numbers = explode(" ", $encrypted_password);
  foreach ($numbers as $number) {
    if (is_numeric($number)) {
      if ($number > 0 && $number <= 26) {
        $decrypted_password .= chr($number + (ctype_upper($numbers[0]) ? ord('A') - 1 : ord('a') - 1));
      } else {
        $decrypted_password .= $number;
      }
    } else {
      $decrypted_password .= $number;
    }
  }
  return $decrypted_password;
}

function formatDate($date)
{
  // Преобразуем строку даты в объект DateTime
  $dateTime = DateTime::createFromFormat('Y-m-d', $date);

  // Проверяем, правильно ли создан объект DateTime
  if ($dateTime === false) {
    return "Неверная дата";
  }

  // Определяем формат, в котором хотим отобразить дату
  return $dateTime->format('j') . ' ' .
    getMonthName($dateTime->format('n')) . ' ' .
    $dateTime->format('Y') . ' года';
}

function getMonthName($monthNumber)
{
  // Массив названий месяцев на русском языке
  $months = [
    1 => 'января',
    2 => 'февраля',
    3 => 'марта',
    4 => 'апреля',
    5 => 'мая',
    6 => 'июня',
    7 => 'июля',
    8 => 'августа',
    9 => 'сентября',
    10 => 'октября',
    11 => 'ноября',
    12 => 'декабря'
  ];

  return $months[(int) $monthNumber];
}

function formatTime($time)
{
  // Создаем объект DateTime из строки времени
  $timeObj = DateTime::createFromFormat('H:i:s', $time);

  // Проверяем, правильно ли создан объект DateTime
  if ($timeObj === false) {
    return "Неверное время";
  }

  // Возвращаем время в формате HH:MM
  return $timeObj->format('H:i');
}