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
  
  // question取得
  $sql = "SELECT * FROM histories WHERE users_id = :users_id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':users_id', $user_id);
  $stmt->execute();
  $histories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css" >
<title>タイトル</title>
</head>
<body>
<main>
  <div class="header-box">
    <div>
    <a href="top.php">
      <input type="button" value="top" class="b-size magin-l10">
    </a>
    <a href="logout.php">
      <input type="button" value="logout" class="b-size magin-l10">
    </a>
    </div>

    <div class="buttonsize-box text_box1">
      <h2>履歴</h2>
      <div class="table">
        <table border="1">
          <tr>
            <th>名前</th>
            <th>得点</th>
            <th>採点時間</th>
          </tr>
          <?php foreach ($histories as $history) : ?>         
            <tr >
              <th><?php echo $name ?></th>
              <th><?php echo $history["point"] ?></th>
              <th><?php echo $history["created_at"] ?></th>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
</main>
</body>
</html>