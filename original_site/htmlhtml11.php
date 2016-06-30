<?php
session_start();
require_once './dbaccess_util.php';
?>
<html>
<head>
  <meta charset="utf-8">
  <title>リストの更新/削除</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<?php
$listID = $_GET['listID'];
if(isset($_POST['update'])){

echo 'update';

}
if(isset($_POST['delete'])){

echo 'delete';

}
?>
</body>
</html>
