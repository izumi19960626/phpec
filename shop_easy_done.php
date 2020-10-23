<?php
  session_start();
  session_regenerate_id(true);
  // if(isset($_SESSION['member_login'])==false){
  //   echo 'ログインされていません';
  //   echo '<a href="shop_list.php">商品一覧へ</a>';
  //   exit();
  // }
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
       <p>ログインされていません</p>
       <a class="border logout-button ml-auto" href="shop_list.php">商品一覧へ</a>
     <?php else: ?>
       <p>ようこそ、<?php echo $_SESSION['member_name']; ?>さん</p>
       <a class="border logout-button ml-auto" href="member_logout.php">ログアウト</a>
     <?php endif; ?>
     <a href="shop_cartlook.php">カートを見る</a>
    </div>
  </header>
<?php

// try{
  $onamae=$_POST['onamae'];
  $email=$_POST['email'];
  $postal1=$_POST['postal1'];
  $postal2=$_POST['postal2'];
  $address=$_POST['address'];
  $tel=$_POST['tel'];

  $onamae=htmlspecialchars($onamae,ENT_QUOTES,'UTF-8');
  $email=htmlspecialchars($email,ENT_QUOTES,'UTF-8');
  $postal1=htmlspecialchars($postal1,ENT_QUOTES,'UTF-8');
  $postal2=htmlspecialchars($postal2,ENT_QUOTES,'UTF-8');
  $address=htmlspecialchars($address,ENT_QUOTES,'UTF-8');
  $tel=htmlspecialchars($tel,ENT_QUOTES,'UTF-8');

  $cart=$_SESSION['cart'];
  $quantity=$_SESSION['quantity'];
  $max=count($cart);

  $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';

  $lastmembercode=$_SESSION['member_code'];

  $sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
  $stmt=$dbh->prepare($sql);
  $data=array();
  $data[]=$lastmembercode;
  $data[]=$onamae;
  $data[]=$email;
  $data[]=$postal1;
  $data[]=$postal2;
  $data[]=$address;
  $data[]=$tel;
  $stmt->execute($data);

  $sql='SELECT LAST_INSERT_ID()';
  $stmt=$dbh->prepare($sql);
  $stmt->execute();
  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  $lastcode=$rec['LAST_INSERT_ID()'];

  for($i=0;$i<$max;$i++){
    $sql='SELECT name,price FROM mst_product WHERE 1';
    $stmt=$dbh->prepare($sql);
    $data[0]=$cart[$i];
    $stmt->execute($data);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    $name=$rec['name'];
    $price=$rec['price'];
    $kakaku[]=$price;
  }


  for($i=0;$i<$max;$i++){
    $sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
    $stmt=$dbh->prepare($sql);
    $data=array();
    $data[]=$lastcode;
    $data[]=$cart[$i];
    $data[]=$kakaku[$i];
    $data[]=$quantity[$i];
    $stmt->execute($data);
  }

  $sql='UNLOCK TABLES';

  $dbh = null;
// }
// catch(Exception $e){
//   echo 'ただいま障害により大変ご迷惑をおかけしております';
//   exit();
// }

?>
 <div class="shop_easy_done container">
   <h1 class="mt-5 mb-4 text-center">ご注文確認</h1>
     <p><?php echo $onamae; ?>様</p>
     <p><?php echo $email; ?>にメールをお送りしましたのでご確認ください。</p>
     <p>商品は以下の住所に発送させていただきます</p>
     <p><?php echo $postal1; ?>-<?php echo $postal2; ?></p>
     <p><?php echo $address; ?></p>
     <p><?php echo $tel; ?></p>
     <div class="edit_submit text-center mt-5">
      <a href="shop_list.php">商品画面へ</a>
     </div>
 </div>
 <footer class="bg-dark">
   <p>copyright 2020 Izumi inc.</p>
 </footer>
</body>
</html>
