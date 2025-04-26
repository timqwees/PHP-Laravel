<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Config\Database;

try {
    $db = Database::getConnection();
    
    // Read and execute the schema.sql file
    $sql = file_get_contents(__DIR__ . '/schema.sql');
    $db->exec($sql);
    
    echo "Database initialized successfully!\n";
} catch (\PDOException $e) {
    die("Error initializing database: " . $e->getMessage() . "\n");
} 