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
    $sql= 'SELECT  * FROM tweet_tb
    ORDER BY tweet_id DESC';
    $sth=$dbh->query($sql);//SQLの実行
}

date_default_timezone_set('Asia/Tokyo');

function translate_time($time_db){
	$unix	= strtotime($time_db);
	$now	= time();
	$diff_sec	= $now - $unix;
	if($diff_sec < 60){
		$time	= $diff_sec;
		$unit	= "秒前";
	}
	elseif($diff_sec < 3600){
		$time	= $diff_sec/60;
		$unit	= "分前";
	}
	elseif($diff_sec < 86400){
		$time	= $diff_sec/3600;
		$unit	= "時間前";
	}
	elseif($diff_sec < 2764800){
		$time	= $diff_sec/86400;
		$unit	= "日前";
	}
	else{
		if(date("Y") != date("Y", $unix)){
			$time	= date("Y年n月j日", $unix);
		}
		else{
			$time	= date("n月j日", $unix);
		}
		return $time;
	}
	return (int)$time .$unit;
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
        .fa-check-circle{
            color:#0066FF;
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
    <a class="navbar-brand text-primary" href=" ">ホーム<i class="fas fa-2x fa-home"></i></a>
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
</div>
<div class = "container">
    <br><br><br><br>
        <table class = "table">
        <?php
        //データの取り出し
        while($row = $sth ->fetch()){
            $str = $row['tweet'];
            $b = preg_replace("/(?<![0-9a-zA-Z'\"#@=:;])#(\w*[a-zA-Z_0-9ぁ-んァ-ヶ\x{3005}\x{3007}\x{303b}\x{3400}-\x{9FFF}\x{F900}-\x{FAFF}\x{20000}-\x{2FFFF}])/u",
            "<a href=\"hash_tag.php\">#\\1</a>", $str);
            
            $i = $row['image_path'];

            echo '<tbody>';
            echo '<tr>';

            echo '<td>'.'</td>'; 
            echo '<td style="font-size: 5pt; line-height: 200%; ">'.'@'.$row['login_name'].'</td>';
            
            echo '<td style="font-size: 15pt; line-height: 100%;">'.'<b>'.$row['user_name'].'</b>';
            if($row['official_flag']==1){     //公認か判断
                echo "<i class='fas  fa-check-circle'>"."</i>";
            }
            echo'</td>';
            echo '<td>'.'</td>'; 
            echo "</tr>";

            
            echo '<tr>';
            echo '<td  class = d colspan=4>'.nl2br($b).'</td>';
            echo "</tr>";

            

           
            if($i != 'uploads/'){
            echo '<tr>';
            echo '<td  class = d colspan=4>';
            echo "<img src= $i>"; 
            echo'</td>';
            echo "</tr>";
            }
            echo '<tr>';
            echo '<td class = c colspan=4>'.translate_time($row['entry_date']).'</td>';'</td>';
            echo "</tr>";
            
            echo '<tr>';
            echo '<td class = b colspan=1>'.'<button>'."<i class='far fa-2x fa-comment'>".'</i>'.'</button>'.'</td>';
            echo '<td class = b colspan=1>'.'<button>'."<i class='fas fa-2x fa-retweet'>".'</i>'.'</button>'.'</td>';
            echo '<td class = b colspan=1>'.'<button>'."<i class='far fa-2x fa-heart'>".'</i>'.'</button>'.'</td>';
            echo "</tr>";

            echo '<tr>';
            echo '<td>'.'</td>';
            echo '<td>'.'</td>';
            echo "</tr>";
            echo '</button>';
            //セッションの最大値の確保
            $_SESSION['id_MaxNum'] = $row['tweet_id'];
        }  
        echo '</tbody>';  
        ?>
        </table>
</div>
</body>
</html>