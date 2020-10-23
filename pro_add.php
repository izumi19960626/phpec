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
 <div class="form">
　<h1 class="text-center">商品追加</h1>
 <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
 <div class="container">
  <div class="form_name">
   <p>商品名を入力してください</p>
   <input type="text" name="name">
  </div>
  <div class="form_pass">
   <p>価格を入力してください</p>
   <input type="text" name="price">
  </div>
  <div class="form_img">
   <p>画像を選んでください</p>
   <input type="file" name="gazou" style="width:400px">
  </div>
  <div class="form_button text-center">
   <input type="submit" value="OK">
   <input type="button" onclick="history.back()" value="戻る">
  </div>
 </form>
</div>
</div>
</body>
</html>
