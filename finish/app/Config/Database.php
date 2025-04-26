<?php

namespace App\Config;

class Database {
    // Параметры подключения к базе данных

    private const DB_HOST = 's125.craft-hosting.ru'; //имя хостинга
    private const DB_PORT = '3306'; //порт хостинга
    private const DB_USERNAME = 'bdp472_s1'; // логин от БД
    private const DB_PASSWORD = '123456'; // Пароль от БД
    private const DB_NAME = 'bdp472_s1'; // имя папки базы данных
    // Получение PDO соединения
    public static function getConnection() {
        try {
            $dsn = "mysql:host=" . self::DB_HOST . ";port=" . self::DB_PORT . ";dbname=" . self::DB_NAME;
            $pdo = new \PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;    
        } catch(\PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
} 