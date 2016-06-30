<?php
require_once './dbaccess_util.php';
?>
<html>
<head>
  <title>新規会員登録</title>
  <meta http-equiv="content-type" charset="utf-8">
  <link rel="stylesheet" type="text/css" href="./stylesheet.css">
</head>
<body>
<?php
if(!isset($_POST['mode']) || empty($_POST['name']) || empty($_POST['password']) || empty($_POST['nickname']) || $_POST['mode']=='rewrite'){
  $name = !empty($_POST['name']) ? $_POST['name'] : "";
  $password = !empty($_POST['password']) ? $_POST['password'] : "";
  $nickname = !empty($_POST['nickname']) ? $_POST['nickname'] : "";
  ?>
  <form action="./htmlhtml7.php" method="post">
    名前<input type="text" name="name" value="<?php echo $name;?>"><br>
    パスワード<input type="text" name="password" value="<?php echo $password;?>"><br>
    このサイトで表示するニックネーム<input type="text" name="nickname" value="<?php echo $nickname;?>"><br>
    <input type="submit" name="btn" value="送 信">
    <input type="hidden" name="mode" value="confirm">
  </form>
<?php
}elseif($_POST['mode']=='confirm' || $_POST['mode']=='complete'){
  echo '名前：'.$_POST['name'].'<br>';
  echo 'パスワード：'.$_POST['password'].'<br>';
  echo 'ニックネーム：'.$_POST['nickname'].'<br>';
  $name = $_POST['name'];
  $password = $_POST['password'];
  $nickname = $_POST['nickname'];
  if($_POST['mode']=='confirm'){
    echo '以上の内容で登録しますか?'.'<br>';
    ?>
    <form action="./htmlhtml7.php" method="post">
      <input type="submit" name="btn" value="はい">
      <input type="hidden" name="mode" value="complete">
      <input type="hidden" name="name" value="<?php echo $_POST['name'];?>">
      <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
      <input type="hidden" name="nickname" value="<?php echo $_POST['nickname'];?>">
    </form>
    <form action="./htmlhtml7.php?" method="post">
      <input type="submit" name="btn" value="いいえ">
      <input type="hidden" name="mode" value="rewrite">
      <input type="hidden" name="name" value="<?php echo $_POST['name'];?>">
      <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
      <input type="hidden" name="nickname" value="<?php echo $_POST['nickname'];?>">
    </form>
    <?php
  }elseif($_POST['mode']=='complete'){

    function insert_user($name,$nickname,$password){
        //db接続を確立
        $insert_db = connect2MySQL();

        //DBに全項目のある1レコードを登録するSQL
        $insert_sql = "INSERT INTO user(name,password,nickname)"
                . "VALUES(:name,:password,:nickname)";

        //クエリとして用意
        $insert_query = $insert_db->prepare($insert_sql);

        //SQL文にセッションから受け取った値＆現在時をバインド
        $insert_query->bindValue(':name',$name);
        $insert_query->bindValue(':nickname',$nickname);
        $insert_query->bindValue(':password',$password);

        //SQLを実行
        try{
            $insert_query->execute();
        } catch (PDOException $e) {
            //接続オブジェクトを初期化することでDB接続を切断
            $insert_db=null;
            return $e->getMessage();
        }

        $insert_db=null;
        return null;
    }

    $errorMessage = insert_user($name,$nickname,$password);
    if(empty($errorMessage)){
      echo '以上の内容で登録を完了しました。';
    }else{
      echo '以下の理由により登録できませんでした。'.'<br>';
      echo $errorMessage;
    }
  }
}









?>
<a href="./htmlhtml.php">トップページへ</a><br>
</body>
</html>
