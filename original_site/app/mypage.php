<?php
session_start();
require_once '../util/dbaccess_util.php';
require_once '../util/define_util.php';
require_once '../util/script_util.php';

echo $_SESSION['userID']; ?>
<html>
<head>
  <title>マイページ</title>
  <meta http-equiv="content-type" charset="utf-8">
</head>
<body>
<button><a href="mylists.php">リスト一覧</a></button>
<button><a href="recommend.php">受信箱</a></button>
<button><a href="list_registration.php">リストを登録</a></button>
<?php echo return_top(); ?>
</body>
</head>
