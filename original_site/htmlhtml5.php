<?php
session_start();
require_once './dbaccess_util.php';
//ログインログアウトページ
if(!empty($_POST['action']) && $_POST['action']=='logout'){
  echo 'ログアウトしました';
  $_SESSION['userID'] = null;
}

function select_user($name=null){
    //db接続を確立
    $search_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $search_sql = "SELECT * FROM user WHERE name = :name";

    //クエリとして用意
    $search_query = $search_db->prepare($search_sql);
    $search_query->bindValue(':name',$_POST['name']);

    //SQLを実行
    try{
        $search_query->execute();
    } catch (PDOException $e) {
        $search_query=null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $search_query->fetchAll(PDO::FETCH_ASSOC);
}





$flag = false;
if(!isset($_POST['name']) && !isset($_POST['password'])){ ?>
  <form action="htmlhtml5.php" method="post">
    名前<input type="text" name="name"><br>
    パスワード<input type="text" name="password"><br>
    <input type="submit" name="btn" value="ログイン">
  </form>
  <form action="htmlhtml7.php" method="post">
  <input type="submit" name="btn" value="新規会員登録ページへ">
  </form>

<?php //未入力項目があれば戻るボタンを表示
}elseif($_POST['name']=="" || $_POST['password']==""){
echo "未入力の項目があります"; ?>
<form action="htmlhtml5.php" method="post">
 <input type="submit" name="btn" value="入力画面へ戻る">
</form>

<?php }else{
//データベースから情報を取得して照会
$result = select_user($_POST['name']);

foreach($result as $value){
foreach($value as $key => $value){
  if($key=='userID'){
    $_SESSION['userID'] = $value;
  }
  if($key=='nickname'){
    $_SESSION['nickname'] = $value;
  }
  if($key=='password' && $_POST['password']==$value){
    echo 'ログインしました。ようこそ'.$_SESSION['nickname'].'さん<br>';
    echo $_SESSION['userID'];

    //一致するデータがあれば(ログインできれば)$flagをtrueに
    $flag = true;
    break 2;
  }/*elseif($_POST['password']!==$value1){
    unset($_SESSION['userID']);
  }*/
}
}
//フラグがfalseのままなら以下を表示
if($flag==false){
echo 'ユーザー名とパスワードが合致するデータがありません。'; ?>
<form action="htmlhtml5.php" method="post">
 <input type="submit" name="btn" value="入力画面へ戻る">
</form>
<form action="registration.php" method="post">
<input type="submit" name="btn" value="新規会員登録ページへ">
</form><?php

}
}
?>

<html>
<title>ログイン</title>
<meta http-equiv="content-type" charset="utf-8">
<body>
  <a href="./htmlhtml.php">トップページへ戻る</a>
</body>
</html>
