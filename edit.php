<?php
$answers = $_POST['answer'];
$question = $_POST['question'];
$answerIds = $_POST['answerIds'];
$id = $_POST['id'];

// DBへ接続
try {
  $dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
  } catch(PDOException $e) {
    echo $e->getMessage();
  }

  // questionの更新
  $sql ='UPDATE questions SET question = :question WHERE id = :id';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id);
  $stmt->bindValue(':question', $question);
  $stmt->execute();

  // answerの更新
  $counter = 0;
  foreach ($answers as $answer){
    $id2 = $answerIds[$counter];
    $sql = "UPDATE correct_answers SET answer = :answer, questions_id = :questions_id WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':questions_id', $id);
    $stmt->bindValue(':answer', $answer);
    $stmt->bindValue(':id', $id2);
    $stmt->execute();

    $counter =  $counter + 1;
  }

  echo "編集しました";
include "top.php";
?>
