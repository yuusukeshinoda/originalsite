<?php
session_start();
require_once '../util/dbaccess_util.php';
require_once '../util/define_util.php';
require_once '../util/script_util.php';
$userID = $_GET['userID'];

$nickname = select_nickname($userID);
?>
<p><font size=5 color=red><?php echo $nickname[0]['nickname'].'さんの登録リスト一覧';?></font></p>

<?php
$result = select_userlists($userID);
?>
<html>
<head>
  <title>他ユーザーのリスト一覧</title>
  <meta http-equiv="content-type" charset="utf-8">
</head>
<body>

<?php
foreach($result as $value){
  foreach($value as $key => $value){
    ?>
    <table border=1>
      <?php if($key=='listName'){
        echo "<tr><th>$value</th></tr>";
      }?>
      <?php if($key=='movies'){
        $movies_array = explode(",",$value);
        foreach($movies_array as $value){
          if($value!==""){
            echo "<tr><td>$value</td></tr>";
          }
        }
      } ?>
    </table>
    <?php
  }
  echo '<br>';
}
?>

<?php echo return_top(); ?>
</body>
</html>
