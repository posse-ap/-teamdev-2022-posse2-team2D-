-- SET CHARSET UTF8;
-- CREATE DATABASE IF NOT EXISTS quizy DEFAULT CHARACTER SET utf8;

-- USE quizy;
-- CREATE TABLE IF NOT EXISTS big_questions(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255)
-- );

-- choicesテーブル
CREATE TABLE IF NOT EXISTS choices(
    id INT NOT NULL,
    question_id INT NOT NULL,
    name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
    valid INT NOT NULL
);

