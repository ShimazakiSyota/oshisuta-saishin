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
		<meta http-equiv="REFRESH" content="2;URL=./jobTop.php">
		<title>管理情報削除</title>
<?php
			if($sessionkanri == 'error') {
			    // エラーページへ遷移
				//header("Location: ./sessionMisu.php");
			echo '<meta http-equiv="REFRESH" content="0;URL=./sessionMisu.php">';
			}
?>
</head>
	<body>
		<h1>管理情報削除</h1>

			<?php

			//選択されたタグを追加する
			//echo $_POST['jobID'];
			jDelete( $_POST['jobID']);	

			echo "職業を削除しました";
			
			dconnect($con); //データベース切断

			?>
	</body>
</html>
