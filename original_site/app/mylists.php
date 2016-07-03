<?php
session_start();
require_once '../util/dbaccess_util.php';
require_once '../util/define_util.php';
require_once '../util/script_util.php';

$userID = $_SESSION['userID'];


$result = select_list($userID);
var_dump($result);
echo '<br><br>';

foreach($result as $value){
  foreach($value as $key => $value){
    if($key=='listID'){
      $listID = $value;
    }
    if($key=='listName'){?>
      <table border=1>
        <tr><th><?php echo $value;?></th></tr>
      <?php
    }
    if($key=='movies'){
      $movies_array = explode(",",$value);
      foreach($movies_array as $key => $value){
        if($value!==""){
          ?>
          <tr><td><?php echo $value;?></td></tr>
          <?php
        }

      }?>
    </table>
    <?php
    }
  }
  ?>
  <form action="./update_delete.php?listID=<?php echo $listID;?>" method="post">
    <input type="submit" name="update" value="変 更">
    <input type="submit" name="delete" value="削 除">
  </form>
  <?php
}
var_dump($movies_array);
//foreach($movies_array){}
?>
