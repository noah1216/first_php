<?php
$id = $_POST['id'];
$answers = $_POST['answer'];
$answerIds = $_POST['answerIds'];
$question1 = $_POST['question'];
try {
  $dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />

<title>タイトル</title>
</head>
<body>
<main>
  <div class="header-box">
    <a href="top.php">
      <input type="button" value="top" class="b-size magin-l10">
    </a>
    <a href="logout.php">
      <input type="button" value="logout" class="b-size magin-l10">
    </a>
  </div>

  <div class="edit-numder">
    <label>問題番号:</label>
    <label class="number"><?php echo $id ?></label>
  </div>

  <div class="buttonsize-box">
    <form action="edit.php" method="post">
      <label class="valign">問題:</label>
      <input type="hidden"  name="id" value="<?php echo $id ?>" class="text-size84">
      <input type="text"  name="question" value="<?php echo $question1 ?>" class="text-size84">
      <div>
        <label>答え:</label>
        <?php foreach ($answers as $answer) : ?>
        <p>
          <input type="text"  name="answer[]" value="<?php echo $answer ?>" class="text-size84">
          <input type="button" value="削除" >
        </p>
        <?php endforeach; ?>
      </div>

      <?php foreach ($answerIds as $answer_id) : ?>
        <input type="hidden"  name="answerIds[]" value="<?php echo $answer_id ?>" class="text-size84">
      <?php endforeach; ?>

      <input type="submit" value="更新" >
    </form>     
      <form action="edit_form.php" method="post">
        <input type="hidden"  name="id" value="<?php echo $id ?>" class="text-size84">  
        <input type="submit" value="戻る">
      </form>
</main>
</body>
</html>