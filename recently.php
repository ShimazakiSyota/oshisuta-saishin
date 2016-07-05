<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">

//ページトップ
$(document).ready(function() {
  var pagetop = $('.pagetop');
    $(window).scroll(function () {
       if ($(this).scrollTop() > 100) {
            pagetop.fadeIn();
       } else {
            pagetop.fadeOut();
            }
       });
       pagetop.click(function () {
           $('body, html').animate({ scrollTop: 0 }, 500);
              return false;
   });
});</SCRIPT>

<style type="text/css">

.displayNone {
    display: none;
}

.accordion {
    margin: 0 0 10px;
    padding: 10px;
}

.switch {
    font-weight: bold;
}

.open {
    text-decoration: underline;
}

.btn {
    background:transparent url(btn.png) no-repeat 0 0;
    display: block;
    width:35px;
    height: 35px;
    position: absolute;
    top:20px;
    right:20px;
    cursor: pointer;
    z-index: 200;
}
.peke {
    background-position: -35px 0;
}
.drawr {
    display: none;
    background-color:rgba(0,0,0,0.6);
    position: absolute;
    top: 0px;
    right:0;
    width:260px;
    padding:60px 0 20px 20px;
    z-index: 100;
}
#menu li {
    width:260px;
}
#menu li a {
    color:#fff;
    display: block;
    padding: 15px;
}        

</style>




<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
//ハンバーガーメニュー
$(function($) {
        WindowHeight = $(window).height();
        $('.drawr').css('height', WindowHeight); //メニューをwindowの高さいっぱいにする

        $(document).ready(function() {
                $('.btn').click(function(){ //クリックしたら
                        $('.drawr').animate({width:'toggle'}); //animateで表示・非表示
                        $(this).toggleClass('peke'); //toggleでクラス追加・削除
                });
        });
});
</SCRIPT>
		<title>　気になる仕事　</title>
	</head>
	<body>
		<header>
			<div id="header">
				<!--タイトル-->
				<h1><img src="//シゴト部"></h1>

				<!--メインメニュー-->
				<a class="btn"></a>
				<div class="drawr">
    				<ul id="menu" style="list-style:none;">
    				<li><a href="topPage.php">HOME</a></li>
    				<li><a href="bunya.php">分野から探す</a></li>
    				<li><a href="image.php">イメージから探す</a></li>
    				<li><a href="gojyu.php">五十音から探す</a></li>
    				<li><a href="ranking.php">気になるランキング</a></li>
    				<li><a href="recently.php">最近気になった仕事</a></li>
    				<li><form action="freewordSearch.php" method="POST"><input type="text" name="message" pattern='[^\\x22\\x27]*'  required><input type="submit"></form></li>
    				</ul>
			</div>
		</header>


		<h1>気になる仕事</h1>
<?php

//----------------------------------------------------------------------------------------------------
require_once 'DBmanager.php'; //関数呼び出しより手前に記述する

//DB接続
$con = connect();
//クッキー値取得
 
	if(isset($_COOKIE['Terminalid'])){
		//cookie登録されている
		$tid=$_COOKIE['Terminalid'];
	}else{
		//cookie登録されていない
		$queryset=terminal();
		$queryset=$queryset+1;
		//cookie登録↓
		$flag = setcookie('Terminalid',"$queryset",time()+ 2 * 365 * 24 * 3600);
		//端末番号最後尾更新
		terminalup($queryset);
		$tid = $queryset;

	}

//SQL文セット
$arr = recently($tid);

//逆にする
$arr1 = array_reverse($arr);

//件数
$dataCount = count($arr1);

if (!empty($arr1)){


echo '<div id="box_">';

echo '<h2>';
//データの数
echo $dataCount.'件';
echo '</h2>';


//１ページあたりの表示数
//20個ずつ
$perNum = 20;
//最大ページ数
$maxPageNum = ceil($dataCount / $perNum);

//URLにページ数が指定されてなければ１に
$nowPageNum = empty($_GET["page"]) ? 1 : $_GET["page"];

//次のページの値
$nextPageNum = $nowPageNum + 1;

//前のページの値
$prevPageNum = $nowPageNum - 1;

$page = $nowPageNum * 20 - 19 ;
//
//データを表示させる始点と終点
$startPoint = ($nowPageNum == 1) ? 0 : ($nowPageNum - 1) * $perNum;
$endPoint = $nowPageNum * $perNum;

//何件から何件
$aaaa;

if($endPoint >= $dataCount){
	$aaaa = 20 - ($endPoint - $dataCount);
}
else{
	$aaaa = 20;
}
	echo '(';
	echo $page;
	echo '～';
	echo $page + $aaaa - 1;
	echo '件を表示)';
	echo '<br />';



	for($i = $startPoint; $i < $endPoint; $i++){
		if($i >= $dataCount) break;



//最近気になった仕事
		echo "<li id=\"list\">";
		echo "<form name='Form".$i."' method='post' action='jobdetail.php'>";
		echo "<input type='hidden' name='jobid' value=".$arr1[$i][0].">";
		echo "<a href='javascript:Form".$i.".submit()'>".$arr1[$i][1]."</a>";
		echo "</form>";
		echo "</li>";
	}


		
	echo '<div id="list_page"><ul>';

	//最初のページ以外で「前へ」を表示
	if($nowPageNum != 1){
		echo '<li><a href="?page='.$prevPageNum.'"><img>前へ</a></li><br />';
	}

	//ページ数表示
	for($p = 1; $p <= $maxPageNum; $p++) {
		echo '<li><a href="?page='.$p.'">'.$p.'</a></li><br />';
	}

	//最後のページ以外で「次へ」を表示
	if($nowPageNum < $maxPageNum){
		echo '<li><a href="?page='.$nextPageNum.'"><img>次へ</a></li><br />';
	}

	echo '</ul></div>';

}else{
	echo '<div id="list_result">';
	echo 'お気に入りを登録していません。';
	echo '</div>';
}

//DB切断
dconnect($con);

?>

<footer>
<div id="footer">

<!--先頭に戻る-->
<p id="page_top" style="display: block;"><a href="#wrap">トップ</a></p>

<?php
//フリーワード
echo '<form action="freewordSearch.php" method="POST">';
echo '<input type="search" name="message" pattern="[^\\x22\\x27]*"  required >';
echo '<input type="submit">';
echo '</form>';
?>

<ul id="menu_ft">

<!--分野画面遷移-->
<li>
<a href="bunya.php">分野から探す</a>
<a href="bunya.php"><img></a>
</li>

<!--イメージ画面遷移-->
<li>
<a href="image.php">イメージから探す</a>
<a href="image.php"><img></a>
</li>

<!--50音画面遷移--><li>

<a href="gojyu.php">50音から探す</a>
<a href="gojyu.php"><img></a>
</li>

<!--気になるランキング画面遷移-->
<li>
<a href="ranking.php">気になるランキング</a>
<a href="ranking.php"><img></a>
</li>

<!--最近気になった仕事画面遷移-->
<li>
<a href="recently.php">最近気になった仕事</a>
<a href="recently.php"><img></a>
</li>

<!--HOME画面遷移-->
<li>
<a href="topPage.php">HOME</a>
<a href="topPage.php"><img></a>
</li>

</ul>

<!--サイトについて-->
<a href="">サイトについて</a>

<!--メンバー-->
<a href="">メンバー</a>

<!--サポート会社-->
<a href="">サポート会社</a>

<!--お問い合わせ-->
<a href="">お問い合わせ</a>

<p>将来なりたい仕事、決まっていますか？シゴト部では、進路で悩んでいる高校生向けに２００以上のお仕事を分かりやすく紹介！たくさんのお仕事の中からあなたの気になるお仕事を探しましょう！</p>

<p id="copy"><small>Copyright (c) shigotobu.All Right Reserved.</small></p>

</div>

</footer>

</body>
</html>
