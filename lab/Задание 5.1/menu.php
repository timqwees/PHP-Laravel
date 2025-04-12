<?php
function getMenu($activeAction = 'view')
{
 $menuItems = [
  'view' => 'Просмотр',
  'add' => 'Добавление записи',
  'edit' => 'Редактирование записи',
  'delete' => 'Удаление записи'
 ];

 $html = '<div style="margin-bottom: 20px;">';

 // Main menu items
 foreach ($menuItems as $action => $title) {
  $activeClass = ($action === $activeAction) ? ' style="color: red;"' : ' style="color: blue;"';
  $html .= '<a href="index.php?action=' . $action . '"' . $activeClass . '>' . $title . '</a> | ';
 }

 $html = rtrim($html, ' | '); // Remove last separator

 // Submenu for view action
 if ($activeAction === 'view') {
  $sortOptions = [
   'date' => 'По дате добавления',
   'surname' => 'По фамилии',
   'birthdate' => 'По дате рождения'
  ];

  $activeSort = isset($_GET['sort']) ? $_GET['sort'] : 'date';

  $html .= '<br><small>';
  foreach ($sortOptions as $sort => $title) {
   $activeClass = ($sort === $activeSort) ? ' style="color: red;"' : ' style="color: blue;"';
   $html .= '<a href="index.php?action=view&sort=' . $sort . '"' . $activeClass . '>' . $title . '</a> | ';
  }
  $html = rtrim($html, ' | ');
  $html .= '</small>';
 }

 $html .= '</div>';
 return $html;
}
?>