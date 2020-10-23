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
 <?php

   try{

    $pro_code=$_GET['procode'];

    if(isset($_SESSION['cart'])==true){
      $cart=$_SESSION['cart'];
      $quantity=$_SESSION['quantity'];

      if(in_array($pro_code,$cart)==true){
        echo '<div class="shop_carttin container text-center">';
        echo '<h1 class="mt-5 mb-4 text-center">商品カート</h1>';
        echo '<p class="mb-3">その商品はすでにカートに入ってます</p>';
        echo '<a href="shop_list.php">商品一覧に戻る</a>';
        echo '</div>';
        echo '<footer class="bg-dark">';
        echo '<p>copyright 2020 Izumi inc.</p>';
        echo '</footer>';
        exit();
      }

    }
    $cart[]=$pro_code;
    $quantity[]=1;
    $_SESSION['cart']=$cart;
    $_SESSION['quantity']=$quantity;


   }

    catch(Exception $e){
      echo 'ただいまご迷惑をおかけしております';
    }
 ?>
 <div class="shop_carttin container text-center">
 <h1 class="mt-5 mb-4 text-center">商品カート</h1>
    <p>カートに追加しました。</p>
    <a href="shop_list.php">商品一覧に戻る</a>
　</div>
</div>
<footer class="bg-dark">
  <p>copyright 2020 Izumi inc.</p>
</footer>
</body>
</html>
