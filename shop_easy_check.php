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

  $code=$_SESSION['member_code'];

  $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql = 'SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=1';
  $stmt = $dbh->prepare($sql);
  $data[] = $code;
  $stmt->execute($data);
  $rec=$stmt->fetch(PDO::FETCH_ASSOC);

  $dbh = null;

  $onamae=$rec['name'];
  $email=$rec['email'];
  $postal1=$rec['postal1'];
  $postal2=$rec['postal2'];
  $address=$rec['address'];
  $tel=$rec['tel'];

 ?>
 <div class="shop_easy_check container">
   <h1 class="text-center mt-5 mb-4">会員情報確認</h1>
   <form method="post" action="shop_easy_done.php">
     <input type="hidden" name="onamae" value="<?php echo $onamae; ?>">
     <input type="hidden" name="email" value="<?php echo $email; ?>">
     <input type="hidden" name="postal1" value="<?php echo $postal1; ?>">
     <input type="hidden" name="postal2" value="<?php echo $postal2; ?>">
     <input type="hidden" name="address" value="<?php echo $address; ?>">
     <input type="hidden" name="tel" value="<?php echo $tel; ?>">
     <p>お名前</p>
      <?php echo $onamae; ?>
     <p class="mt-2">メールアドレス</p>
      <?php echo $email; ?>
     <p class="mt-2">郵便番号</p>
      <?php echo $postal1; ?>-<?php echo $postal2; ?>
     <p class="mt-2">住所</p>
      <?php echo $address; ?>
     <p class="mt-2">電話番号</p>
      <?php echo $tel; ?>
    <div class="edit_submit text-center mt-5">
      <input type="submit" value="OK">
     </div>
    <div class="edit_submit text-center mt-2">
      <input type="button" onclick="history.back()" value="戻る">
     </div>
   </form>
 </div>
 <footer class="bg-dark">
   <p>copyright 2020 Izumi inc.</p>
 </footer>
</body>
</html>
