<?php
require_once __DIR__ . '/db.php';

function getDeleteList()
{
  global $pdo;

  $html = '<div style="max-width: 600px; margin: 0 auto;">';

  // Handle deletion if ID is provided
  if (isset($_GET['id'])) {
    $result = deleteContact($_GET['id']);
    if ($result) {
      $html .= '<p style="color: green;">Запись удалена</p>';
    } else {
      $html .= '<p style="color: red;">Ошибка: запись не удалена</p>';
    }
  }

  // Get all contacts
  $stmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname, name");
  $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (empty($contacts)) {
    $html .= '<p>Нет записей для удаления</p>';
  } else {
    $html .= '<ul>';
    foreach ($contacts as $contact) {
      $html .= '<li><a href="index.php?action=delete&id=' . $contact['id'] . '">' .
        htmlspecialchars($contact['surname'] . ' ' . $contact['name']) . '</a></li>';
    }
    $html .= '</ul>';
  }

  $html .= '</div>';
  return $html;
}

function deleteContact($id)
{
  global $pdo;

  try {
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
    return $stmt->execute([$id]);
  } catch (PDOException $e) {
    return false;
  }
}
?>