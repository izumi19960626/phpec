<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <title>ふくまるショップ</title>
</head>
<body>
  <header class="navbar navbar-light bg-dark">
    <div class="container">
     <?php if(isset($_SESSION['member_login'])==false): ?>
       <p>ようこそゲスト様</p>
       <a class="border logout-button ml-auto" href="member_login.php">会員ログイン</a>
     <?php else: ?>
       <p>ようこそ、<?php echo $_SESSION['member_name']; ?>さん</p>
       <a class="border logout-button ml-auto" href="member_logout.php">ログアウト</a>
     <?php endif; ?>
     <a href="shop_cartlook.php">カートを見る</a>
    </div>
  </header>
<h1 class="text-center mt-5 mb-4">商品一覧</h1>
<div class="container">
 <?php

   try{

    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='root';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

  }

    catch(Exception $e){
      echo 'ただいまご迷惑をおかけしております';
    }
 ?>
 <div class="shop_table">
 <?php
  while(true):
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if($rec == false):
   break;
  endif;
 ?>
 <table border="1">
   <tr>
     <td class="pro_name">商品名 <?php echo '<a href="shop_product.php?procode='.$rec['code'].'">'; ?><?php echo $rec['name']; ?></a></td>
   </tr>
   <tr>
     <td class="pro_price">商品価格 <?php echo $rec['price']; ?>円</td>
   </tr>
   <tr>
     <td class="pro_img">商品画像</td>
   </tr>
   <tr>
     <td class="img_pro"><?php echo '<a href="shop_product.php?procode='.$rec['code'].'">'; ?><?php echo '<img src="img/'.$rec['gazou'].'">'; ?></td>
   </tr>
   </table>
  <?php endwhile; ?>
</div>
</div>
<footer class="bg-dark">
  <p>copyright 2020 Izumi inc.</p>
</footer>
</body>
</html>
