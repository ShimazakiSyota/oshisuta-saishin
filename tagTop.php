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
	<div>
	<head>
		<div class="head">
		<title>タグ管理トップ画面</title>
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
		<h1>タグ管理トップ画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
	</div></div>
	
			<?php
			dconnect($con); //データベース切断

			?>
<center>
<h2>管理(変更・削除)を行うタグを選択してください。</h2>

	<form action="./tagKanriSelect.php" method = "POST">
		<button type='submit' name='kanriTaguType' value='0'><H1>大分類タグ</H1></button><br><br>
		<button type='submit' name='kanriTaguType' value='1'><H1>中分類タグ</H1></button><br><br>
		<button type='submit' name='kanriTaguType' value='2'><H1>感覚タグ</H1></button>
	</form><br>
	
	<form action="./tagMake.php" method = "POST">
		<button type='submit'><H1>新規タグ追加</H1></button>
	</form>
</center>
	</body>
</html>
