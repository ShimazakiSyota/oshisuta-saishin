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
			$time = date("Y-m-d H:i:s");//時間の取得
			$KanriName = sessionName($_SESSION['id'],$_SESSION['pass']);//更新者取得
			$comment = cjobstadiumlist($_POST['workID']);

			//コメント変更用情報の更新
			reportUpdate($_POST['report'],$time,$KanriName[0],$_POST['workID']);

			//画像ファイルの更新
			if (is_uploaded_file($_FILES["upfile"]["tmp_name"])){
				picUpd($_FILES['upfile'],$_POST['picID']);
			}
		for ($i=0; $i<10; $i++){
				$delflag = 0;
				if((isset($_POST['deleteall'])) && (isset($comment[$i][3]))){
					foreach($_POST['deleteall'] as $del){
						if($comment[$i][3] == $del){$delflag = 1;}
					}
				}
			if($delflag == 1){workrpdateDelete($comment[$i][3]);
			}else{
			
				if (isset($_POST['report2'][$i] ) && ($_POST['report2'][$i] != "")){
				if (isset($comment[$i][3])){
					//コメントの更新
					workrpdateUpdate($_POST['report2'][$i],$_POST['report3'][$i],$comment[$i][3]);
					//画像ファイルの更新
				if (is_uploaded_file($_FILES["upfile3"]["tmp_name"][$i])) {
					if($comment[$i][0] == 0){
					$picID = picSet2($_FILES["upfile3"],$i);
					commentPicIDUpd3($comment[$i][3],$picID);
					}else{
					picUpd2($_FILES["upfile3"],$i,$comment[$i][0]);
					}
				}else{
				$delflag = 0;
					if((isset($_POST['deletepic'])) && (isset($comment[$i][3]))){
						foreach($_POST['deletepic'] as $del){
							if($comment[$i][3] == $del){$delflag = 1;}
						}
					}
					if($delflag == 1){
					picDelete($comment[$i][0]);
					commentPicIDUpd3($comment[$i][3],0);
					}
				}
					}else{
					//コメントの追加
					$workrpdateID = workrpdateInsert2($_POST['report2'][$i],$_POST['report3'][$i],$_POST['workID']);
						if (is_uploaded_file($_FILES["upfile3"]["tmp_name"][$i])) {
						$picID = picSet2($_FILES["upfile3"],$i);
						commentPicIDUpd3($workrpdateID,$picID);
						}
					}
				}
			}			
		}

		echo "コメントを更新しました";

		dconnect($con); //データベース切断
			?>
	</body>
</html>