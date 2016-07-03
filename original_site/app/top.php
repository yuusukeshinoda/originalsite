<?php
session_start();
require_once '../util/dbaccess_util.php';
require_once '../util/define_util.php';
require_once '../util/script_util.php';
//echo $_SESSION['userID'];

?>
<html>
<head>
<meta charset="utf-8">
<title>テスト</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body　style="background-image: url(img1445845293.jpeg);">

<?php


if(isset($_SESSION['userID'])){
  ?>
<div class="buttons">
  <div class="button">
  <form action="./login.php" method="post">
  <button type='submit' name='action' value='logout'>ログアウト</button>
  </form>
  </div>
  <div class="button">
  <form action="./mypage.php" method="post">
  <button type="submit" name="action" value="mypage">マイページ</button>
  </form>
  </div>
</div>
  <?php
}else{
  echo "<button><a href='./login.php'>ログイン</a></button>";
}?>

<div class="a">バベルの映画館</div>
<div class="search" name="div1">
  <form action="search.php" method="get" name="form">
    <input type="text" name="search1">
    <input type="submit" value="検 索">
  </form>
</div>
<?php
if(isset($_SESSION['userID'])){
  $userID = $_SESSION['userID'];

  $userID = $_SESSION['userID'];
  $result = select_list($userID);

  foreach($result as $value){
    foreach($value as $key => $value){
      if($key=='movies'){
        $movies_array = explode(",",$value);
        foreach($movies_array as $key => $value){
          if($value==""){
            unset($movies_array[$key]);
          }
        }
      }
    }
  }

  foreach($movies_array as $key => $value){
    $result = search_movie_3($value,$userID);
    if(!empty($result)){

      foreach($result as $value){?>
<div class="tables">

        <table border=1 align="left">



          <?php
        foreach($value as $key => $value){
          //echo $value;
          if($key=='listID' || $key=='listName'){
            if($key=='listID'){
              $listID = $value;}
            if($key=='listName'){?>
              <tr><th><?php echo "<a href='./list_detail.php?listID=$listID'>";
              echo $value;?></a></th></tr>
            <?php
          }
            }?>
            <?php

          if($key=='movies'){
            $movies_array = explode(",",$value);
            foreach($movies_array as $value){
              if($value!==""){?>
                <tr><td><?php echo $value;?></td></tr>
                <?php
              }
            }
          }
        }
        ?>
      </table>
</div>
      <?php
      }

    }
  }

  }


?>
<div class="empty"></div>
<div id="footer">
<div class="footerin">
<div class="footerA">
  <a href='./list_detail.php'></a>
</div>
</div>
<div class="gutter">
<var></var>
</div>
</div>
</body>
</html>
