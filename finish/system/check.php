<?php
header('Content-Type: application/json');
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/helpers.php";

$action = $_GET['action'] ?? '';
$username = $_GET["username"] ?? '';

// Sanitize input if needed
$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

switch ($action) {
    case 'username':
        // Подготовка запроса для проверки существующего пользователя с такой же почтой
        $stmt = $conn->prepare("SELECT count(*) FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($userCount);
        $stmt->fetch();
        $stmt->close();

        $response = [
            'exists' => $userCount > 0,
        ];

        echo json_encode($response);
        break;
    case 'password':
        // Подготовка запроса для проверки существующего пользователя с такой же почтой
        $stmt = $conn->prepare("SELECT pass FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($pass);
        $stmt->fetch();
        $stmt->close();

        $response = [
            'exists' => !empty($username),
            'password' => pass_back($pass)
        ];

        echo json_encode($response);
}
$conn->close();
?>