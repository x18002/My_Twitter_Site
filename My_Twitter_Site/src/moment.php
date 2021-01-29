<?php
//接続用関数の呼び出し
require_once(__DIR__.'/functions.php');

session_start();
//ログイン確認
if(!(isset($_SESSION['atname']))){
    header('Location:login.html');
}
//DBへの接続
$dbh=connectDB();

if($dbh){
    //データベースから読み込みSQL文
    $sql= 'SELECT * FROM tweet_tb
    ORDER BY tweet_id';
    $sth=$dbh->query($sql);//SQLの実行
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>検索する</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"></script>
    <style>
     
        .text-right{
            padding: 0% 10% 1% 0%;
        }
    </style>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="home_normal.php">ホーム<i class="fas fa-2x fa-home"></i></a>
    <div class="collapse navbar-collapse justify-content-around" id="navbarNav4">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-primary" href="moment.php">モーメント <i class="fas fa-2x fa-bolt"></i></a>
            </li>
        </ul>
    
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="oshirase.php">通知 <i class="fas fa-2x fa-bell"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="message.php">メッセージ  <i class="far fa-2x fa-envelope"></i></a>
            </li>
        </ul>
    
    
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="profile.php">プロフィール <i class="fas fa-2x fa-user"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-ellipsis-h"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="write.php"><button type="button" class="btn btn-primary rounded-pill"><i class="fas fa-feather-alt"></i></button></a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <br><br>
    <h2>ツイートを探す</h2>
    探したいツイートに含まれる単語を入力してください。<br><br>
    <form action="search_tweet.php" method="POST">
        <div class="form-inline">
            <div class="form-group  mb-2 col-xs-2">
            <input type="text" class="form-control" id="inputText" placeholder="キーワード検索" size="90%" name="word">
            </div>
            <button type="submit" class="btn btn-primary mb-2 mx-3">検索</button>
        </div>
    </form><br><br><br>


    <h2>ユーザーを探す</h2>
    探したいアカウントの<b>ログイン名('@'がついている名前)</b>を入力してください。<br><br>
    <form action="search_account.php" method="POST">
        <div class="form-inline">
            <div class="form-group  mb-2 col-xs-2">
            <input type="text" class="form-control" id="inputText" placeholder="ユーザー検索" size="90%" name="name">
            </div>
            <button type="submit" class="btn btn-primary mb-2 mx-3">検索</button>
        </div>
    </form><br><br><br>
</div>
</body>
</html>