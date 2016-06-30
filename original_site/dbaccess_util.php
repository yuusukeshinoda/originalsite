<?php
function connect2MySQL(){
  try{
      $pdo = new PDO('mysql:host=localhost;dbname=movie_db;charset=utf8','yussuke','mofcarro');
      //SQL実行時のエラーをtry-catchで取得できるように設定
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      throw EXCEPTION('DB接続に失敗しました。次記のエラーにより処理を中断します:'.$e->getMessage());
    }
}

//htmlhtml3.php,htmlhtml.phpで使用
function select_list($ID=null,$flag=null){
    //db接続を確立
    $select_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $select_sql = "SELECT * FROM m_list WHERE";

    if($flag==true){
      $select_sql .= " listID = :listID";
    }else{
      $select_sql .= " userID = :userID";
    }

    //クエリとして用意
    $select_query = $select_db->prepare($select_sql);
    if($flag==true){
      $select_query->bindValue(':listID',$ID);
    }else{
      $select_query->bindValue(':userID',$ID);
    }


    //SQLを実行
    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//htmlhtml9.phpで使用
function insert_movies_2($listName,$movies,$userID){
  //db接続を確立
  $insert_db = connect2MySQL();

  //DBに全項目のある1レコードを登録するSQL
  $insert_sql = "INSERT INTO m_list(listName,movies,userID)"
          . "VALUES(:listName,:movies,:userID)";

  //クエリとして用意
  $insert_query = $insert_db->prepare($insert_sql);

  //SQL文にセッションから受け取った値＆現在時をバインド
  $insert_query->bindValue(':listName',$listName);
  $insert_query->bindValue(':movies',$movies);
  $insert_query->bindValue(':userID',$userID);

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

//htmlhtml.phpで使用
function search_movie_3($movie=null,$userID=null){
    //db接続を確立
    $search_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $search_sql = "SELECT * FROM m_list WHERE movies like :movies and userID != :userID";

    //クエリとして用意
    $search_query = $search_db->prepare($search_sql);
    $search_query->bindValue(':movies','%'.$movie.'%');
    $search_query->bindValue(':userID',$userID);

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

//htmlhtml2.phpで使用
function search_movie_2($movie=null){
    //db接続を確立
    $search_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $search_sql = "SELECT * FROM m_list WHERE listName like :listName or movies like :movies";

    //クエリとして用意
    $search_query = $search_db->prepare($search_sql);
    $search_query->bindValue(':listName','%'.$movie.'%');
    $search_query->bindValue(':movies','%'.$movie.'%');

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

//htmlhtml4.phpで使用
function select_nickname($userID=null){
    //db接続を確立
    $search_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $search_sql = "SELECT nickname FROM user WHERE userID = :userID";

    //クエリとして用意
    $search_query = $search_db->prepare($search_sql);
    $search_query->bindValue(':userID',$userID);


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

//htmlhtml4で使用
function select_userlists($userID=null){
    //db接続を確立
    $select_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $select_sql = "SELECT * FROM m_list WHERE userID = :userID";

    //クエリとして用意
    $select_query = $select_db->prepare($select_sql);
    $select_query->bindValue(':userID',$userID);


    //SQLを実行
    try{
        $select_query->execute();
    } catch (PDOException $e) {
        $select_query=null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $select_query->fetchAll(PDO::FETCH_ASSOC);
}

//htmlhtml3.phpで使用
function update_recommend($recommend=null,$recommender=null,$userID=null){
  $update_db = connect2MySQL();
  $update_sql = "update user set recommend = :recommend,recommender = :recommender where userID = :userID";
  $update_query = $update_db->prepare($update_sql);

  $update_query->bindValue(':recommend',$recommend);
  $update_query->bindValue(':recommender',$recommender);
  $update_query->bindValue(':userID',$userID);

  try{
      $update_query->execute();
  } catch (PDOException $e) {
      //接続オブジェクトを初期化することでDB接続を切断
      $update_db=null;
      return $e->getMessage();
  }

  $update_db=null;
  return null;
}

function delete_list($listID){
  //db接続を確立
  $delete_db = connect2MySQL();

  $delete_sql = "DELETE FROM m_list WHERE listID=:listID";

  //クエリとして用意
  $delete_query = $delete_db->prepare($delete_sql);

  $delete_query->bindValue(':listID',$listID);

  //SQLを実行
  try{
      $delete_query->execute();
  } catch (PDOException $e) {
      $delete_query=null;
      return $e->getMessage();
  }
  return null;
}


?>
