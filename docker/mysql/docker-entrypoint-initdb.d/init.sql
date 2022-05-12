DROP SCHEMA IF EXISTS db_mydb;

CREATE SCHEMA db_mydb;

USE db_mydb;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO
  users
SET
  email = 'test@posse-ap.com',
  password = sha1('password');

INSERT INTO
  users
SET
  email = 'naoki1010nissy@gmail.com',
  password = sha1('nn20001010');

DROP TABLE IF EXISTS events;

CREATE TABLE events (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO
  events
SET
  title = 'イベント1';

INSERT INTO
  events
SET
  title = 'イベント2';

  CREATE TABLE `apply_info` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` TEXT NOT NULL ,
  `tel` TEXT NOT NULL ,
  `mail` TEXT NOT NULL ,
  `college` TEXT NOT NULL ,  
  `faculty` TEXT NOT NULL ,  
  `graduate_year` TEXT NOT NULL ,  
  `adress` TEXT NOT NULL ,
  PRIMARY KEY  (`id`)
);

