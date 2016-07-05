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
		<meta http-equiv="REFRESH" content="2;URL=./kanri.php">
		<title>職業詳細更新</title>
<?php
			if($sessionkanri == 'error') {
			    // エラーページへ遷移
				//header("Location: ./sessionMisu.php");
			echo '<meta http-equiv="REFRESH" content="0;URL=./sessionMisu.php">';
			}
?>

	</head>
	<body>
		<h1>職業詳細更新</h1>

			<?php

			//職業詳細更新
			jobUpdate($_POST['jobID'],$_POST['jobInfo']);

				//タグの連携
				if(isset($_POST['kanrenTag'])){
					foreach( $_POST['kanrenTag'] as $value){
					tjrRelation($value,$_POST['jobID']);
					}
				}
				if(isset($_POST['RenkeiSchool'])){
					foreach( $_POST['RenkeiSchool'] as $value){
					jobSchoolRelationInsert($_POST['jobID'],$value);
					}
				}


	//画像の更新
	if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
		if(($_POST['jobInfo']['5']) == 0){
		$fileID = picSet($_FILES['upfile']);
			jobFileIDUpdate($_POST['jobID'],$fileID);
		}else{
			picUpd($_FILES['upfile'],$_POST['jobInfo']['5']);
		}
	}
	
			echo "職業情報を更新しました";
			
			dconnect($con); //データベース切断

		?>
	</body>
</html>
