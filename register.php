<?php
//フォームからの値をそれぞれ変数に代入
$name = $_POST['name'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

// DBへ接続
try {
$dbh = new PDO("mysql:host=127.0.0.1; dbname=php_db; charset=utf8", 'root', 'takahasi1216');
} catch(PDOException $e) {
	echo $e->getMessage();
}

//フォームに入力されたmailがすでに登録されていないかチェック
$sql = "SELECT * FROM users WHERE name = :name";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name', $name);
$stmt->execute();
$member = $stmt->fetch();
if ($member['name'] === $name) {
    $msg = '同じユーザーが存在します。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO users(name, password) VALUES (:name, :pass)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':pass', $pass);
    $stmt->execute();
    $msg = '登録が完了しました';
    $link = '<a href="login_form.php">ログインページ</a>';
}
?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>