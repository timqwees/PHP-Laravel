<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/config.php';

/*
@description - регистрация профиля
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['group'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $group = $_POST["group"];

    $pdo = getPDO();

    $query = "INSERT INTO users (`username`, `group`, `password`, `pass`) VALUES (:username, :group, :password, :pass)";

    $params = [
        'username' => $username,
        'group' => $group,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'pass' => pass_send($password)
    ];

    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute($params);
        echo "<script>alert('вы зарегестрировались');window.location.href = '../index.php';</script>";
    } catch (\Exception $e) {
        die($e->getMessage());
    }
}
/*
@description - авторизация профиля
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tracer_check_forms'])) {

    $username = $_POST['tracer_check_forms'] ?? null;
    $user = findUser($username);
    $_SESSION['user']['id'] = $user['id'];
    redirect("/index.php");
}