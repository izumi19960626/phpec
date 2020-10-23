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
    if(isset($_POST['staffcode']) == false){
       header('Location:staff_ng.php');
       exit();
    }
      $staff_code = $_POST['staffcode'];
      header('Location:staff_disp.php?staffcode='.$staff_code);
      exit();
     }

// スタッフ追加画面
   if(isset($_POST['add']) == true){
       header('Location:staff_add.php');
       exit();
    }

// スタッフ編集画面
   if(isset($_POST['edit']) == true){
     if(isset($_POST['staffcode']) == false){
       header('Location:staff_ng.php');
       exit();
     }
       $staff_code = $_POST['staffcode'];
       header('Location:staff_edit.php?staffcode='.$staff_code);
       exit();
   }

// スタッフ削除画面
   if(isset($_POST['delete']) == true){
     if(isset($_POST['staffcode']) == false){
       header('Location:staff_ng.php');
       exit();
     }
       $staff_code = $_POST['staffcode'];
       header('Location:staff_delete.php?staffcode='.$staff_code);
       exit();
   }

 ?>
</div>
</body>
</html>
