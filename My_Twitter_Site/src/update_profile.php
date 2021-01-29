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

$user = $_SESSION['atname'];

if($dbh){
    $sql='SELECT * FROM profile_tb
        WHERE login_name = "'.$_SESSION['atname'].'"';
    $sth=$dbh->query($sql);//SQLの実行
}
 //データの取得
 $result=$sth->fetchALL(PDO::FETCH_ASSOC);
 $bio=$result[0]['bio'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"></script>
    <style>
     
        .text-right{
            padding: 0% 10% 1% 0%;
        }
        .contanier{
            background-color:white;
        }
        .a{
            text-align:center;
        }
        .b{
            text-align:center;
        }
        
        thead{
            text-align:center;
        }
        
        .table th, .table td {
            border:none;
        }
        .c{
            font-size: 5pt; line-height: 200%;
        }
        .d{
            font-size:200%;
        }

        .relative {
            position: relative;
        }
        .abc{
            width:100%;
        }
        
        .absolute {
            position: absolute;
            width:25%;
            height:50%;
            right:70%;
            top:70%;
            border-radius:50%;
        }
        .fa-check-circle{
            color:#0066FF;
        }
        .aaa{
            text-align:right;
        }

    </style>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>
<body>
<div class='fixed-top'>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="home_normal.php">ホーム<i class="fas fa-2x fa-home"></i></a>
    <div class="collapse navbar-collapse justify-content-around" id="navbarNav4">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="moment.php">モーメント <i class="fas fa-2x fa-bolt"></i></a>
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
                <a class="nav-link text-primary" href="profile.php">プロフィール <i class="fas fa-2x fa-user"></i></a>
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
</div>
<br><br><br><br>
<h1>プロフィールを変更する</h1><br><br>

<form method="POST" action="update_profile2.php" enctype="multipart/form-data">   
<div class="form-group">
    <h2>ヘッダー画像</h2>
    <input type="file" name="filename-header"><br><br><br><br>
    <h2>プロフィール画像</h2>
    <input type = "file" name="filename-profile"><br><br><br><br>
    <h2>自己紹介</h2>
    <textarea class="form-control" rows="5"  name= "my" style="font-size:200%"; ><?php echo $bio; ?></textarea>
</div>
<div class="text-center">
    <?php echo "<button type='submit' class='btn btn-primary'>".'保存'.'</button>'.'</div>';?>
    </form>
</body>
</html>