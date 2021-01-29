<?php
//接続用関数の呼び出し
require_once(__DIR__.'/functions.php');

session_start();
//ログイン確認
if(!(isset($_SESSION['atname']))){
    header('Location:login.html');
}
//選択されているか確認
if(!(isset($_POST['check'][0]))){
    header('Location:home_admin.php');
    exit();
}

//DBへの接続
$dbh=connectDB();

if($dbh){
    //データベースから読み込みSQL文
    $sql= 'SELECT login_name, user_name, user_pass, user_id 
    FROM `user_tb` WHERE ';
    $sql_where = '';

   //削除対象の操作
   for($id=0;$id<$_SESSION['id_MaxNum'];$id++){
       //削除予定のIDのチェック
       if(isset($_POST['check'][$id])){
           if($id > 0){
               $sql_where .= ' OR ';
           }
           //id付与
           $sql_where .= 'user_id ="'.$_POST['check'][$id].'"';
       }
   }
   $sql .= $sql_where; //SELECTように追加

   $sth=$dbh->query($sql);//SQLの実行

   //データベース削除を実行するSQL文
   $sql_del = 'DELETE  from `user_tb` WHERE '.$sql_where;
   $_SESSION['delete'] = $sql_del;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"></script>
   
   <script language = "JavaScript">
function delRecordAlert(){
   res = confirm("このユーザーを削除しますか.\n(この操作は取り消しできません)");
   if(res == true){
       document.delform.submit();  //ここで送信
   }else{
       return false;
   }
}
</script>
</head>

<body>

        <h1>凍結ユーザー確認画面</h1>
    <table border ="1" class = "table">
        <thead>
        <tr  class = "tr">
        <td>ログイン名</td>
        <td>ユーザー名</td>
        <td>パスワード</td>
        </tr>
</thead>
        <?php
        echo $sql_del;
        //データの取り出し
        while($row = $sth ->fetch()){
            echo '<tbody>';
            echo '<tr>';
            echo '<td>'.$row['login_name'].'</td>';
            echo '<td>'.$row['user_name'].'</td>';
            echo '<td>'.$row['user_pass'].'</td>';
            echo "</tr>";
            $_SESSION['id_MaxNum'] = $row['login_name'];
        }    
        echo '</tbody>'
        ?>
        </table><br><br>
        <div class="submit"></div>
    <form action = "delete_user2.php" method = "POST" name = "delform">
    <input type = "submit" value = "削除" onclick = "return delRecordAlert()" class = "submi">
    </form>
</div>
    <?php
    $_SESSION['id_MaxNum'] = 0;
    ?>
</body>
</html>