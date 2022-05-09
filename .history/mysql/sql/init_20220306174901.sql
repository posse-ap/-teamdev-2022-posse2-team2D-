DROP SCHEMA IF EXISTS webapp;

CREATE SCHEMA webapp;

USE webapp;

DROP TABLE IF EXISTS `big_questions`;

CREATE TABLE `big_questions` (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
);

INSERT INTO
    `big_questions`
SET
    name = '東京の難読地名クイズ';

INSERT INTO
    `big_questions`
SET
    name = '広島の難読地名クイズ';
    

DROP TABLE IF EXISTS `choices`;

CREATE TABLE `choices` (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `question_id` INT NOT NULL,
    `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    `valid` TINYINT(1) NOT NULL DEFAULT '0'
);

INSERT INTO
    `choices` (`question_id`, `name`, `valid`)
VALUES
    (1, 'たかなわ', 1),
    (1, 'たかわ', 0),
    (1, 'こうわ', 0),
    (2, 'かめと', 0),
    (2, 'かめど', 0),
    (2, 'かめいど', 1),
    (3, 'むこうひら', 0),
    (3, 'むきひら', 0),
    (3, 'むかいなだ', 1);