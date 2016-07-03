<?php
require_once '../util/dbaccess_util.php';
require_once '../util/define_util.php';
require_once '../util/script_util.php';
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
          echo "<a href='./list_detail.php?listID=$listID'>";
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

<?php echo return_top(); ?>
</body>
</html>
