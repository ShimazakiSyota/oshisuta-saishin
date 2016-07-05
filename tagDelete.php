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
		<meta http-equiv="REFRESH" content="1;URL=./kanri.php">
		<title>タグ情報削除</title>
<?php
			if($sessionkanri == 'error') {
			    // エラーページへ遷移
				//header("Location: ./sessionMisu.php");
			echo '<meta http-equiv="REFRESH" content="0;URL=./sessionMisu.php">';
			}
?>
	</head>
	<body>
		<h1>タグ情報更新</h1>

			<?php

			//選択されたタグを追加する
			//echo $_POST['tagID'];
			tagDelete( $_POST['tagID']);	

			echo "タグを削除しました";
			
			dconnect($con); //データベース切断

			?>
	</body>
</html>
