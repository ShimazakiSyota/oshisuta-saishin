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
		<title>職業追加</title>
<?php
			if($sessionkanri == 'error') {
			    // エラーページへ遷移
				//header("Location: ./sessionMisu.php");
			echo '<meta http-equiv="REFRESH" content="0;URL=./sessionMisu.php">';
			}
?>
</head>
	<body>
			<?php

			date_default_timezone_set('Asia/Tokyo');

		$jobid = $_POST['report'];
		$time = date("Y-m-d H:i:s");
		$KanriName = sessionName($_SESSION['id'],$_SESSION['pass']);
			//専門家詳細
			$work = reportInsert($_POST['report'],$_FILES['upfile4'],$time,$KanriName[0]);

			//専門家コメントの追加
			$xyz = workrpdateInsert($_POST['report2'],$_POST['report3'],$_FILES['upfile5'],$work);

		echo "コメントを追加しました";

		dconnect($con); //データベース切断
			?>
	</body>
</html>