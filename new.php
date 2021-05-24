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

  <form action="confirm.php" method="post">
      <div class="tyuou">
          <label class="valign">問題:</label>
          <textarea rows="10" cols="60" name="question">ここに記入してください</textarea>
          <p>
            <label>答え:</label>
            <input type="text" name="answer[]" value="選択肢" class="text-size84">
          </p>
          <p>
            <label>答え:</label>
            <input type="text" name="answer[]" value="選択肢" class="text-size84">
          </p>
      </div>

      <div class="center">
        <input type="submit" value="確認" >
        <div class="header-box">
        <a href="list.php">
          <input type="button" value="戻る">
        </a>
        <input type="button" value="追加" >
      </div>
  </form>
</main>
</body>
</html>