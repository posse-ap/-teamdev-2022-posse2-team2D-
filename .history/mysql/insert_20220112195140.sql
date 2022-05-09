USE quizy;

SET CHARACTER_SET_CLIENT = utf8;
SET CHARACTER_SET_CONNECTION = utf8;

INSERT INTO big_questions 
    (name) 
VALUES 
    ('東京の難読地名クイズ'),
    ('広島県の難読地名クイズ');

-- ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
-- ALTER USER 'naoki'@'%' IDENTIFIED WITH mysql_native_password BY 'password';

INSERT INTO choices
    (id,question_id,name,valid`) 
VALUES
(1,1,'たかなわ',1),
(2,1,'たかわ',0),
(3,1,'こうわ',0),
(4,2,'むこうひら',0),
(5,2,'むきひら',0),
(6,2,'むかいなだ',1);