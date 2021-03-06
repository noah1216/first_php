<?php
// db接続
try {
  $dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
  
  } catch(PDOException $e) {
    echo $e->getMessage();
  }

// question取得
$sql = "SELECT * FROM questions";
$stmt = $dbh->query($sql);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

//　answer取得
$sql2 = "SELECT * FROM correct_answers";
$stmt = $dbh->query($sql2);
$answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

  <div class="list-center">
    <a href="new.php">
      <input type="button" value="新規登録" class="b-size magin-l10">
    </a>
  </div>

<?php $counter = 1; ?>
<?php $counter2 = 1; ?>
<?php foreach ($questions as $question) : ?>
  <div>
      <p>
        <label>問題:</label>
        <label><?php echo $counter ?></label>
        <input type="text" name="example" value="<?php echo $question["question"] ?>" class="text-size">
      </p>
      <?php foreach ($answers as $answer) : ?>
        <?php if ($answer["questions_id"] == $question["id"]) : ?>
        <p>
          <label>答え<?php echo $counter2 ?>:</label>
          <input type="text" name="example" value="<?php echo $answer["answer"] ?>" class="text-size">
        </p>
        <?php $counter2 =  $counter2 + 1; ?>
        <?php endif; ?>
      <?php endforeach; ?>

    <div>
      <form action="edit_form.php" method="post">
        <input type="hidden" name="id" value="<?php echo $question["id"] ?>" >
        <input type="submit" value="編集">
      </form>
      <form action="delete_form.php" method="post">
        <input type="hidden" name="id" value="<?php echo $question["id"] ?>" >
        <input type="submit" value="削除">
      </form>
    </div>
    
  </div>
  <?php $counter2 = 1; ?>
  <?php $counter =  $counter + 1; ?>
  <?php endforeach; ?>
</main>
</body>
</html>