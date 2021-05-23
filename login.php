<?php

// セッション作成
session_start();

// フォームからnameを取得、変数定義
$name = $_POST['name'];

// DBへ接続
try {
$dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');

} catch(PDOException $e) {
	echo $e->getMessage();

}

// SQL作成
$sql = "SELECT * FROM users WHERE name = :name";

// SQL文をセット
$stmt = $dbh->prepare($sql);
// SQLに変数を代入
$stmt->bindValue(':name', $name);
// SQL実行
$stmt->execute();
// 取得する
$member = $stmt->fetch();


//指定したハッシュがパスワードにマッチしているかチェック
if (($_POST['pass'] == $member['password'])) {
  //DBのユーザー情報をセッションに保存
  $_SESSION['id'] = $member['id'];
  $_SESSION['name'] = $member['name'];
  include "top.php";
}else if(password_verify($_POST['pass'], $member['password'])){
  $_SESSION['id'] = $member['id'];
  $_SESSION['name'] = $member['name'];
  include "top.php";
} else {
  include "login_form.php";
}
