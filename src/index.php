<?php
session_start();
require(dirname(__FILE__) . "/dbconnect.php");

$stmt = $db->query('SELECT id, title FROM events');
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル</title>
</head>
<ul>
    <?php foreach ($events as $key => $event) : ?>
        <li>
            <?= $event["id"]; ?>:<?= $event["title"]; ?>
        </li>
    <?php endforeach; ?>
    <a href="../admin/login.php">管理者ページ</a>
    <a href="/user/application_form/index.php">申し込みページ</a>
    <a href="/html/index.html">メールの送信テスト</a>
</ul>

<body>
</body>

</html>