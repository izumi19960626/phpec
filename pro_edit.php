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

    $pro_code=$_GET['procode'];

    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='root';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name=$rec['name'];
    $pro_price=$rec['price'];
    $pro_gazou_name_old=$rec['gazou'];

    $dbh = null;

    if($pro_gazou_name_old==''){
      $disp_gazou='';
    }else{
      $disp_gazou='<img src="./img/'.$pro_gazou_name_old.'">';
    }

   }

    catch(Exception $e){
      print 'ただいまご迷惑をおかけしております';
    }
 ?>
 <div class="container">
 <h1 class="text-center">商品修正</h1>
    <p>商品コード</p>
    <?php print $pro_code; ?>
    <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
         <input type="hidden" name="code" value="<?php print $pro_code; ?>">
         <input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
        商品名<br />
         <input type="text" name="name" value="<?php print $pro_name; ?>"><br />
        価格を入力してください<br />
         <input type="text" name="price" value="<?php print $pro_price; ?>">円<br />
        画像を選んでください<br />
         <input type="file" name="gazou"><br />
        <div class="edit_submit text-center mt-5">
         <input type="submit" value="OK">
         <input type="button" onclick="history.back()" value="戻る">
        </div>
    </form>
 </div>
</div>
</body>
</html>
