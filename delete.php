<?php
  $id = $_POST['id'];

  try {
    $dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

  // idでquestionの削除
  $sql = 'DELETE FROM questions WHERE id = :id';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id);
  $stmt->execute();
  $question = $stmt->fetch();

  // answerの削除
  $sql = 'DELETE FROM correct_answers WHERE questions_id = :id';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id);
  $stmt->execute();
  $question = $stmt->fetch();

  echo "削除しました";
  include "top.php";
?>