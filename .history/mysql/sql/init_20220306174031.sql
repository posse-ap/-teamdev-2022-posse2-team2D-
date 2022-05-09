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

DROP TABLE IF EXISTS `person_data`;

CREATE TABLE `person_data` (
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `date` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL `lang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL `time` INT NOT NULL
);

INSERT INTO
    `person_data`
SET
    `date` = '2022年 03月 06日' `content` = 'N予備校' `lang` = 'HTML' `time` = 10;

INSERT INTO
    `person_data`
SET
    `date` = '2022年 03月 05日' `content` = 'ドットインストール' `lang` = 'css' `time` = 5;