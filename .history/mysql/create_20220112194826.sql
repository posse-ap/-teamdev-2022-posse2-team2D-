SET CHARSET UTF8;
CREATE DATABASE IF NOT EXISTS quizy DEFAULT CHARACTER SET utf8;

USE quizy;
CREATE TABLE IF NOT EXISTS big_questions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

-- choicesテーブル



DROP TABLE IF EXISTS `choices`;
CREATE TABLE `choices`(
  `id` INT NOT NULL,
  `question_id` INT NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `valid` INT NOT NULL
);


