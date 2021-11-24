CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

-- USERS

USE appDB;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `balance` int DEFAULT 5000,
  `e-balance` int DEFAULT 0,
  PRIMARY KEY (`id`)
);
