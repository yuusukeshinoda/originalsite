<?php
require_once './dbaccess_util.php';
$search = $_GET['search1'];



?>
<html>
<head>
<title>検索結果</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
  <?php
  $result = search_movie_2($search);
  ?>
  <table border=1>
    <tr><th>リストID</th><th>ライブラリ名</th></tr>
  <?php
  foreach($result as $value){?>
    <tr>
      <?php
      foreach($value as $key => $value){

        if($key=='listID' || $key=='listName'){
          if($key=='listID'){
            $listID = $value;
          }?>
          <td><?php
          echo "<a href='./htmlhtml3.php?listID=$listID'>";
          echo $value;?>
          </a></td>
          <?php
        }
        if($key=='movies'){
          $movies_array = explode(",",$value);
          foreach($movies_array as $value){
            if($value!==""){?>
              <td><?php echo $value;?></td>
              <?php
            }
          }
        }?>

      <?php
    }
    ?>
  </tr>
    <?php
  }
  ?>
</table>

<a href="./htmlhtml.php">トップページへ戻る</a>
</body>
</html>
