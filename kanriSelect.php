<?php
session_start(); //session開始
// エラー出力しない場合
ini_set('display_errors', 0);

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
		<title>職業管理選択画面</title>
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
		<h1>職業管理選択画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./jobTop.php'>職業TOPページへ戻る</a><br></h3>
	</div></div>

<?php


//DB切断
dconnect($con);
?>

<center>
<h2>管理(変更・削除)を行う職業を選択してください。</h2>

	<form action="./jobSelect.php" method="POST">
			<button type='submit' name='KanriJobType' value="0"><H1>職業詳細</H1></button><br /><br />
			<button type='submit' name='KanriJobType' value="1"><H1>学生インタビュー</H1></button><br /><br />
			<button type='submit' name='KanriJobType' value="2"><H1>専門家のコメント</H1></button><br /><br />
			<button type='submit' name='KanriJobType' value="3"><H1>レポート</H1></button><br /><br />
		</form><br>

</center>
	</body>
</html>
