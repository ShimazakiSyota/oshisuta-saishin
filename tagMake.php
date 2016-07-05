<?php
session_start(); //session開始

			require_once 'DBmanager.php'; //DBマネージャーの読み込み
			$con = connect(); //データベース接続
			if((isset($_POST["id"]))&&(isset($_POST["pass"]))){
				$_SESSION["id"] = $_POST["id"];
				$_SESSION["pass"] = $_POST["pass"];
			}
			$sessionkanri = sessionCheck($_SESSION['id'],$_SESSION['pass']);//セッションの確認

?>

<html>
	<head>
		<div class="head">
		<title>新規タグ情報入力画面</title>
			<link href="kanristyle.css" rel="stylesheet" type="text/css">
<?php
			if($sessionkanri == 'error') {
			    // エラーページへ遷移
				//header("Location: ./sessionMisu.php");
			echo '<meta http-equiv="REFRESH" content="0;URL=./sessionMisu.php">';
			}
?>

	</head>
<body>
		<h1>新規タグ情報入力画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./tagTop.php'>タグTOPページへ戻る</a><br></h3>
		</div></div>

			<?php

			dconnect($con); //データベース切断
			?>
<center>
	<form action="./tagMake2.php" method = "POST">
	</center><div class='left'>
		タグ名 : <INPUT TYPE="TEXT" size="15" NAME="tagName"><br /><br />
		タグ区分 : <br />
		<input type='radio' name='tagKubun' value='0'>大分類タグ<br />
		<input type='radio' name='tagKubun' value='1' checked='checked'>中分類タグ<br />
		<input type='radio' name='tagKubun' value='2'>感覚タグ<br /></div><br />
		<center><input type ="submit" value="タグの連携を選択する" /></center>
	</form>
	</body>
</html>
