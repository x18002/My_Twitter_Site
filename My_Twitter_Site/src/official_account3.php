<?php
//接続用関数の呼び出し
require_once(__DIR__.'/functions.php');
//セッションスタート
session_start();
?>
<?php
//ログイン確認
if(!(isset($_SESSION['atname']))){
    header('Location:login.html');
    exit();
}
if(isset($_SESSION['update'])){
    //DB接続
    $dbh = connectDB();
    if($dbh){
        $sth = $dbh->query($_SESSION['update']);  //SQL実行
        //初期化
        unset($_SESSION['update']);
    }
}
header('Location:home_admin.php');
?>
