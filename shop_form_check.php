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
       <a class="border logout-button ml-auto" href="member_login.html">会員ログイン</a>
     <?php else: ?>
       <p>ようこそ、<?php echo $_SESSION['member_name']; ?>さん</p>
       <a class="border logout-button ml-auto" href="member_logout.php">ログアウト</a>
     <?php endif; ?>
     <a href="shop_cartlook.php">カートを見る</a>
    </div>
  </header>
 <?php

  $onamae=$_POST['onamae'];
  $email=$_POST['email'];
  $postal1=$_POST['postal1'];
  $postal2=$_POST['postal2'];
  $address=$_POST['address'];
  $tel=$_POST['tel'];

  // 会員登録
  $order=$_POST['order'];
  $pass=$_POST['pass'];
  $pass2=$_POST['pass2'];
  $sex=$_POST['sex'];
  $birth=$_POST['birth'];
  // 会員登録

  $okflg=true;

  $onamae=htmlspecialchars($onamae,ENT_QUOTES,'UTF-8');
  $email=htmlspecialchars($email,ENT_QUOTES,'UTF-8');
  $postal1=htmlspecialchars($postal1,ENT_QUOTES,'UTF-8');
  $postal2=htmlspecialchars($postal2,ENT_QUOTES,'UTF-8');
  $address=htmlspecialchars($address,ENT_QUOTES,'UTF-8');
  $tel=htmlspecialchars($tel,ENT_QUOTES,'UTF-8');

  if($onamae == '')
   {
      echo 'お名前が入力されていません<br><br>';
      $okflg=false;
    }
  if(preg_match('/^[¥w¥-¥.]+¥@[¥w¥-¥.]+¥.([a-z]+)¥z$/',$email))
   {
      echo 'メールアドレスを正確に入力してください<br><br>';
      $okflg=false;
   }
  if(is_int($postal1))
   {
      echo '郵便番号は半角数字で入力してください<br><br>';
      $okflg=false;
   }
  if(is_int($postal2))
   {
      echo '郵便番号は半角数字で入力してください<br><br>';
      $okflg=false;
   }
  if($address==''){
    echo '住所が入力されていません<br><br>';
    $okflg=false;
  }
  if(is_int($tel))
   {
      echo '電話番号を正確に入力してください<br><br>';
      $okflg=false;
   }

   if($order=='chumononreg'){
     if($pass==''){
       echo 'パスワードが入力されていません<br><br>';
       $okflg=false;
     }
     if($pass!=$pass2){
       echo 'パスワードが一致しません<br><br>';
       $okflg=false;
     }
   }

 ?>
 <div class="shop_form_check container">
  <h1 class="text-center mt-5 mb-4">お客様情報確認</h1>
  <?php if($okflg==true): ?>
   <form method="post" action="shop_form_done.php">
     <input type="hidden" name="onamae" value="<?php echo $onamae; ?>">
     <input type="hidden" name="email" value="<?php echo $email; ?>">
     <input type="hidden" name="postal1" value="<?php echo $postal1; ?>">
     <input type="hidden" name="postal2" value="<?php echo $postal2; ?>">
     <input type="hidden" name="address" value="<?php echo $address; ?>">
     <input type="hidden" name="tel" value="<?php echo $tel; ?>">
     <input type="hidden" name="order" value="<?php echo $order; ?>">
     <input type="hidden" name="pass" value="<?php echo $pass; ?>">
     <input type="hidden" name="sex" value="<?php echo $sex; ?>">
     <input type="hidden" name="birth" value="<?php echo $birth; ?>">
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
     <p class="mt-2">性別</p>
      <?php
      if($order=='chumononreg'):
       if($sex=='man'):
         echo '男性';
       else:
         echo '女性';
       endif;
      endif;
      ?>
     <p class="mt-2">生まれ年</p>
      <?php echo $birth; ?>年代
   <div class="edit_submit text-center mt-5">
      <input type="submit" value="OK">
    </div>
    <div class="edit_submit text-center mt-3">
      <input type="button" onclick="history.back()" value="戻る">
    </div>
   </form>
 <?php else: ?>
   <div class="edit_submit text-center mt-5">
     <input type="button" onclick="history.back()" value="戻る">
    </div>
 <?php endif; ?>
 </div>
 <footer class="bg-dark">
   <p>copyright 2020 Izumi inc.</p>
 </footer>
</body>
</html>
