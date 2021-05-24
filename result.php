<?php
  session_start();
  if($_SESSION['id']== null){
    echo "ログインしてください";
    include "login_form.php";
    return;
  }
  
  $name = $_SESSION['name'];
  $user_id = $_SESSION['id'];
  try {
    $dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
    
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

  $questionIds = $_POST['questionId'];
  $answers = $_POST["answer"];
  $cnt = count($questionIds);

  // 採点
  $counter = 0;
  $score = 0;
  foreach ($questionIds as $id){
    $sql = "SELECT * FROM correct_answers WHERE questions_id = :id";
    $stmt2 = $dbh->prepare($sql);
    $stmt2->bindValue(':id', $id);
    $stmt2->execute();
    $answerList = $stmt2->fetchAll(PDO::FETCH_ASSOC);

      foreach ($answerList as $dbAnswer){
        $db_answer = $dbAnswer["answer"];
        $answer = $answers[$counter];
        if($answer == $db_answer){
          $score = $score + 1;
        }
      }
    $counter =  $counter + 1;
  }

  // 点数
  $point = $score * 100/$cnt;


  // historyの登録
  $sql = "INSERT INTO histories(users_id, point) VALUES (:users_id, :point)";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':users_id', $user_id);
  $stmt->bindValue(':point', $point);
  $stmt->execute();

  // 時間の取得
  $timestamp = time();
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

  <h2 class="title1">テスト結果</h2>
  <div class="test-box">
    <ul class="test-user">
      <li><?php echo $name ?>さん</li>
      <li><?php echo $cnt ?>問中、<?php echo $score ?>問正解です</li>
      <li><?php echo $point ?>点でした</li>
    </ul>
    <div class="test-day">
      <p>
      <?php echo date("Y-m-d H:i:s", $timestamp) ?>
      </p>
    </div>
  </div>
</main>
</body>
</html>