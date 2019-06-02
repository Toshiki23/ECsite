<?php 
session_start();
$item_name=isset($_SESSION['item_name'])?$_SESSION['item_name']:null;
$item_img=isset($_SESSION['item_img'])?$_SESSION['item_img']:null;
$introduce=isset($_SESSION['introduce'])?$_SESSION['introduce']:null;
$price=isset($_SESSION['price'])?$_SESSION['price']:null;

$includeTaxPrice=floor($price * 1.08);


unset($_SESSION['item_name'], $_SESSION['item_img'], $_SESSION['introduce'], $_SESSION['price']);

        $dsn = 'mysql:dbname=toshiki1005_myapp;host=mysql8020.xserver.jp;charset=utf8';
        $username = 'toshiki1005_to';
        $pass = 'fumiya1118';
        $options = array(
            // SQL実行失敗時にはエラーコードのみ設定
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
            // デフォルトフェッチモードを連想配列形式に設定
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
            // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        );
try{
    //connect
    $db = new PDO($dsn, $username, $pass, $options);
    $db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO products (item_name, item_img, introduce, price) VALUES (:item_name, :item_img, :introduce, :price)");   //prepare()の基本的な使い方
    $stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
    $stmt->bindValue(':item_img', $item_img, PDO::PARAM_STR);
    $stmt->bindValue(':introduce', $introduce, PDO::PARAM_STR);
    $stmt->bindValue(':price', $price, PDO::PARAM_STR);

    $stmt->execute();                 
    
}catch(PDOException $e){
    echo $e-> getMessage();
    exit;
}

?>

<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Complete Item</title>
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
                    <h1 class="form-signin-heading">登録完了</h1>
                    <h4 class="form-signin-heading">Complete to register</h4>
                    <a href="#" id="flipToRecover" class="flipLink">
                    <div id="triangle-topright"></div>
                    </a>
                    <h3 style="font-weight: boid; ">以下の内容で登録しました</h3>
                    <p class="form-control">Item Name　　　　　　<?=htmlspecialchars($item_name);?></p>
                    <p class="form-control">Introduce　　　　　　<?=htmlspecialchars($introduce);?></p>
                    <p class="form-control">Price　　　　　　　　<?=htmlspecialchars($includeTaxPrice);?>円(税込)</p>
                    <p>Item image　　　　　<img src="<?php echo $item_img?>" alt="" ><br></p>


                <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="location.href='product_register'">商品登録に戻る</button>


                <?php else: ?>
                <?php session_destroy(); ?>
                    <p>恐れ入りますがトップページへ行き再入力してください</p>
                <?php endif ?>
                <button class="btn btn-lg btn-mute btn-block" type="submit" onclick="location.href='../../main.html'">トップページに戻る</button>

                </div> 
            </div>
        </div>
    </body>


</html>










