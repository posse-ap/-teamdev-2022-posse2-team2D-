-- SET CHARSET UTF8;
-- CREATE DATABASE IF NOT EXISTS quizy DEFAULT CHARACTER SET utf8;

-- USE quizy;
-- CREATE TABLE IF NOT EXISTS big_questions(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255)
-- );

-- choicesテーブル
-- CREATE TABLE IF NOT EXISTS choices(
--     id INT NOT NULL,
--     question_id INT NOT NULL,
--     name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
--     valid INT NOT NULL
-- );

DROP TABLE IF EXISTS big_questions;
CREATE TABLE big_questions (
  id SMALLINT(4),
  name VARCHAR(255) NOT NULL
);

INSERT INTO big_questions
VALUES
  (1, '東京の難読地名クイズ'),
  (2, '広島県の難読地名クイズ');


DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
  id SMALLINT(4),
  big_question_id SMALLINT(4),
  image VARCHAR(255) NOT NULL
);

INSERT INTO questions
VALUES
  (1, 1, 'takanawa.png'),
  (2, 1, 'kameido.png'),
  (3, 2, 'mukainada.png');

DROP TABLE IF EXISTS choices;
CREATE TABLE choices (
  id SMALLINT(4),
  question_id SMALLINT(4),
  name VARCHAR(255) NOT NULL,
  valid SMALLINT(4)
);

INSERT INTO choices
VALUES
  (1, 1, 'たかなわ', 1),
  (2, 1, 'たかわ', 0),
  (3, 1, 'こうわ', 0),
  (4, 2, 'かめと', 0),
  (5, 2, 'かめど', 0),
  (6, 2, 'かめいど', 1),
  (7, 3, 'むこうひら', 0),
  (8, 3, 'むきひら', 0),
  (9, 3, 'むかいなだ', 1);



