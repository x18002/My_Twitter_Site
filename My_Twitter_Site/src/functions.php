<?php
require_once(__DIR__.'/config.php');
//データベース（ユーザ）に接続
function connectDB(){
    try{
        return new PDO(DSN,DB_USER,DB_PASSWORD);
    }catch(PODException$e){
        echo $e->getMessage();
        exit;
    }
}
?>