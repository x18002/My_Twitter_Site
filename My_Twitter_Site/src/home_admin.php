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
    $sql= 'SELECT login_name, user_name, user_pass, admin_flag, user_id
    FROM user_tb
    WHERE admin_flag = 0';
    $sth=$dbh->query($sql);//SQLの実行
}
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
     .submit{
            text-align:center;
        }
        
        .submi{
            display: inline-block;
            padding: 0.5em 1em;
            text-decoration: none;
            background: #668ad8;/*ボタン色*/
            color: #FFF;
            border-bottom: solid 4px #627295;
            border-radius: 3px;
        }
        .submi:hover {
        /*ボタンを押したとき*/
        -webkit-transform: translateY(4px);
        transform: translateY(4px);/*下に動く*/
        border-bottom: none;/*線を消す*/
        }

        .submii{
            display: inline-block;
            padding: 0.5em 1em;
            text-decoration: none;
            background: #668ad8;/*ボタン色*/
            color: #FFF;
            border-bottom: solid 4px #627295;
            border-radius: 3px;
        }
        .submii:hover {
        /*ボタンを押したとき*/
        -webkit-transform: translateY(4px);
        transform: translateY(4px);/*下に動く*/
        border-bottom: none;/*線を消す*/
        }
    </style>
</head>
<body>
    <h2>こちらは管理者ページです</h2>
    <h2>ユーザの凍結ができます</h2>
    <a href="official_account.php"><button type="button" class="btn btn-primary">公認バッジ付与ページへ</button></a><br><br>
    <a href="logout.php"><button type="button" class="btn btn-danger">ログアウト</button></a><br><br>
<form method = "POST" action = "delete_user.php">
    <table class = "table">
        <tr class = "tr">
        <td></td>
        <td>ログイン名</td>
        <td>ユーザー名</td>
        <td>パスワード</td>
        </tr>
        <?php
        //データの取り出し
        while($row = $sth ->fetch()){
            echo '<tr>';
            echo '<td><input type="checkbox" name = "check[]" value = "'.
            $row['user_id'].'"></td>';
            echo '<td>'.$row['login_name'].'</td>';
            echo '<td>'.$row['user_name'].'</td>';
            echo '<td>'.$row['user_pass'].'</td>';
            echo "</tr>";
            //セッションの最大値の確保
            $_SESSION['id_MaxNum'] = $row['user_id'];
        }    
        ?>
        </table><br><br>
        <div class="submit">
        <input type = "submit" value = "凍結させる" class = "submi">
        <input type = "reset" value = "選択項目をリセット" class = "submii"><br>
        </div>

        </form>
</body>
</html>