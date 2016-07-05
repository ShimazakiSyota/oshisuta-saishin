<?php
//セッション開始
if(!isset($_SESSION)){
session_start();
}
?>
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

		<title>　分野別　</title>
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

		<h1>分野別</h1>

<?php

//----------------------------------------------------------------------------------------------------
require_once 'DBmanager.php'; //関数呼び出しより手前に記述する

session_destroy();


//DB接続
$con = connect();

$b=1;
	//分野検索
	echo "<div id=\"box_genre\">";
	echo "<ul>";
	echo "<li id=\"btn_z\">";
	echo "<b>分野別から探す</b>";
	$BigTadList = tagSelectAllKubun('0');
	foreach( $BigTadList as $value ){
	$b++;
	echo "<form name='Form2".$b."' action='./subjectImageSearch.php' method = 'POST'>";
	echo "<li id=\"btn_z\">";
	echo "<input type='hidden' name='bunya' value=".$value[0].">";
	echo "<a href='javascript:Form2".$b.".submit()'>";
	echo "<img height='100' img src='./create_image.php?id=".$value[3]."' /></a>";
//	echo "<button type='submit' name='bunya' value='".$value[0]."'>".$value[1]."</button><br>";
	echo "</li>";
	echo "</form>";
	}
	echo "</ul>";
	echo "</div>";


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

