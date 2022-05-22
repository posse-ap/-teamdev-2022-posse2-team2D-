DROP SCHEMA IF EXISTS db_mydb;

CREATE SCHEMA db_mydb;

USE db_mydb;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    user_img VARCHAR(255) UNIQUE NOT NULL,
    agent_id INT NOT NULL,
    name VARCHAR(255) UNIQUE NOT NULL,
    department_name VARCHAR(255) NOT NULL,
    tel VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS admin;

CREATE TABLE admin (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    user_img VARCHAR(255) UNIQUE NOT NULL,
    agent_id INT NOT NULL,
    name VARCHAR(255) UNIQUE NOT NULL,
    department_name VARCHAR(255) NOT NULL,
    tel VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
);

INSERT INTO
    admin
SET
    user_img = 'ポセ男',
    agent_id = 1,
    name = 'ポセ男',
    department_name = '人事部',
    tel = '000-1111',
    email = 'test@posse-ap.com',
    password = sha1('password');



DROP TABLE IF EXISTS apply_info;

CREATE TABLE apply_info (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` VARCHAR(225) NOT NULL,
    `kana` VARCHAR(225) NOT NULL,
    `tel` VARCHAR(225) NOT NULL,
    `email` VARCHAR(225) NOT NULL,
    `college` VARCHAR(225) NOT NULL,
    `faculty` VARCHAR(225) NOT NULL,
    `graduate_year` VARCHAR(225) NOT NULL,
    `adress` VARCHAR(225) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



DROP TABLE IF EXISTS userpassreset;

CREATE TABLE `userpassreset` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `token` TEXT NOT NULL,
    `mail` TEXT NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS agent;

CREATE TABLE `agent` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `agent_name` TEXT NOT NULL,
    `link` TEXT NOT NULL,
    `image` TEXT NOT NULL,
    `publisher_five` INT NOT NULL,
    `decision_five` INT NOT NULL,
    `speed_five` INT NOT NULL,
    `registstrant_five` INT NOT NULL,
    `place_five` INT NOT NULL,
    `publisher` INT NOT NULL,
    `decision` INT NOT NULL,
    `speed` INT NOT NULL,
    `registstrant` INT NOT NULL,
    `place` INT NOT NULL,
    `main` TEXT NOT NULL,
    `sub` TEXT NOT NULL,
    `step1` TEXT NOT NULL, 
    `step2` TEXT NOT NULL, 
    `step3` TEXT NOT NULL,        
    `mail` TEXT NOT NULL,
    `tel` TEXT NOT NULL
);

CREATE TABLE `tag` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tag_name` TEXT NOT NULL
);

INSERT INTO
    `tag` (`tag_name`)
VALUES
    ('面接対策'),
    ('ES添削'),
    ('1on1'),
    ('オンライン'),
    ('対面'),
    ('非公開求人'),
    ('IT'),
    ('マスコミ'),
    ('商社'),
    ('金融'),
    ('外資'),
    ('総合'),
    ('スタートアップ'),
    ('ベンチャー'),
    ('大手'),
    ('首都圏'),
    ('関西'),
    ('地方');

CREATE TABLE `agent_tag` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `agent_id` INT NOT NULL,
    `tag_id` INT NOT NULL
);



CREATE TABLE `agent_user` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `agent_id` INT NOT NULL,
    `user_id` INT NOT NULL
);


DROP TABLE IF EXISTS edit_agent;

CREATE TABLE `edit_agent` (
    `id` INT NOT NULL,
    `agent_name` TEXT NOT NULL,
    `link` TEXT NOT NULL,
    `image` TEXT NOT NULL,
    `publisher_five` INT NOT NULL,
    `decision_five` INT NOT NULL,
    `speed_five` INT NOT NULL,
    `registstrant_five` INT NOT NULL,
    `place_five` INT NOT NULL,
    `publisher` INT NOT NULL,
    `decision` INT NOT NULL,
    `speed` INT NOT NULL,
    `registstrant` INT NOT NULL,
    `place` INT NOT NULL,
    `main` TEXT NOT NULL,
    `sub` TEXT NOT NULL
);

DROP TABLE IF EXISTS `edit_tag`;

CREATE TABLE `edit_tag` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tag_name` TEXT NOT NULL
);

DROP TABLE IF EXISTS `edit_agent_tag`;

CREATE TABLE `edit_agent_tag` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `agent_id` INT NOT NULL,
    `tag_id` INT NOT NULL
);