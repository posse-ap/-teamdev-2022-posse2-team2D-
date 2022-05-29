<?php
    // $headers = "MIME-Version: 1.0\r\n"
    // . "Content-Transfer-Encoding: 7bit\r\n"
    // . "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
</head>

<body>
    <?php
    // mb_language("Japanese");
    // mb_internal_encoding("UTF-8");
    $from = 'from@example.com';
    $to = $_POST['to'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $ret = mb_send_mail($to, $title, $content, "From: {$from} \r\n");
    var_dump($ret);
    ?>
</body>

</html>