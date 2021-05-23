<?php
// db接続
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
<link rel="stylesheet" href="style.css">
<title>タイトル</title>
</head>
<body>
<main>

  <div class="header-box">
    <a href="list.php">
      <input type="submit" value="top" class="b-size magin-l10">
    </a>
    <a href="list.php">
      <input type="submit" value="logout" class="b-size magin-l10">
    </a>
  </div>

  <div class="list-center">
    <input type="submit" value="新規登録" class="b-size">
  </div>


  <div class="tyuou">
    <div class="question-box">
      <p>
        <label>問題:</label>
        <label>1</label>
        <input type="text" name="example" value="選択肢" class="text-size">
      </p>
      <p>
        <label>答え1:</label>
        <input type="text" name="example" value="選択肢" class="text-size">
      </p>
        <label>答え2:</label>
        <input type="text" name="example" value="選択肢" class="text-size">
      </p>
    </div>

    <div>
      <input type="button" value="編集" >
      <input type="button" value="削除" >
    </div>
  </div>

</main>
</body>
</html>