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
		<title>職業関連情報管理トップ画面</title>
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
		<h1>職業関連情報管理トップ画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
	</div></div>

<?php


//DB切断
dconnect($con);
?>

<center>
<h2>管理(変更・削除)を行う職業を選択してください。</h2>

		<form action="./kanriSelect.php" method="POST">
		<button type='submit'><H1>職業変更・削除</H1></button>
		</form></br>

		<form action="./jobMake.php" method="POST">
		<button type='submit'><H1>職業追加</H1></button>
		</form>
</center>
	</body>
</html>
