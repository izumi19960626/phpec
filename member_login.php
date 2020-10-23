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
       <p>ようこそゲスト様</p>
     <?php else: ?>
       <p>ようこそ、<?php echo $_SESSION['member_name']; ?>さん</p>
       <a class="border logout-button ml-auto" href="member_logout.php">ログアウト</a>
     <?php endif; ?>
     <a href="shop_cartlook.php">カートを見る</a>
    </div>
  </header>
<h1 class="mt-5 mb-4 text-center">会員ログイン</h1>
  <div class="member_login container text-center">
    <form method="post" action="member_login_check.php">
      <p class="mt-3 mb-2">登録メールアドレス</p>
      <input type="text" name="email">
      <p class="mt-3 mb-2">パスワード</p>
      <input type="password" name="pass">
      <div class="edit_submit text-center mt-5">
       <input type="submit" value="ログイン">
      </div>
    </form>
  </div>
  <footer class="bg-dark">
    <p>copyright 2020 Izumi inc.</p>
  </footer>
</body>
</html>
