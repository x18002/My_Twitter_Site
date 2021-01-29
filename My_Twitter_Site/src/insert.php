<?php
//接続用関数の呼び出し
require_once(__DIR__.'/functions.php');

session_start();
//ログイン確認
if(!(isset($_SESSION['atname']))){
    header('Location:login.html');
}
//POSTからの情報を保持
$tweet = $_POST['tweet']; //メッセージ格納

$file_name = $_FILES['filename']['name'];
$file_type = $_FILES['filename']['type'];
$tmp_name = $_FILES['filename']['tmp_name'];

//保存先のディレクトリ
$dir = 'uploads/';

//保存先のファイル名
$upload_name = $dir.$file_name;

//ファイルアップロード
if(($file_type=='image/jpeg') || ($file_type=='image/pjpeg')||($file_type=='image/png')){
    $result = move_uploaded_file($tmp_name, $upload_name);
}


//DBへの接続
$dbh=connectDB();

if($dbh){
    //データベースから読み込みSQL文
    $sql= 'INSERT INTO tweet_tb(user_id, login_name, user_name, tweet, official_flag, image_path)
    VALUES("'.$_SESSION['userid'].'","'.$_SESSION['atname'].'","'.$_SESSION['username'].'","'.$tweet.'","'.$_SESSION['user_class'].'","'.$upload_name.'")';
    $sth=$dbh->query($sql);//SQLの実行
}
header('Location:home_normal.php');
?>