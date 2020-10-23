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
  $staff_code=$_POST['code'];
  $staff_name=$_POST['name'];
  $staff_pass=$_POST['pass'];
  $staff_pass2=$_POST['pass2'];

  $staff_name=htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
  $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');
  $staff_pass2=htmlspecialchars($staff_pass2,ENT_QUOTES,'UTF-8');

  if($staff_name == ''){
      print 'スタッフ名が入力されていません <br />';
  } else{
      print 'スタッフ名';
      print $staff_name;
      print '<br />';
  }

  if($staff_pass == ''){
    print 'パスワードが入力されていません <br />';
  }

  if($staff_pass != $staff_pass2){
    print 'パスワードが一致しません <br />';
  }

  if($staff_name == '' || $staff_pass == '' ||$staff_pass != $staff_pass2){
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
  }

  else{
    $staff_pass = md5($staff_pass);
    print '<form method="post" action="staff_edit_done.php">';
    print '<input type="hidden" name="code" value="'.$staff_code.'">';
    print '<input type="hidden" name="name" value="'.$staff_name.'">';
    print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
    print '<br />';
    print '<input type="submit" value="OK">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
  }

 ?>
</body>
</html>
