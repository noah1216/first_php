

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



    <form action="create.php" method="post">
      <div class="tyuou">
        <div class="question-box">
          <label class="valign">問題:</label>
          <textarea  rows="10" cols="60" readonly><?php echo $question ?></textarea>
          <input type="hidden" value="<?php echo $question ?>" name="question">
          <?php foreach ($answers as $answer) : ?>
            <p>
              <label>答え:</label>
              <input type="text"  class="text-size" name="answer[]" value="<?php echo $answer ?>" readonly>
            </p>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="center">
      <a href="new.php">
        <input type="button" value="戻る">
      </a>
        <input type="submit" value="更新">
      </div>
      </form>

</main>
</body>
</html>