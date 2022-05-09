<?php
require('../dbconnect.php');

if (isset($_GET['question_id'])) {
  $question_id = htmlspecialchars($_GET['question_id']);
  $stmt = $db->prepare('SELECT * FROM questions WHERE big_question_id = ?');
  $stmt->execute(array($question_id));
  $questions = $stmt->fetchAll();
} else {
  header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>quizy</title>
  <link href="https://storage.googleapis.com/google-code-archive-downloads/v2/code.google.com/html5resetcss/html5reset-1.6.css">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <div class="main">
    <?php foreach ($questions as $index => $question) : ?>
      <?php
      $question_index = $index + 1;
      $stmt = $db->prepare('SELECT * FROM choices WHERE question_id = ?');
      $stmt->execute(array($question['id']));
      $choices = $stmt->fetchAll();
      $stmt = $db->prepare('SELECT id, name FROM choices WHERE question_id = ? AND valid = 1');
      $stmt->execute(array($question['id']));
      $answer = $stmt->fetch();
      ?>
      <div class="quiz">
        <h1><?php echo $question_index; ?>. この地名はなんて読む？</h1>
        <img src="/img/<?php echo $question['image']; ?>">
        <ul>
          <?php foreach ($choices as $index => $choice) : ?>
            <li
              id="answerlist_<?php echo $question_index . '_' . ($index + 1); ?>" name="answerlist_<?php echo $question_index; ?>"
              class="answerlist"
              onclick="check(
                <?php echo $question_index; ?>,
                <?php echo ($index + 1); ?>,
                <?php echo $answer['id'] - (($question['id'] - 1) * 3); ?>
              )"
            >
              <?php echo $choice['name']; ?>
            </li>
          <?php endforeach; ?>
          <li id="answerbox_<?php echo $question_index; ?>" class="answerbox">
            <span id="answertext_<?php echo $question_index; ?>"></span><br>
            <span>
              正解は「
              <?php echo $answer['name']; ?>
              」です！
            </span>
          </li>
        </ul>
      </div>
    <?php endforeach; ?>
    <script src="/js/main.js"></script>
  </div>
</body>

</html>