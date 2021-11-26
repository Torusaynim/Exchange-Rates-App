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

-- CRYPTO RATES

USE appDB;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` varchar(20) NOT NULL,
  `posted` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

SET GLOBAL event_scheduler = ON;

CREATE EVENT update_rates ON SCHEDULE EVERY 1 SECOND
DO INSERT INTO rates(price, posted) VALUES(ROUND((RAND() * (3000 - 300)) + 300), NOW());
