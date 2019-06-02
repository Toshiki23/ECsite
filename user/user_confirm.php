<?php 
session_start();
if (isset($_SESSION['name'])){
    $name = ($_SESSION['name']);
}
if (isset($_SESSION['adress'])){
    $adress = ($_SESSION['adress']);
}
if (isset($_SESSION['email'])){
    $email = ($_SESSION['email']);
}
if (isset($_SESSION['password'])){
    $password = ($_SESSION['password']);
}
if (isset($_SESSION['credit'])){
    $credit = ($_SESSION['credit']);
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
                <div class="container" id="formContainer">
                <?php if(isset($name)): ?>
                <form class="form-signin " id="login" role="form" action="user_complete.php" method="post">
                    <h1 class="form-signin-heading">入力確認</h1>
                    <h4 class="form-signin-heading">Check Your Information</h4>
                    <a href="#" id="flipToRecover" class="flipLink">
                    <div id="triangle-topright"></div>
                    </a>
                    <p class="form-control">Name　　　　　　<?=htmlspecialchars($name);?></p>
                    <p class="form-control">Adress　　　　　<?=htmlspecialchars($adress);?></p>
                    <p class="form-control">Email　　　　　　<?=htmlspecialchars($email);?></p>
                    <p class="form-control">Password　　　　<?=htmlspecialchars($password);?></p>
                    <p class="form-control">Credit Card　　　<?=htmlspecialchars($credit);?></p>

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

