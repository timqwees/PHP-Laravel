-- Create users table if it doesn't exist
CREATE TABLE IF NOT EXISTS `users` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mail varchar(50) NOT NULL,
            username varchar(50) NOT NULL,
            password varchar(255) NOT NULL,
            session VARCHAR(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `posters` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    FOREIGN KEY (user_id) REFERENCES users(id)
); 