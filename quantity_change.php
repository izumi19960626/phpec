<?php
 session_start();
 session_regenerate_id(true);

 // $pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
 // $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
 // $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');
 // $max=htmlspecialchars($max,ENT_QUOTES,'UTF-8');

 $max=$_POST['max'];

 for($i=0;$i<$max;$i++){
   if(preg_match('/^[0-9]+$/',$_POST['quantity'.$i])==0){
     print '数量に誤りがあります';
     print '<a href="shop_cartlook.php">カートに戻る</a>';
     exit();
   }
   if($_POST['quantity'.$i]<1 || 10<$_POST['quantity'.$i]){
     print '数量は必ず１個以上、１０個までです';
     print '<a href="shop_cartlook.php">カートに戻る</a>';
     exit();
   }
   $quantity[]=$_POST['quantity'.$i];
 }

 $cart=$_SESSION['cart'];

 for($i=$max;0<=$i;$i--){
   if(isset($_POST['delete'.$i])==true){
     array_splice($cart,$i,1);
     array_splice($quantity,$i,1);
   }
 }

 $_SESSION['cart']=$cart;
 $_SESSION['quantity']=$quantity;


 header('Location:shop_cartlook.php');
 exit();


?>
