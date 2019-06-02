<?php 
session_start();
$item_name=isset($_SESSION['item_name'])?$_SESSION['item_name']:null;
$item_img=isset($_SESSION['item_img'])?$_SESSION['item_img']:null;
$introduce=isset($_SESSION['introduce'])?$_SESSION['introduce']:null;
$price=isset($_SESSION['price'])?$_SESSION['price']:null;


$includeTaxPrice=floor($price * 1.08);


?>

<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Confirm Item</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            body{
                margin-top: 60px;
                margin-bottom: 60px; 
            }
            img{
            height: 210px;
            width: 300px; 
            }
            
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="container" id="formContainer">
                <?php if(isset($item_name)): ?>
                <form class="form-signin " id="login" role="form" action="product_complete.php" method="post">
                    <h1 class="form-signin-heading">入力確認</h1>
                    <h4 class="form-signin-heading">Check Your Information</h4>
                    <a href="#" id="flipToRecover" class="flipLink">
                    <div id="triangle-topright"></div>
                    </a>
                    <p class="form-control">Item Name　　　　　　<?=htmlspecialchars($item_name);?></p>
                    <p class="form-control">Introduce　　　　　　<?=htmlspecialchars($introduce);?></p>
                    <p class="form-control">Price　　　　　　　　<?=htmlspecialchars($includeTaxPrice);?>円(税込)</p>
                    <p>Item image　　　　　<img src="<?php echo $item_img?>" alt="" ><br></p>

                    <button class="btn btn-lg btn-primary btn-block" type="submit" >登録する</button>
                </form>


                <?php else: ?>
                    <p>恐れ入りますがトップページへ行き再入力してください</p>
                <?php endif ?>
                
                <button class="btn btn-lg btn-mute btn-block" type="submit" onclick="history.back();">前に戻る</button>


                </div> 
            </div>
        </div>
    </body>


</html>





