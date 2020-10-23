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

    ini_set('display_errors',0);

    if(isset($_SESSION['cart'])==true){
      $cart = $_SESSION['cart'];
      $quantity = $_SESSION['quantity'];
      $max = count($cart);
    }else{
      $max=0;
    }

    if($max==0){
      echo '<div class="shop_cartlook container text-center">';
      echo '<p class="mt-5">カートに商品が入っていません</p>';
      echo '<br>';
      echo '<a href="shop_list.php">商品一覧へ戻る</a>';
      echo '</div>';
      echo '<footer class="bg-dark">';
      echo '<p>copyright 2020 Izumi inc.</p>';
      echo '</footer>';
      exit();
    }

    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='root';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    foreach($cart as $key => $val){
      $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
      $stmt = $dbh->prepare($sql);
      $data[0] = $val;
      $stmt->execute($data);

      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      $pro_name[]=$rec['name'];
      $pro_price[]=$rec['price'];

      if($rec['gazou'] == ''){
        $pro_gazou[]='';
      }else{
        $pro_gazou[]='<img src="img/'.$rec['gazou'].'">';
      }
    }

    $dbh = null;

   }

    catch(Exception $e){
      print 'ただいまご迷惑をおかけしております';
    }
 ?>
 <div class="shop_cartlook container">
 <h1 class="text-center mt-5 mb-4">商品カート</h1>
 　<form method="post" action="quantity_change.php">
   <div class="shop_cartin_button">
    <a href="shop_form.php">ご購入手続きへ進む</a>

   <?php
    if(isset($_SESSION["member_login"])==true){
      echo '<a href="shop_easy_check.php">会員簡単注文へ進む</a>';
    }
   ?>
   </div>
   <table>
     <tr>
       <td class="pro_name">商品</td>
       <td class="pro_img">商品画像</td>
       <td class="pro_price">商品価格</td>
       <td class="pro_quantity"><input type="submit" value="数量変更"></td>
       <td class="pro_sum">商品小計</td>
       <td class="pro_delete">商品削除</td>
     </tr>
     <?php for($i=0;$i<$max;$i++): ?>
     <tr>
       <td><?php echo $pro_name[$i]; ?></td>
       <td><div class="cart_img"><?php echo $pro_gazou[$i]; ?></div></td>
       <td><?php echo $pro_price[$i]; ?>円</td>
       <td><div class="cart_quantity"><input type="text" name="quantity<?php echo $i; ?>" value="<?php echo $quantity[$i]; ?>"></div></td>
       <td><?php echo $pro_price[$i]*$quantity[$i]; ?>円</td>
       <td><input type="checkbox" name="delete<?php echo $i; ?>"></td>
     </tr>
     <?php endfor; ?>
   </table>
      <input type="hidden" name="max" value="<?php echo $max; ?>">
      <div class="edit_submit text-center mt-5">
        <input type="button" onclick="history.back()" value="戻る">
      </div>
    </form>
 </div>
</div>
<footer class="bg-dark">
  <p>copyright 2020 Izumi inc.</p>
</footer>
</body>
</html>
