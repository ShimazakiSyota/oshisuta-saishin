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
		<title>追加職業関連情報選択画面</title>
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
		<h1>追加職業関連情報選択画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./jobTop.php'>職業TOPページへ戻る</a><br></h3>
		</div></div>

<?php

	dconnect($con); //データベース切断

?>
	<center>
		<form action="./jobMake2.php" method="post">
			<button type='submit' name='jobUpd' value="0"><h1>職業詳細追加<h1></button><br /><br /></form>
		<form action="./jobSelect2.php" method="post">			
			<button type='submit' name='jobUpd' value="1"><h1>学生インタビュー追加</h1></button><br /><br />
			<button type='submit' name='jobUpd' value="2"><h1>専門家のコメント追加</h1></button><br /><br />
			<button type='submit' name='jobUpd' value="3"><h1>レポート追加</h1></button><br /><br />
		</form>

	</center>

	</body>
</html>
