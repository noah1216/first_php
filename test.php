<?php

try {
  $dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
  
  } catch(PDOException $e) {
    echo $e->getMessage();
  }

// question取得
$sql = "SELECT * FROM questions";
$stmt = $dbh->query($sql);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
shuffle($questions);

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

<form action="result.php" method="post">
<?php $counter = 1; ?>
<?php foreach ($questions as $question) : ?>
  <div>
      <p>
        <label>問題:</label>
        <label><?php echo $counter ?></label>
        <input type="text" name="question" value="<?php echo $question["question"] ?>" class="text-size">
      </p>

      <p>
        <label>回答　</label>
        <input type="text"  name="answer[]" value="回答">
        <input type="hidden" name="questionId[]" value="<?php echo $question["id"] ?>" readonly>
      </p>
    <div>
  <?php $counter =  $counter + 1;?>
  <br>

  <?php endforeach; ?>
  <p>
    <input type="submit" value="採点" >
  </p>
</form>

</main>
</body>
</html>