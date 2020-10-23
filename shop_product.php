<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <title>ふくまるショップ</title>
</head>
<body>
  <header class="navbar navbar-light bg-dark">
    <div class="container">
     <?php if(isset($_SESSION['member_login'])==false): ?>
       <p>ようこそゲスト様</p>
       <a class="border logout-button ml-auto" href="member_login.html">会員ログイン</a>
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
    $pro_gazou_name=$rec['gazou'];

    if($pro_gazou_name == ''){
      $disp_gazou='';
    }else{
      $disp_gazou='<img src="./img/'.$pro_gazou_name.'">';
    }

    $dbh = null;

   }

    catch(Exception $e){
      print 'ただいまご迷惑をおかけしております';
    }
 ?>
 <div class="shop_pro container">
  <h1 class="text-center mt-5 mb-4">商品情報参照</h1>
 <div class="cart_add">
  <?php echo '<a href="shop_cartin.php?procode='.$pro_code.'">'; ?>カートに入れる →</a>
 </div>
    <table border="1">
      <tr>
        <td>商品コード <?php echo $pro_code; ?></td>
      </tr>
      <tr>
        <td>商品名 <?php echo $pro_name; ?></td>
      </tr>
      <tr>
        <td>商品価格 <?php echo $pro_price; ?>円</td>
      </tr>
      <tr>
        <td>商品画像</td>
      </tr>
      <tr>
        <td><?php echo $disp_gazou; ?></td>
      </tr>
      </table>
    <form>
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
