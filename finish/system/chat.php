<?php
header('Content-Type: application/json');
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/helpers.php";

// Получение сообщений
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $query = "SELECT * FROM messages ORDER BY created_at DESC";
  $result = $conn->query($query);
  $messages = [];

  while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
  }
  echo json_encode($messages);
}

// Отправка сообщения
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = $_POST['user'];
  $icon = $_POST['icon'];
  $message = $_POST['message'];
  $stmt = $conn->prepare("INSERT INTO messages (user, message, icon) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $user, $message, $icon);
  $stmt->execute();
  $stmt->close();
}

$conn->close();
?>