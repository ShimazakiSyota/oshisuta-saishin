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
		<meta http-equiv="REFRESH" content="2;URL=./tagTop.php">
		<title>タグ情報更新</title>
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

			//選択されたタグを更新する
			tagUpdate($_POST['tagZyoho']);
			
			if ($_POST['tagZyoho'][2] != 2) {
			trDelete($_POST['tagZyoho'][0]);
				if(isset($_POST['kanrenTag'])){
					foreach( $_POST['kanrenTag'] as $value ){
					trRelation($_POST['tagZyoho'][0],$value);
					}
				}
			}
			if ($_POST['tagZyoho'][2] != 0) {
			tjrDelete($_POST['tagZyoho'][0]);
				if(isset($_POST['kanrenJob'])){
					foreach( $_POST['kanrenJob'] as $value ){
					tjrRelation($_POST['tagZyoho'][0],$value);
					}
				}
			}
	//画像の更新
if ($_POST['tagZyoho'][2] == 0) {
	$tag = tagCheck($_POST['tagZyoho'][0]);
	if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
		if(($tag[3]) == 0){
		$fileID = picSet($_FILES['upfile']);
			tagFileIDUpdate($_POST['tagZyoho'][0],$fileID);
		}else{
			picUpd($_FILES['upfile'],$tag[3]);
		}
	}
}
			echo $_POST['tagZyoho'][1]."タグを更新しました";
			
			dconnect($con); //データベース切断

			?>
	</body>
</html>
