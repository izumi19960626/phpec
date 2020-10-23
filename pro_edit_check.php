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

  $pro_code=$_POST['code'];
  $pro_name=$_POST['name'];
  $pro_price=$_POST['price'];
  $pro_gazou_name_old=$_POST['gazou_name_old'];
  $pro_gazou=$_FILES['gazou'];

  $pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
  $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
  $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

  if($pro_gazou['size'] > 0)
   {
    if($pro_gazou['size'] > 100000){
      print '画像が大きすぎます';
    }
    else{
      move_uploaded_file($pro_gazou['tmp_name'],'./img/'.$pro_gazou['name']);
      print '<div class="pro_img" style="width:250px; height:250px;">';
      print '<img src="./img/'.$pro_gazou['name'].'" style="width:100%; height:100%;">';
      print '</div>';
    }
   }

  if($pro_name == ''){
      print '商品名が入力されていません <br />';
  } else{
      print '商品名';
      print $pro_name;
      print '<br />';
  }

  if($pro_price== ''){
    print '価格が入力されていません <br />';
  }
  if($pro_name == '' || $pro_price== '' || $pro_gazou['size'] > 100000){
    print '商品情報を入力してください';
  }
  else{
    print '上記のように変更します。';
    print '<form method="post" action="pro_edit_done.php">';
    print '<input type="hidden" name="code" value="'.$pro_code.'">';
    print '<input type="hidden" name="name" value="'.$pro_name.'">';
    print '<input type="hidden" name="price" value="'.$pro_price.'">';
    print '<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
    print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
    print '<br />';
    print '<input type="submit" value="OK">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
  }

 ?>
</body>
</html>
