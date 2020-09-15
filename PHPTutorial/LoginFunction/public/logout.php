<?php
session_start();
require_once('../classes/UserLogic.php');

// mypage以外のアクセスをフィルター
if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('不正なリクエスト');
}

// PHPのsession時間はデフォで24分
$result = UserLogic::checkLogin();
if (!$result) {
  exit('セッションが切れました。ログインしてください');
}

UserLogic::logout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログアウト</title>
</head>

<body>
  <h2>ログアウト完了</h2>
  <p>ログアウトしました</p>
  <a href="login_form.php">ログイン画面へ</a>
</body>

</html>