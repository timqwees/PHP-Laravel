<?php
const DB_HOST = 's125.craft-hosting.ru'; //имя хостинга
const DB_PORT = '3306'; //порт хостинга
const DB_NAME = 'bdp472_s1'; // имя папки базы данных
const DB_USERNAME = 'bdp472_s1'; // логин от БД
const DB_PASSWORD = '123456'; // Пароль от БД

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    surname VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    patronymic VARCHAR(50),
    gender ENUM('male', 'female') NOT NULL,
    birthdate DATE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT,
    email VARCHAR(100),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

try {
    $pdo->exec($sql);
} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>