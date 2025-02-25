<?php
// PDO
const DB_HOST = 's125.craft-hosting.ru'; //имя хостинга
const DB_PORT = '3306'; //порт хостинга
const DB_NAME = 'bdp472_s1'; // имя папки базы данных
const DB_USERNAME = 'bdp472_s1'; // логин от БД
const DB_PASSWORD = '123456'; // Пароль от БД

//don't pdo
$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die($conn->connect_error);
    echo "<script>console.warn(`$conn->connect_error`);</script>";
    alert('ошибка подключения к базе-данных');
}
?>