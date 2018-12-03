DROP DATABASE IF EXISTS HireMeDB;
CREATE DATABASE HireMeDB;
USE HireMeDB;

CREATE TABLE Users (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 firstname VARCHAR(32) DEFAULT NULL,
 lastname VARCHAR(32) DEFAULT NULL,
 password VARCHAR(60) DEFAULT NULL,
 telephone VARCHAR(16) DEFAULT NULL,
 email VARCHAR(32) DEFAULT NULL,
 date_joined VARCHAR(32) DEFAULT NULL
);

/*INSERT INTO Users(id, firstname, lastname, password, telephone, email, date_joined) 
          VALUES (1, 'Zephyr', 'Cornelius', MD5('password123'),'876-372-5829','admin@hireme.com','25/11/2018');*/
          
INSERT INTO Users(id, firstname, lastname, password, telephone, email, date_joined) 
          VALUES (1, 'Zephyr', 'Cornelius', '$adminPassword', '876-372-5829','admin@hireme.com','$adminDate'); 

/*INSERT INTO Users(id, firstname, lastname, password, telephone, email, date_joined) 
          VALUES (1, 'Zephyr', 'Cornelius', password_hash("password123",PASSWORD_DEFAULT), '876-372-5829','admin@hireme.com','$25/11/2018'); */

            

CREATE TABLE Jobs (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 job_title VARCHAR(32) DEFAULT NULL,
 job_description VARCHAR(255) DEFAULT NULL,
 category VARCHAR(32) DEFAULT NULL,
 company_name VARCHAR(32) DEFAULT NULL,
 company_location VARCHAR(32) DEFAULT NULL,
 date_posted VARCHAR(32) DEFAULT NULL
);

CREATE TABLE Jobs_Applied_For (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 job_id VARCHAR(16) DEFAULT NULL,
 user_id VARCHAR(16) DEFAULT NULL,
 date_applied VARCHAR(32) DEFAULT NULL
);