<?php 
require_once('product_list/data.php');

    if(!isset($_SESSION['id'])){
      header('Location: ../login.php');
    }

    $data=isset($_SESSION['data'])?$_SESSION['data']:null;
    $total=isset($_SESSION['total'])?$_SESSION['total']:null;

    if(isset($_SESSION['data'])){

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
            $db = new PDO($dsn, $username, $pass, $options);
            $db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //idから住所、クレジットカードを取得
            $stmt = $db->prepare("select * from users where id=?"); 
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $users = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $users['email'];
            $adress = $users['adress'];  
            $credit = $users['credit'];                                  

            //Ordersテーブルに登録登録する
            $stmt = $db->prepare("INSERT INTO orders (userId, total, adress, credit) VALUES (:userId, :total, :adress, :credit)");   //prepare()の基本的な使い方
            $stmt->bindValue(':userId', $id, PDO::PARAM_INT);
            $stmt->bindValue(':total', $total, PDO::PARAM_STR);
            $stmt->bindValue(':adress', $adress, PDO::PARAM_STR);
            $stmt->bindValue(':credit', $credit, PDO::PARAM_STR);
            $stmt->execute(); 
            $orderId = $db->lastInsertId();

            //Orders_detailテーブルに登録登録する
            foreach($data as $productId => $num){
                $stmt = $db->prepare("INSERT INTO orders_detail (orderId, productId, num) VALUES (:orderId, :productId, :num)");   //prepare()の基本的な使い方
                $stmt->bindValue(':orderId', $orderId, PDO::PARAM_INT);
                $stmt->bindValue(':productId', $productId, PDO::PARAM_STR);
                $stmt->bindValue(':num', $num, PDO::PARAM_STR);
                $stmt->execute(); 
            }

            // mb_language("Japanese");
            // mb_internal_encoding("UTF-8");

            // $to = $email;
            // $title = "商品購入完了";
            // $content = "商品の購入が完了しました。またのご利用お待ちしております！";

            // if (mb_send_mail($to, $title, $content)) {
            // echo "メールが送信されました。";
            // } else {
            // echo "メールの送信に失敗しました。";
            // }

            $db=null;
            $stmt=null;

            session_destroy();

            
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }   
    
    }else{
        $id=NULL;
    }



?>

<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Complete Pay</title>
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
                <?php if(isset($users)): ?>
                    <h1 class="form-signin-heading">注文完了</h1>
                    <h4 class="form-signin-heading">商品のお届け先、クレジットカード情報は以下の通りです</h4>
                    <a href="#" id="flipToRecover" class="flipLink">
                    <div id="triangle-topright"></div>
                    </a>
                    <p class="form-control">Your Name　　　　　　　<?=htmlspecialchars($users['name']);?></p>
                    <p class="form-control">Your adress　　　　　　　<?=htmlspecialchars($users['adress']);?></p>
                    <p class="form-control">Your credit card　　　　　<?=htmlspecialchars($users['credit']);?></p>
                   
                    <p class="form-control">Total　　　　　　　　　　<?=htmlspecialchars($total);?>円</p>



                <?php else: ?>
                    <p>恐れ入りますがトップページへ行き再入力してください</p>
                <?php endif ?>
                
                <button class="btn btn-lg btn-mute btn-block" type="submit" onclick="location.href='../main.html'">トップページ</button>


                </div> 
            </div>
        </div>
    </body>


</html>


