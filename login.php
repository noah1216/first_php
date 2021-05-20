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

echo $member['password'];
echo $_POST['pass'];
//指定したハッシュがパスワードにマッチしているかチェック
if (($_POST['pass'] == $member['password'])) {
  //DBのユーザー情報をセッションに保存
  $_SESSION['id'] = $member['id'];
  $_SESSION['name'] = $member['name'];
  $msg = 'ログインしました。';
  $link = '<a href="index.php">ホーム</a>';
} else {
  $msg = 'メールアドレスもしくはパスワードが間違っています。';
  $link = '<a href="login.php">戻る</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>