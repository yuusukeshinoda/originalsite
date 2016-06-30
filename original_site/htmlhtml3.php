<?php
session_start();
require_once './dbaccess_util.php';
echo $_SESSION['nickname'];
echo $_SESSION['userID'];
?>


<html>
<head>
  <title>ライブラリ詳細ページ</title>
  <meta http-equiv="content-type" charset="utf-8">
  <link rel="stylesheet" type="text/css" href="./stylesheet.css">
</head>
<body>
  <a href="./htmlhtml.php">トップページへ</a>
<p><font size=5 color="blue">ライブラリ詳細ページ</font></p>
<?php
$listID = $_GET['listID'];


$flag = true;
$result = select_list($listID,$flag);?>

<table border=1>
  <tr><th><?php echo $result[0]['listName'];?></th></tr>
  <?php
  foreach($result as $value){
    foreach($value as $key => $value){
      if($key=='userID'){
        //オススメを送る時に使う
        $userID = $value;
      }
      if($key=='movies'){
        $movies_array = explode(",",$value);
        foreach($movies_array as $value){
          if($value!==""){?>
            <tr><td><?php echo $value; ?></td></tr>
            <?php
          }
        }
      }
    }
  }
  ?>
</table>

<a href="./htmlhtml4.php?userID=<?php echo $userID;?>">このユーザーのマイページへ</a><br><br>


<?php
if(empty($_POST['mode']) || $_POST['recommend']==""){
?>
<form action="./htmlhtml3.php?listID=<?php echo $listID;?>" method="post">
オススメ映画を教える<br>
<input type="text" name="recommend">
<input type="hidden" name="mode" value="true">
<input type="submit">
</form>
<?php
}elseif($_POST['mode']=='true' && !empty($_POST['recommend'])){
  ?><p class="recommend">オススメ「<?php echo $_POST['recommend'];?>」を送信しました！</p>
<?php


$recommend = $_POST['recommend'];
$recommender = $_SESSION['nickname'];
update_recommend($recommend,$recommender,$userID);

}
?>

</body>
</html>
