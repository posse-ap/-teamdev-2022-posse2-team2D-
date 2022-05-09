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

    