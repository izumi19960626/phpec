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
<h1 class="text-center">スタッフ一覧</h1>
<div class="container">
 <?php
// スタッフ参照画面
  if(isset($_POST['disp']) == true){
    if(isset($_POST['procode']) == false){
       header('Location:pro_ng.php');
       exit();
    }
      $pro_code = $_POST['procode'];
      header('Location:pro_disp.php?procode='.$pro_code);
      exit();
     }

// スタッフ追加画面
   if(isset($_POST['add']) == true){
       header('Location:pro_add.php');
       exit();
    }

// スタッフ編集画面
   if(isset($_POST['edit']) == true){
     if(isset($_POST['procode']) == false){
       header('Location:pro_ng.php');
       exit();
     }
       $pro_code = $_POST['procode'];
       header('Location:pro_edit.php?procode='.$pro_code);
       exit();
   }

// スタッフ削除画面
   if(isset($_POST['delete']) == true){
     if(isset($_POST['procode']) == false){
       header('Location:pro_ng.php');
       exit();
     }
       $pro_code = $_POST['procode'];
       header('Location:pro_delete.php?procode='.$pro_code);
       exit();
   }

 ?>
</div>
</body>
</html>
