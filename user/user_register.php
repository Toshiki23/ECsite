<?php
    session_start();
    unset($_SESSION['name'] ,$_SESSION['adress'] ,$_SESSION['email'] ,$_SESSION['password'] ,$_SESSION['credit']);
    $errors=array();
    $name=null;
    $adress=null;
    $email=null;
    $password=null;
    $credit=null;

    if(isset($_POST["contact"])){
            
            $name=filter_input(INPUT_POST,"name");
            $adress=filter_input(INPUT_POST,"adress");
            $email=filter_input(INPUT_POST,"email");
            $password=filter_input(INPUT_POST,"password");
            $credit=filter_input(INPUT_POST,"credit");

            //名前バリデーション
            if(is_null($name) or strlen($name)==0){
                $errors[] = "名前が入力されていません";
            }elseif(strlen($name)>15){
                $errors[] = "名前が長すぎます";
            }

            // 住所のバリデーション
            if(is_null($adress) or strlen($adress)==0){
                $errors[] = "住所が入力されていません";
            }

            //メールアドレスバリデーション
            if (is_null($email) or strlen($email)==0){
                $errors[] = "メールアドレスが入力されていません";
            }elseif(strlen($email)>30){
                $errors[] = "メールアドレスが長すぎます";
            }elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email) ) {
                $errors[] = "メールアドレスの形式に間違いがあります";
            }elseif(email_dupli($email) == True){
                
                $errors[] = "登録済みのメールアドレスです";
            }

            //パスワードバリデーション
            if(is_null($password) or strlen($password)==0){
                $errors[] = "パスワードは必ず入力してください";
            }elseif(strlen($password)>30){
                $errors[] = "パスワードが長すぎます";
            }elseif(strlen($password)<5){
                $errors[] = "パスワードが短すぎます";
            }

            //  クレジットカードのバリデーション
            if(is_null($credit) or strlen($credit)==0){
                $errors[] = "クレジットカードの番号が入力されていません";
            }elseif(!is_string($credit)){
                $errors[] = "数字で「ー」なしで入力してください";
            }elseif(credit_dupli($credit) == True){
                $errors[] = "登録済みのクレジットカードです";
            }

            //エラー表示
            if($errors !== null){ 
                foreach ($errors as $error){
                   
                } 
            }

            if(is_null($error)){
                $_SESSION['name']=$name;
                $_SESSION['adress']=$adress;
                $_SESSION['email']=$email;
                $_SESSION['password']=$password;
                $_SESSION['credit']=$credit;
                header("Location:user_confirm.php");
                exit();
            }
        }
            

        function email_dupli($email){

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
                //connect
                $dbh-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = $dbh->prepare('SELECT * FROM users WHERE email = :email limit 1');
                $query->execute(array(':email' => $email));
                $result = $query->fetch();

                if($result > 0){
                    return True;
                }
                
            }catch(PDOException $e){
                echo $e-> getMessage();
                exit;
            }           
        }
        function credit_dupli($credit){

            try{

                $dsn = 'mysql:dbname=toshiki1005_myapp;host=mysql8020.xserver.jp;charset=utf8';
                $user = 'toshiki1005_to';
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
                $dbh = new PDO($dsn, $user, $pass, $options);
                //connect
                $dbh-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = $dbh->prepare('SELECT * FROM users WHERE credit = :credit limit 1');
                $query->execute(array(':credit' => $credit));
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
        <title>New Account</title>
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
                    <h1 class="form-signin-heading">新規アカウント入力</h1>
                    <h4 class="form-signin-heading">Please enter</h4>
                    <a href="#" id="flipToRecover" class="flipLink">
                    <div id="triangle-topright"></div>
                    </a>
                    <input type="name" class="form-control" name="name" id="loginName" placeholder="Name" required autofocus>
                    <input type="adress" class="form-control" name="adress" id="loginAdress" placeholder="adress" required>
                    <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Email adress" required>
                    <input type="password" class="form-control" name="password" id="loginPass" placeholder="Password" required>
                    <input type="credit" class="form-control" name="credit" id="loginCredit" placeholder="credit card" required>                    
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="contact">確認する</button>
                </form>
            
                <button class="btn btn-lg btn-mute btn-block" type="submit" onclick="location.href='../main.html'">トップページに戻る</button>

                </div> 
            </div>
        </div>
    </body>


</html>