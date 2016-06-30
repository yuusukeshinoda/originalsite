<?php
session_start();
require_once './dbaccess_util.php';
echo $_SESSION['userID'];
$userID = $_SESSION['userID'];
?>
<html>
<head>
  <title>登録リスト</title>
  <meta http-equiv="content-type" charset="utf-8">
  <link rel="stylesheet" type="text/css" href="./stylesheet.css">
</head>
<body>
<?php

function select_recommend($userID=null){
    //db接続を確立
    $select_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $select_sql = "SELECT recommend,recommender FROM user WHERE userID = :userID";

    //クエリとして用意
    $select_query = $select_db->prepare($select_sql);
    $select_query->bindValue(':userID',$userID);


    //SQLを実行
    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

$result = select_recommend($userID);
$recommender = $result[0]['recommender'];
$recommend = $result[0]['recommend'];
if($result[0]['recommend']!==null){
  echo $recommender.'さんからオススメが届いています。<br>';
  ?>
  <p class="myrecommend"><?php echo $recommend;?></p>
  <?php
}






?>
<a href="./htmlhtml.php">トップページへ</a>
</body>
</html>
