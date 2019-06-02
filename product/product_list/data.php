<?php require_once('item.php'); ?>

<?php
session_start();

    $id=isset($_SESSION['id'])?$_SESSION['id']:null;


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

        //idを取得し名前を表示させる
        $stmt = $db->prepare("select * from users where id=?"); 
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $users['name'];                                  

        //データベースに登録されている商品を表示させる
        $stmt = $db->query("select * from products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db=null;
        $stmt=null;

        $items=array();
        foreach ($products as $product){
            $items[] = new Product($product['productId'], $product['item_name'], $product['item_img'], $product['introduce'], $product['price']);
        }

        
    }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }    


?>


