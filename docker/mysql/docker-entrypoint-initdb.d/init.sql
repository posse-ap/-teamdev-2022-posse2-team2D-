DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  company_id INT NOT NULL,
  name VARCHAR(255) UNIQUE NOT NULL,
  department_name VARCHAR(255) NOT NULL,
  tel VARCHAR(255) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO
  users
SET
  company_id = 1,
  name = 'ポセ男',
  department_name = '人事部',
  tel = '000-1111',
  email = 'test@posse-ap.com',
  password = sha1('password');

INSERT INTO
  users
SET
  company_id = 2,
  name = '西山直輝',
  department_name = 'マーケティング部',
  tel = '090-2066-9112',
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

DROP TABLE IF EXISTS apply_info;
  CREATE TABLE `apply_info` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` TEXT NOT NULL ,
  `tel` TEXT NOT NULL ,
  `mail` TEXT NOT NULL ,
  `college` TEXT NOT NULL ,  
  `faculty` TEXT NOT NULL ,  
  `graduate_year` TEXT NOT NULL ,  
  `adress` TEXT NOT NULL ,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS userpassreset;
  CREATE TABLE `userpassreset` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `token` TEXT NOT NULL ,
  `mail` TEXT NOT NULL ,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS agent;
CREATE TABLE `agent` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `agent_name` TEXT NOT NULL ,
  `link` TEXT NOT NULL ,
  `image` TEXT NOT NULL ,
  `publisher` INT NOT NULL ,
  `decision` INT NOT NULL ,
  `speed` INT NOT NULL ,
  `registstrant` INT NOT NULL ,
  `place` INT NOT NULL ,
  `main` TEXT NOT NULL ,
  `sub` TEXT NOT NULL 
);

INSERT INTO
    `agent` (`agent_name`,`link`,`image`,`publisher`,`decision`,`speed`,`registstrant`,`place`,`main`,`sub`)
VALUES
    ('マイナビ', 'https://mynabi.com', 'mynabi', 30000, 50000, 2, 100000, 8, '就活はひとりじゃない、ともに進む就活', '就活サイトでは掲載されてない求人' ),
    ('リクナビ', 'recruitnavi.com', 'recruit', 12000, 60000, 3, 800000, 15, '専任アドバイザーと、見つけよう', 'まだここにない出会い' )