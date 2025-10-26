-- Database schema for BookShare (MySQL)
CREATE DATABASE IF NOT EXISTS bookshare_php CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bookshare_php;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(200) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  university VARCHAR(200) DEFAULT NULL,
  major VARCHAR(200) DEFAULT NULL,
  avatar VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(300) NOT NULL,
  author VARCHAR(200) DEFAULT NULL,
  book_condition ENUM('new','good','used','worn') DEFAULT 'used',
  type ENUM('lend','exchange','sell') DEFAULT 'lend',
  price DECIMAL(8,2) DEFAULT NULL,
  description TEXT DEFAULT NULL,
  image VARCHAR(255) DEFAULT NULL,
  owner_id INT,
  etat ENUM('available','reserved','sold') DEFAULT 'available',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE SET NULL
);

