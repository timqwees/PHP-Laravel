<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    // Регистрация нового пользователя
    public function register($username, $password, $group) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO users_php (username, password, group_number) VALUES (?, ?, ?)");
            return $stmt->execute([$username, $hashedPassword, $group]);
        } catch(\PDOException $e) {
            return false;
        }
    }
    
    // Авторизация пользователя
    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users_php WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch(\PDOException $e) {
            return false;
        }
    }
    
    // Получение пользователя по ID
    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users_php WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            return false;
        }
    }
    
    // Получение пользователя по имени пользователя
    public function getByUsername($username) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users_php WHERE username = ?");
            $stmt->execute([$username]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            return false;
        }
    }
} 