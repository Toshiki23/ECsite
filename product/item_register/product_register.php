<?php
    session_start();
    unset($_SESSION['item_name'], 
          $_SESSION['item_img'], 
          $_SESSION['introduce'],
          $_SESSION['price']);

    $errors=array();
    $item_name=null;
    $item_img=null;
    $introduce=null;
    $price=null;

    if(isset($_POST["item_register"])){
            
            $item_name=filter_input(INPUT_POST,"item_name");
            $item_img=filter_input(INPUT_POST,"item_img");
            $introduce=filter_input(INPUT_POST,"introduce");
            $price=filter_input(INPUT_POST,"price");

            //商品名バリデーション
            if(is_null($item_name) or strlen($item_name)==0){
                $errors[] = "商品名が入力されていません";
            }elseif(strlen($item_name)>30){
                $errors[] = "商品名が長すぎます";
            }
            //商品URLデーション
            if (is_null($item_img) or strlen($item_img)==0){
                $errors[] = "画像URLが入力されていません";
            }elseif(img_dupli($item_img) == True){
                
                $errors[] = "登録済みの画像です";
            }

            //紹介文バリデーション
            if(is_null($introduce) or strlen($introduce)==0){
                $errors[] = "紹介文は必ず入力してください";
            }elseif(strlen($introduce) > 1500){
                $errors[] = "紹介文が長すぎます";
            }

            //価格バリデーション
            if(is_null($price) or strlen($price)==0){
                $errors[] = "価格は必ず入力してください";
            }elseif($price > 50000){
                $errors[] = "価格は５万円までにしてください";
            }elseif(!is_numeric($price)){
                $errors[] = "価格は数字のみ入力してください";               
            }


            
            if($errors !== null){ 
                foreach ($errors as $error){
                    
                } 
            }



            //エラーがなければセッションに格納
            if(is_null($error)){
                $_SESSION['item_name']=$item_name;
                $_SESSION['item_img']=$item_img;
                $_SESSION['introduce']=$introduce;
                $_SESSION['price']=$price;
                
                header("Location:product_confirm.php");
                exit();
            }
        }
            
        function img_dupli($item_img){
            try{
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
                //connect
                $dbh = new PDO($dsn, $username, $pass, $options);
                $dbh-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = $dbh->prepare('SELECT * FROM products WHERE item_img = :item_img limit 1');
                $query->execute(array(':item_img' => $item_img));
                $result = $query->fetch();

                if($result > 0){
                    return True;
                }
                
            }catch(PDOException $e){
                echo $e-> getMessage();
                exit;
            }           
        }
    ?>
        
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Register Item</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            body{
                margin-top: 60px;
            }
            .vali{
                font-weight: bold;
                font-size: 16px;
               
            }
            
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="container" id="formContainer">

                <form class="form-signin " id="login" role="form" action="" method="post">
                    <?php if($errors !== null): ?>
                        <?php foreach ($errors as $error): ?>
                        <p class="vali"><?php echo "・".$error."<br>"; ?></p>
                        <?php endforeach ?> 
                    <?php endif ?>
                    <h1 class="form-signin-heading">商品登録</h1>
                    <h4 class="form-signin-heading">Please enter</h4>
                    <a href="#" id="flipToRecover" class="flipLink">
                    <div id="triangle-topright"></div>
                    </a>
                    <input type="text" class="form-control" name="item_name" placeholder="Item name" required autofocus>
                    <textarea class="form-control" name="introduce" rows="4" cols="40" placeholder="Introduce" required></textarea>
                    <input type="text" class="form-control" name="price" placeholder="Price(yen)" required>
                    <input type="text" class="form-control" name="item_img" placeholder="Image URL" required>

                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="item_register">確認する</button>
                </form>
            
                <button class="btn btn-lg btn-mute btn-block" type="submit" onclick="location.href='../../main.html'">トップページに戻る</button>

                </div> 
            </div>
        </div>
    </body>


</html>



