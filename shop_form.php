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
 <div class="shop_form container">
   <h1 class="text-center mt-5 mb-4">お客様情報入力</h1>
   <form method="post" action="shop_form_check.php">
     <p>お名前</p>
       <input type="text" name="onamae" style="width:200px">
     <p>メールアドレス</p>
       <input type="text" name="email" style="width:200px">
     <p>郵便番号</p>
       <input type="text" name="postal1" style="width:50px">
       <input type="text" name="postal2" style="width:80px">
     <p>住所</p>
       <input type="text" name="address" style="width:300px">
     <p>電話番号</p>
       <input type="text" name="tel" style="width:150px">
     <p>今回だけの注文 <input type="radio" name="order" value="chumononlynow" checked></p>
     <p>会員登録して注文<input type="radio" name="order" value="chumononreg"></p>
     <div class="shop_form_reg">
     <p>※会員登録する方は以下の項目も入力してください。</p>
     <p>パスワードを入力してください。</p>
       <input type="password" name="pass" style="width:100px;">
     <p>パスワードをもう一度入力してください。</p>
       <input type="password" name="pass2" style="width:100px;">
     <p>性別</p>
       <input type="radio" name="sex" value="man" checked>男性
       <input type="radio" name="sex" value="woman">女性
     <p>生まれ年</p>
       <select name="birth">
         <option value="1910">1910年代</option>
         <option value="1920">1920年代</option>
         <option value="1930">1930年代</option>
         <option value="1940">1940年代</option>
         <option value="1950">1950年代</option>
         <option value="1960">1960年代</option>
         <option value="1970">1970年代</option>
         <option value="1980">1980年代</option>
         <option value="1990">1990年代</option>
         <option value="2000">2000年代</option>
         <option value="2010">2010年代</option>
         <option value="2020">2020年代</option>
       </select>
     </div>
     <div class="edit_submit text-center mt-5">
      <input type="submit" value="OK">
     </div>
     <div class="edit_submit text-center mt-3">
      <input type="button" onclick="history.back()" value="戻る">
     </div>
   </form>
 </div>
 <footer class="bg-dark">
   <p>copyright 2020 Izumi inc.</p>
 </footer>
</body>
</html>
