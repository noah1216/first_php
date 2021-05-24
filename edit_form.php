<?php
  $id = $_POST['id'];

  try {
    $dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

  // idでquestionの取得
  $sql = "SELECT * FROM questions WHERE id = :id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id);
  $stmt->execute();
  $question = $stmt->fetch();


    // idでanswerの取得
    $sql2 = "SELECT * FROM correct_answers WHERE questions_id = :id";
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->bindValue(':id', $id);
    $stmt2->execute();
    $answers = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
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
    <label class="number"><?php echo $question["id"] ?></label>
  </div>

  <div class="buttonsize-box">
    <form action="edit_confirm.php" method="post">
      <label class="valign">問題:</label>
      <input type="text"  name="question" value="<?php echo $question["question"] ?>" class="text-size84">
      <div>
        <label>答え:</label>
        <?php foreach ($answers as $answer) : ?>
        <p>
          <input type="text"  name="answer[]" value="<?php echo $answer["answer"] ?>" class="text-size84">
          <input type="hidden"  name="answerIds[]" value="<?php echo $answer["id"] ?>" class="text-size84">
          <input type="button" value="削除" >
        </p>
        <?php endforeach; ?>
      </div>

      <a href="list.php">
        <input type="button" value="戻る">
      </a>
      <input type="submit" value="確認" >
      <input type="button" value="追加" >
      <input type="hidden"  name="id" value="<?php echo $question["id"] ?>" class="text-size84">
    </form>
    
  </div>
</main>
</body>
</html>