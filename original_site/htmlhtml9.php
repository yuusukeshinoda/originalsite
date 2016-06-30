<?php
session_start();
require_once './dbaccess_util.php';
echo $_SESSION['userID'].'aaa'.'<br>';
?>
<html>
<head>
  <title>リスト登録</title>
  <meta http-equiv="content-type" charset="utf-8">
</head>
<body>

<?php

function insert_movies($listName,$userID,$movie1,$movie2,$movie3,$movie4,$movie5,$movie6,$movie7,$movie8,$movie9,$movie10){
  $insert_db = connect2MySQL();
  $insert_sql = "insert into movie_db(name,userID,m_1,m_2,m_3,m_4,m_5,m_6,m_7,m_8,m_9,m_10) values(:name,:userID,:m_1,:m_2,:m_3,:m_4,:m_5,:m_6,:m_7,:m_8,:m_9,:m_10)";

  //db接続を確立
  $insert_db = connect2MySQL();

  //DBに全項目のある1レコードを登録するSQL
  $insert_sql = "INSERT INTO movie_list(name,userID,m_1,m_2,m_3,m_4,m_5,m_6,m_7,m_8,m_9,m_10)"
          . "VALUES(:name,:userID,:m_1,:m_2,:m_3,:m_4,:m_5,:m_6,:m_7,:m_8,:m_9,:m_10)";

  //クエリとして用意
  $insert_query = $insert_db->prepare($insert_sql);

  //SQL文にセッションから受け取った値＆現在時をバインド
  $insert_query->bindValue(':name',$listName);
  $insert_query->bindValue(':userID',$userID);
  $insert_query->bindValue(':m_1',$movie1);
  $insert_query->bindValue(':m_2',$movie2);
  $insert_query->bindValue(':m_3',$movie3);
  $insert_query->bindValue(':m_4',$movie4);
  $insert_query->bindValue(':m_5',$movie5);
  $insert_query->bindValue(':m_6',$movie6);
  $insert_query->bindValue(':m_7',$movie7);
  $insert_query->bindValue(':m_8',$movie8);
  $insert_query->bindValue(':m_9',$movie9);
  $insert_query->bindValue(':m_10',$movie10);



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

if(!isset($_POST['mode'])){
  ?>
  <form action="./htmlhtml9.php" method="post">
    ライブラリ名<input type="text" name="listName"><br>
    <input type="text" name="movie1"><br>
    <input type="text" name="movie2"><br>
    <input type="text" name="movie3"><br>
    <input type="text" name="movie4"><br>
    <input type="text" name="movie5"><br>
    <input type="text" name="movie6"><br>
    <input type="text" name="movie7"><br>
    <input type="text" name="movie8"><br>
    <input type="text" name="movie9"><br>
    <input type="text" name="movie10"><br>
    <input type="submit" name="btn" value="送 信">
    <input type="hidden" name="mode1" value="registration">
    <input type="hidden" name="mode" value="confirm">
  </form>
  <?php
}elseif(isset($_POST['mode']) && $_POST['mode1']=='registration'){
  echo 'ライブラリ名：'.$_POST['listName'].'<br>';
  echo $_POST['movie1'].'<br>';
  echo $_POST['movie2'].'<br>';
  echo $_POST['movie3'].'<br>';
  echo $_POST['movie4'].'<br>';
  echo $_POST['movie5'].'<br>';
  echo $_POST['movie6'].'<br>';
  echo $_POST['movie7'].'<br>';
  echo $_POST['movie8'].'<br>';
  echo $_POST['movie9'].'<br>';
  echo $_POST['movie10'].'<br>';

  if($_POST['mode1']=='registration' && $_POST['mode']=='confirm'){
    ?>
    <form action="./htmlhtml9.php" method="post">
      <input type="submit" name="btn" value="登 録">
      <input type="hidden" name="mode1" value="registration">
      <input type="hidden" name="mode" value="complete">
      <input type="hidden" name="listName" value="<?php echo $_POST['listName'];?>">
      <input type="hidden" name="movie1" value="<?php echo $_POST['movie1'];?>">
      <input type="hidden" name="movie2" value="<?php echo $_POST['movie2'];?>">
      <input type="hidden" name="movie3" value="<?php echo $_POST['movie3'];?>">
      <input type="hidden" name="movie4" value="<?php echo $_POST['movie4'];?>">
      <input type="hidden" name="movie5" value="<?php echo $_POST['movie5'];?>">
      <input type="hidden" name="movie6" value="<?php echo $_POST['movie6'];?>">
      <input type="hidden" name="movie7" value="<?php echo $_POST['movie7'];?>">
      <input type="hidden" name="movie8" value="<?php echo $_POST['movie8'];?>">
      <input type="hidden" name="movie9" value="<?php echo $_POST['movie9'];?>">
      <input type="hidden" name="movie10" value="<?php echo $_POST['movie10'];?>">
    </form>
    <?php

    echo '以上の内容で登録しますか？';
  }elseif($_POST['mode1']=='registration' && $_POST['mode']=='complete'){
    echo '以上の内容で登録しました。';
    $userID = $_SESSION['userID'];
    $listName = !empty($_POST['listName']) ? $_POST['listName'] : "";
    $movies_array = array();
    $movies_array[0] = !empty($_POST['movie1']) ? $_POST['movie1'] : null;
    $movies_array[1] = !empty($_POST['movie2']) ? $_POST['movie2'] : null;
    $movies_array[2] = !empty($_POST['movie3']) ? $_POST['movie3'] : null;
    $movies_array[3] = !empty($_POST['movie4']) ? $_POST['movie4'] : null;
    $movies_array[4] = !empty($_POST['movie5']) ? $_POST['movie5'] : null;
    $movies_array[5] = !empty($_POST['movie6']) ? $_POST['movie6'] : null;
    $movies_array[6] = !empty($_POST['movie7']) ? $_POST['movie7'] : null;
    $movies_array[7] = !empty($_POST['movie8']) ? $_POST['movie8'] : null;
    $movies_array[8] = !empty($_POST['movie9']) ? $_POST['movie9'] : null;
    $movies_array[9] = !empty($_POST['movie10']) ? $_POST['movie10'] : null;

    $movies = implode(",",$movies_array);
    echo $movies;

    insert_movies_2($listName,$movies,$userID);

    //insert_movies($listName,$userID,$movie1,$movie2,$movie3,$movie4,$movie5,$movie6,$movie7,$movie8,$movie9,$movie10);
  }
}
?>

<a href="./htmlhtml.php">トップページへ戻る</a>
</body>
</html>
