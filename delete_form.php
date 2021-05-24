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
<link rel="stylesheet" href="style.css">
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

  <div class="questionーbox">
    <label class="valign">問題:</label>
    <textarea class="text-size text-size-h250" rows="10" cols="60"　readonly><?php echo $question["question"] ?></textarea>

    <p>
      <label>答え:</label>
    </p>
    <?php foreach ($answers as $answer) : ?>
    <p>
      <input type="text" name="example" value="<?php echo $answer["answer"] ?>" class="text-size"　readonly>
    </p>
    <?php endforeach; ?>
  </div>

  <div class="center">
    <a href="list.php">
      <input type="button" value="戻る">
    </a>
    <form action="delete.php" method="post">
        <input type="submit" value="削除" >
        <input type="hidden"  name="id" value="<?php echo $question["id"] ?>" readonly>
    </form>
  </div>


</main>
</body>
</html>