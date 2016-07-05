<HTML>
<HEAD>

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
});

$(function(){

    // 行のプルダウンが変更されたら
    $("#gyou").change(function(){
	//select内のオプションを全削除
	var select = document.getElementById('moji');

	var gyou = document.getElementById('gyou').value;

	while (select.firstChild) {
		select.removeChild(select.firstChild);
	}

	//if（選ばれた行が「あ」だったら
	if (gyou == "あ行") {
		//あ～おを追加（OPTIONで）
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'あ');
		option1.innerHTML = 'あ';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'い');
		option2.innerHTML = 'い';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'う');
		option3.innerHTML = 'う';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'え');
		option4.innerHTML = 'え';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'お');
		option5.innerHTML = 'お';
		select.appendChild(option5);
	} else if (gyou == "か行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'か');
		option1.innerHTML = 'か';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'き');
		option2.innerHTML = 'き';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'く');
		option3.innerHTML = 'く';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'け');
		option4.innerHTML = 'け';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'こ');
		option5.innerHTML = 'こ';
		select.appendChild(option5);

	} else if (gyou == "さ行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'さ');
		option1.innerHTML = 'さ';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'し');
		option2.innerHTML = 'し';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'す');
		option3.innerHTML = 'す';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'せ');
		option4.innerHTML = 'せ';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'そ');
		option5.innerHTML = 'そ';
		select.appendChild(option5);

	} else if (gyou == "た行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'た');
		option1.innerHTML = 'た';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'ち');
		option2.innerHTML = 'ち';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'つ');
		option3.innerHTML = 'つ';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'て');
		option4.innerHTML = 'て';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'と');
		option5.innerHTML = 'と';
		select.appendChild(option5);

	} else if (gyou == "な行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'な');
		option1.innerHTML = 'な';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'に');
		option2.innerHTML = 'に';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'ぬ');
		option3.innerHTML = 'ぬ';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'ね');
		option4.innerHTML = 'ね';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'の');
		option5.innerHTML = 'の';
		select.appendChild(option5);

	} else if (gyou == "は行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'は');
		option1.innerHTML = 'は';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'ひ');
		option2.innerHTML = 'ひ';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'ふ');
		option3.innerHTML = 'ふ';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'へ');
		option4.innerHTML = 'へ';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'ほ');
		option5.innerHTML = 'ほ';
		select.appendChild(option5);

	} else if (gyou == "ま行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'ま');
		option1.innerHTML = 'ま';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'み');
		option2.innerHTML = 'み';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'む');
		option3.innerHTML = 'む';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'め');
		option4.innerHTML = 'め';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'も');
		option5.innerHTML = 'も';
		select.appendChild(option5);

	} else if (gyou == "や行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'や');
		option1.innerHTML = 'や';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'ゆ');
		option2.innerHTML = 'ゆ';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'よ');
		option3.innerHTML = 'よ';
		select.appendChild(option3);


	} else if (gyou == "ら行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'ら');
		option1.innerHTML = 'ら';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'り');
		option2.innerHTML = 'り';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'る');
		option3.innerHTML = 'る';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'れ');
		option4.innerHTML = 'れ';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'ろ');
		option5.innerHTML = 'ろ';
		select.appendChild(option5);

	} else if (gyou == "わ行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'わ');
		option1.innerHTML = 'わ';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'を');
		option2.innerHTML = 'を';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'ん');
		option3.innerHTML = 'ん';
		select.appendChild(option3);

	}

	});
})

$(function(){

    // 行のプルダウンが変更されたら
    $("#gyou").change(function(){
	//select内のオプションを全削除
	var select = document.getElementById('moji');

	var gyou = document.getElementById('gyou').value;

	while (select.firstChild) {
		select.removeChild(select.firstChild);
	}

	//if（選ばれた行が「あ」だったら
	if (gyou == "あ行") {
		//あ～おを追加（OPTIONで）
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'あ');
		option1.innerHTML = 'あ';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'い');
		option2.innerHTML = 'い';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'う');
		option3.innerHTML = 'う';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'え');
		option4.innerHTML = 'え';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'お');
		option5.innerHTML = 'お';
		select.appendChild(option5);
	} else if (gyou == "か行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'か');
		option1.innerHTML = 'か';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'き');
		option2.innerHTML = 'き';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'く');
		option3.innerHTML = 'く';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'け');
		option4.innerHTML = 'け';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'こ');
		option5.innerHTML = 'こ';
		select.appendChild(option5);

	} else if (gyou == "さ行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'さ');
		option1.innerHTML = 'さ';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'し');
		option2.innerHTML = 'し';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'す');
		option3.innerHTML = 'す';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'せ');
		option4.innerHTML = 'せ';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'そ');
		option5.innerHTML = 'そ';
		select.appendChild(option5);

	} else if (gyou == "た行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'た');
		option1.innerHTML = 'た';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'ち');
		option2.innerHTML = 'ち';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'つ');
		option3.innerHTML = 'つ';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'て');
		option4.innerHTML = 'て';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'と');
		option5.innerHTML = 'と';
		select.appendChild(option5);

	} else if (gyou == "な行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'な');
		option1.innerHTML = 'な';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'に');
		option2.innerHTML = 'に';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'ぬ');
		option3.innerHTML = 'ぬ';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'ね');
		option4.innerHTML = 'ね';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'の');
		option5.innerHTML = 'の';
		select.appendChild(option5);

	} else if (gyou == "は行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'は');
		option1.innerHTML = 'は';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'ひ');
		option2.innerHTML = 'ひ';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'ふ');
		option3.innerHTML = 'ふ';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'へ');
		option4.innerHTML = 'へ';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'ほ');
		option5.innerHTML = 'ほ';
		select.appendChild(option5);

	} else if (gyou == "ま行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'ま');
		option1.innerHTML = 'ま';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'み');
		option2.innerHTML = 'み';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'む');
		option3.innerHTML = 'む';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'め');
		option4.innerHTML = 'め';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'も');
		option5.innerHTML = 'も';
		select.appendChild(option5);

	} else if (gyou == "や行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'や');
		option1.innerHTML = 'や';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'ゆ');
		option2.innerHTML = 'ゆ';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'よ');
		option3.innerHTML = 'よ';
		select.appendChild(option3);


	} else if (gyou == "ら行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'ら');
		option1.innerHTML = 'ら';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'り');
		option2.innerHTML = 'り';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'る');
		option3.innerHTML = 'る';
		select.appendChild(option3);

		var option4 = document.createElement('option');
		option4.setAttribute('value', 'れ');
		option4.innerHTML = 'れ';
		select.appendChild(option4);

		var option5 = document.createElement('option');
		option5.setAttribute('value', 'ろ');
		option5.innerHTML = 'ろ';
		select.appendChild(option5);

	} else if (gyou == "わ行") {
		var option1 = document.createElement('option');
		option1.setAttribute('value', 'わ');
		option1.innerHTML = 'わ';
		select.appendChild(option1);

		var option2 = document.createElement('option');
		option2.setAttribute('value', 'を');
		option2.innerHTML = 'を';
		select.appendChild(option2);

		var option3 = document.createElement('option');
		option3.setAttribute('value', 'ん');
		option3.innerHTML = 'ん';
		select.appendChild(option3);

	}

	});
})


</SCRIPT>

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


		<title>　50音順　</title>
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

		<h1>50音順</h1>

<?php

//----------------------------------------------------------------------------------------------------
require_once 'DBmanager.php'; //関数呼び出しより手前に記述する

//DB接続
$con = connect();

	//50音順
	echo "<h3>";
	echo '50音順から探す';
	echo "</h3>";

			echo '<div id="box_50on">';

				echo '<select id="gyou">';
					echo '<option value="">選択してください</option>';
					echo '<option value="あ行" class="a">あ行</option>';
					echo '<option value="か行" class="k">か行</option>';
					echo '<option value="さ行" class="s">さ行</option>';
					echo '<option value="た行" class="t">た行</option>';
					echo '<option value="な行" class="n">な行</option>';
					echo '<option value="は行" class="h">は行</option>';
					echo '<option value="ま行" class="m">ま行</option>';
					echo '<option value="や行" class="y">や行</option>';
					echo '<option value="ら行" class="r">ら行</option>';
					echo '<option value="わ行" class="w">わ行</option>';
				echo '</select>';

				echo '<form  action="./gojuSearch.php" method="POST">';
					echo '<select id="moji" class="gojuon" name="slct">';
					echo '<option value="">選択してください</option>';
				echo '</select>';

				echo '<input type="submit" value="検索">';
			echo '</form></div>';



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

