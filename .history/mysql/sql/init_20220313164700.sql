DROP SCHEMA IF EXISTS webapp;

CREATE SCHEMA webapp;

USE webapp;
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


DROP TABLE IF EXISTS `study_languages`;
CREATE TABLE `study_languages` (
`id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
`study_language` VARCHAR(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
`color` VARCHAR(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL 
);

INSERT INTO `study_languages` (`study_language`, `color`) VALUES
('JavaScript','1754EF'),
('CSS','1071BD'),
('PHP','20BEDE'),
('HTML', '3CCEFE'),
('Lalavel','B29EF3'),
('SQL','6D46EC'),
('SHELL','4A18EF'),
('情報システム基礎知識（その他)','3105C0');

DROP TABLE IF EXISTS `study_contents`;
CREATE TABLE `study_contents` (
`id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
`study_content` VARCHAR(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
`color` VARCHAR(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL 
);

INSERT INTO `study_contents` (`study_content`, `color`) VALUES
('ドットインストール','1754EF'),
('N予備校','1071BD'),
('POSSE課題','20BEDE');

DROP TABLE IF EXISTS `study_data`;
CREATE TABLE `study_data` (
`id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
`study_date` datetime NOT NULL,
`study_language_id` INT NOT NULL,
`study_content_id` INT NOT NULL,
`study_hour` INT NOT NULL
);

INSERT INTO `study_data` (`study_date`, `study_language_id`, `study_content_id`, `study_hour`) VALUES
('2021-12-3', 3, 0, 4),
('2021-12-8', 2, 0, 2),
('2021-12-9', 4, 0, 6),
('2022-3-1', 0, 1, 4),
('2022-3-6', 0, 2, 1);

