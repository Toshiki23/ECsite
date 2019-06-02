<?php 
session_start();
$name=isset($_SESSION['name'])?$_SESSION['name']:null;
$adress=isset($_SESSION['adress'])?$_SESSION['adress']:null;
$email=isset($_SESSION['email'])?$_SESSION['email']:null;
$password=isset($_SESSION['password'])?$_SESSION['password']:null;
$credit=isset($_SESSION['credit'])?$_SESSION['credit']:null;


unset($_SESSION['name'], $_SESSION['adress'], $_SESSION['email'], $_SESSION['password'], $_SESSION['credit']);


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

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("insert into users (name, adress, email, password, credit) values (?, ?, ?, ?, ?)");   //prepare()の基本的な使い方
        $stmt->execute([$name, $adress, $email, $hash, $credit]);                 //executeが上の配列に代入する
    
        $db=null;
        $stmt=null;
    
}catch(PDOException $e){
    echo $e-> getMessage();
    exit;
}


?>

<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Confirm Account</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            body{
                margin-top: 60px;
            }
            
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <?php if(isset($name)): ?>
                
                <div class="container" id="formContainer">
                    <h1 class="form-signin-heading">登録完了</h1>
                    <h4 class="form-signin-heading">Check Your Information</h4>
                    <a href="#" id="flipToRecover" class="flipLink">
                    <div id="triangle-topright"></div>
                    </a>
                    <p class="form-control">Name　　　　　　<?=htmlspecialchars($name);?></p>
                    <p class="form-control">Adress　　　　　<?=htmlspecialchars($adress);?></p>
                    <p class="form-control">Email　　　　　　<?=htmlspecialchars($email);?></p>
                    <p class="form-control">Password　　　　<?=htmlspecialchars($password);?></p>
                    <p class="form-control">Credit Card　　　<?=htmlspecialchars($credit);?></p>
                    <h2 class="form-signin-heading">以上の内容で登録しました</h2>
                
                <?php else: ?>
                    <p>恐れ入りますがトップページへ行き再入力してください</p>
                <?php endif ?>
                <button class="btn btn-lg btn-mute btn-block" type="submit" onclick="location.href='../main.html'">トップページに戻る</button>

                </div>
            </div>
        </div>
    </body>


</html>



