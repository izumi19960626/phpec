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

  try{
    $member_email=$_POST['email'];
    $member_pass=$_POST['pass'];

    $member_pass=md5($member_pass);

    $member_email=htmlspecialchars($member_email,ENT_QUOTES,'UTF-8');
    $member_pass=htmlspecialchars($member_pass,ENT_QUOTES,'UTF-8');

    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='root';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT code,name FROM dat_member WHERE email=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $member_email;
    $data[] = $member_pass;
    $stmt->execute($data);

    $dbh = null;

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    if($rec==false)
    {
        print 'メールアドレスかパスワードが間違っています <br />';
        print '<a href="member_login.php">戻る</a>';
    }
    else
    {
        session_start();
        $_SESSION['member_login']=1;
        $_SESSION['member_code']=$rec['code'];
        $_SESSION['member_name']=$rec['name'];
        header('Location:shop_list.php');
        exit();
    }
  }
  catch(Exception $e){
    print 'ただいまご迷惑をおかけしております';
  }

 ?>
</body>
</html>
