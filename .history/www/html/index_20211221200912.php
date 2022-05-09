<?php

// echo phpinfo();

// ドライバ呼び出しを使用して MySQL データベースに接続します
$dsn = 'mysql:dbname=quizy;charset=utf8;host=db';
$user = 'naoki';
$password = 'password';

try {
    $dbh = new PDO($dsn, $user, $password);
    // $dbh = new PDO(
    //     'mysql:host=db;dbname=quizy;charset=utf8mb4',
    //     'naoki',
    //     'password'
    // );
    echo "接続成功\n";
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizy</title>
    <link rel="stylesheet" href="POSSE課題1.css">
</head>
<body>  <span class="question"><h4>1. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/quiz/34d20397a2a506fe2c1ee636dc011a07.png
        " alt="高輪"><br>
        <button onclick="No1Judgment0()" class="before" id="No1Answer0"><div id="takanawa0"></div></button><br>
        <button onclick="No1Judgment1()" class="before" id="No1Answer1"><div id="takanawa1"></div></button><br>
        <button onclick="No1Judgment2()" class="before" id="No1Answer2"><div id="takanawa2"></div></button><br>
        <div class="blue-nothing" id="No1CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No1CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No1CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No1CommentFalse"></div>
        </div>

        <span class="question"><h4>2. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/quiz/512b8146e7661821c45dbb8fefedf731.png
        " alt="亀戸"><br>
        <button onclick="No2Judgment0()" id ='No2Answer0' class = "before"><div id="kameido0"></div></button><br>
        <button onclick="No2Judgment1()" id='No2Answer1' class="before"><div id="kameido1"></div></button><br>
        <button onclick="N02Judgment2()" id='No2Answer2' class="before"><div id="kameido2"></div></button><br>
        <div class="blue-nothing" id="No2CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No2CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No2CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No2CommentFalse"></div>
        </div>

        <span class="question"><h4>3. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/quiz/ad4f8badd896f1a9b527c530ebf8ac7f.png
        " alt="麹町"><br>
        <button onclick="No3Judgment0();" class="before" id="No3Answer0">こうじまち</button><br>
        <button onclick="No3Judgment1();" class="before" id="No3Answer1">かゆまち</button><br>
        <button onclick="No3Judgment2();" class="before" id="No3Answer2">おかとまち</button><br>
        <div class="blue-nothing" id="No3CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No3CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No3CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No3CommentFalse"></div>
        </div>

        <span class="question"><h4>4. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/quiz/ee645c9f43be1ab3992d121ee9e780fb.png
        " alt="御成門"><br>
        <button onclick="No4Judgement0();"id="No4Answer0" class="before">おなりもん</button><br>
        <button onclick="No4Judgement1();" id="No4Answer1" class="before">おかどもん</button><br>
        <button onclick="No4Judgement2();" id="No4Answer2" class="before">ごせいもん</button><br>
        <div class="blue-nothing" id="No4CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No4CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No4CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No4CommentFalse"></div>
        </div>

        <span class="question"><h4>5. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/quiz/6a235aaa10f0bd3ca57871f76907797b.png
        " alt="等々力"><br>
        <button onclick="No5Judgement0();"id="No5Answer0" class="before">とどりき</button><br>
        <button onclick="No5Judgement1();" id="No5Answer1" class="before">たたら</button><br>
        <button onclick="No5Judgement2();" id="No5Answer2" class="before">たたりき</button><br>
        <div class="blue-nothing" id="No5CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No5CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No5CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No5CommentFalse"></div>
        </div>

        <span class="question"><h4>6. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/quiz/0b6789cf496fb75191edf1e3a6e05039.png
        " alt="石神井"><br>
        <button onclick="No6Judgement0();"id="No6Answer0" class="before">しゃくじい</button><br>
        <button onclick="No6Judgement1();" id="No6Answer1" class="before">せきこうい</button><br>
        <button onclick="No6Judgement2();" id="No6Answer2" class="before">いじい</button><br>
        <div class="blue-nothing" id="No6CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No6CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No6CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No6CommentFalse"></div>
        </div>

        <span class="question"><h4>7. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/quiz/23e698eec548ff20a4f7969ca8823c53.png
        " alt="雑色"><br>
        <button onclick="No7Judgement0();"id="No7Answer0" class="before">ぞうしき</button><br>
        <button onclick="No7Judgement1();" id="No7Answer1" class="before">ざっしき</button><br>
        <button onclick="No7Judgement2();" id="No7Answer2" class="before">ざっしょく</button><br>
        <div class="blue-nothing" id="No7CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No7CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No7CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No7CommentFalse"></div>
        </div>

        <span class="question"><h4>8. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/quiz/50a753d151d35f8602d2c3e2790ea6e4.png
        " alt="御徒町"><br>
        <button onclick="No8Judgement0();"id="No8Answer0" class="before">おかちまち</button><br>
        <button onclick="No8Judgement1();" id="No8Answer1" class="before">みとちょう</button><br>
        <button onclick="No8Judgement2();" id="No8Answer2" class="before">ごしろちょう</button><br>
        <div class="blue-nothing" id="No8CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No8CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No8CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No8CommentFalse"></div>
        </div>

        <span class="question"><h4>9. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/words/8cad76c39c43e2b651041c6d812ea26e.png
        " alt="鹿骨"><br>
        <button onclick="No9Judgement0();"id="No9Answer0" class="before">ししぼね</button><br>
        <button onclick="No9Judgement1();" id="No9Answer1" class="before">ろっこつ</button><br>
        <button onclick="No9Judgement2();" id="No9Answer2" class="before">しこね</button><br>
        <div class="blue-nothing" id="No9CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No9CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No9CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No9CommentFalse"></div>
        </div>

        <span class="question"><h4>10. この地名はなんて読む？</h4></span>
        <img src="https://d1khcm40x1j0f.cloudfront.net/words/34508ddb0789ee73471b9f17977e7c9c.png
        " alt="小榑"><br>
        <button onclick="No10Judgement0();"id="No10Answer0" class="before">こぐれ</button><br>
        <button onclick="No10Judgement1();" id="No10Answer1" class="before">こばく</button><br>
        <button onclick="No10Judgement2();" id="No10Answer2" class="before">こしゃく</button><br>
        <div class="blue-nothing" id="No10CommentBlue"> 
            <span class="blue-line">正解！</span><br>
            <div id="No10CommentTrue"></div>
        </div>
        <div class="red-nothing" id="No10CommentRed">
            <span class="red-line">不正解！</span><br>
            <div id="No10CommentFalse"></div>
        </div>

        <script src="POSSE課題1.js"></script>
</body>
</html>