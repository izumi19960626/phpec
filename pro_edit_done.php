<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
  print 'ログインされていません';
  print '<a href="staff_login.html">ログイン画面へ</a>';
  exit();
}
else{
  print $_SESSION['staff_name'];
  print 'さんログイン中';
  print '<br>';
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <title>ふくまるショップ</title>
</head>
<body>
 <?php

   try{

    $pro_code=$_POST['code'];
    $pro_name=$_POST['name'];
    $pro_price=$_POST['price'];
    $pro_gazou_name_old=$_POST['gazou_name_old'];
    $pro_gazou_name=$_POST['gazou_name'];

    $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
    $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='root';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE mst_product SET name=?,price=?,gazou=? WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_name;
    $data[] = $pro_price;
    $data[] = $pro_gazou_name;
    $data[] = $pro_code;
    $stmt->execute($data);

    $dbh = null;

    if($pro_gazou_name_old!=$pro_gazou_name)
    {
      unlink('../img/'.$pro_gazou_name_old);
    }
   }

    catch(Exception $e){
      print 'ただいまご迷惑をおかけしております';
    }
 ?>
 <div class="container text-center">
  <p>修正しました。</p>
  <a href="pro_list.php">戻る</a>
 </div>
</body>
</html>
