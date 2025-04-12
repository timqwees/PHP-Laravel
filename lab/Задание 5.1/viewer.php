<?php
require_once __DIR__ . '/db.php';

function getContactsTable($page = 1, $sort = 'date')
{
 global $pdo;

 $perPage = 10;
 $offset = ($page - 1) * $perPage;

 // Determine sort order
 $sortColumns = [
  'date' => 'created_at',
  'surname' => 'surname',
  'birthdate' => 'birthdate'
 ];

 $sortColumn = $sortColumns[$sort] ?? 'created_at';

 // Get total number of records
 $stmt = $pdo->query("SELECT COUNT(*) FROM contacts");
 $total = $stmt->fetchColumn();
 $totalPages = ceil($total / $perPage);

 // Get contacts for current page
 $sql = "SELECT * FROM contacts ORDER BY $sortColumn LIMIT $offset, $perPage";
 $stmt = $pdo->query($sql);
 $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

 $html = '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin-bottom: 20px;">';
 $html .= '<tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Пол</th><th>Дата рождения</th><th>Телефон</th><th>Адрес</th><th>Email</th><th>Комментарий</th></tr>';

 foreach ($contacts as $contact) {
  $html .= '<tr>';
  $html .= '<td>' . htmlspecialchars($contact['surname']) . '</td>';
  $html .= '<td>' . htmlspecialchars($contact['name']) . '</td>';
  $html .= '<td>' . htmlspecialchars($contact['patronymic']) . '</td>';
  $html .= '<td>' . ($contact['gender'] === 'male' ? 'Мужской' : 'Женский') . '</td>';
  $html .= '<td>' . $contact['birthdate'] . '</td>';
  $html .= '<td>' . htmlspecialchars($contact['phone']) . '</td>';
  $html .= '<td>' . htmlspecialchars($contact['address']) . '</td>';
  $html .= '<td>' . htmlspecialchars($contact['email']) . '</td>';
  $html .= '<td>' . htmlspecialchars($contact['comment']) . '</td>';
  $html .= '</tr>';
 }

 $html .= '</table>';

 if ($totalPages > 1) {
  $html .= '<div style="text-align: center;">';
  for ($i = 1; $i <= $totalPages; $i++) {
   $activeClass = ($i === $page) ? ' style="color: red;"' : '';
   $html .= '<a href="index.php?action=view&page=' . $i . '&sort=' . $sort . '"' . $activeClass . ' style="margin: 0 5px; text-decoration: none; border: 2px solid transparent;" onmouseover="this.style.border=\'2px solid #000\'" onmouseout="this.style.border=\'2px solid transparent\'">' . $i . '</a>';
  }
  $html .= '</div>';
 }

 return $html;
}
?>