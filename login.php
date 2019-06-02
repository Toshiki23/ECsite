<?php
session_start();


    unset($_SESSION['email']);

$err="";

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];                

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


            $stmt = $db->prepare('select * from users where email=? ');
            $stmt->execute(array($email));
            $users = $stmt->fetch();
            $stmt=null;
            $db=null;


            if(password_verify($password, $users['password'])){
                $_SESSION['id']=$users['id'];
                header('Location: product/product_list.php');
                exit;                
            }else{
                $err="・ユーザー名またはパスワードに誤りがあります";

            }

           

        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }    
    }
?>

<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            .vali{
                font-weight: bold;
                font-size: 16px;
                margin-top: 60px;
            }
            
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="container" id="formContainer">
                <p class="vali"><?php if($err !== null && $err !== "" ) {echo $err . "<br>"; }?></p>

                <form class="form-signin " id="login" role="form" action="" method="post">
                    <h3 class="form-signin-heading">Please sign in</h3>
                    <a href="#" id="flipToRecover" class="flipLink">
                    <div id="triangle-topright"></div>
                    </a>
                    <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Email address" required autofocus>
                    <input type="password" class="form-control" name="password" id="loginPass" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name=login>ログイン</button>
                </form>
            

                <button class="btn btn-lg btn-mute btn-block" type="submit" name=login onclick="location.href='main.html'">トップページへ</button>

                </div> 
            </div>
        </div>
    </body>


</html>