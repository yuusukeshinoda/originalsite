<?php
session_start();
require_once '../util/dbaccess_util.php';
require_once '../util/define_util.php';
require_once '../util/script_util.php';

echo $_SESSION['userID'].'aaa'.'<br>';
?>
<html>
<head>
  <title>リスト登録</title>
  <meta http-equiv="content-type" charset="utf-8">
</head>
<body>

<?php

if(!isset($_POST['mode'])){
  ?>
  <form action="./list_registration.php" method="post">
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
    <form action="./list_registration.php" method="post">
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

    insert_movies_2($listName,$movies,$userID);

  }
}
?>

<?php echo return_top(); ?>
</body>
</html>
