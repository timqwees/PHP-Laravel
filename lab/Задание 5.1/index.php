<?php
require_once __DIR__ . '/menu.php';
require_once __DIR__ . '/viewer.php';
require_once __DIR__ . '/add.php';
require_once __DIR__ . '/edit.php';
require_once __DIR__ . '/delete.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Management System</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container">
    <?php
    // Get current page and action from URL parameters
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $action = isset($_GET['action']) ? $_GET['action'] : 'view';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'date';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

    // Display menu
    echo getMenu($action);

    // Display content based on action
    switch ($action) {
      case 'view':
        echo getContactsTable($page, $sort);
        break;
      case 'add':
        echo getAddForm();
        break;
      case 'edit':
        echo getEditForm($id);
        break;
      case 'delete':
        echo getDeleteList();
        break;
    }
    ?>
  </div>
</body>

</html>