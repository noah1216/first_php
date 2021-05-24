<?php

session_start();

// echo $_SESSION["name"];
$_SESSION = array();
session_destroy();

if($_SESSION == null){
  include "login_form.php";
}else {
  echo "ログアウトできませんでした";
  include "top.php";
}

?>