<?php
$answers = $_POST['answer'];
$question = $_POST['question'];
// DBへ接続
try {
  $dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
  } catch(PDOException $e) {
    echo $e->getMessage();
  }

  // questionの登録
$sql = "INSERT INTO questions(question) VALUES (:question)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':question', $question);
$stmt->execute();


  // answerの登録
foreach ($answers as $answer){
  $sql = "INSERT INTO correct_answers(answer,questions_id) VALUES (:answer,(select id from questions order by created_at desc limit 1))";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':answer', $answer);
  $stmt->execute();
}

echo "登録しました";
include "top.php";
?>