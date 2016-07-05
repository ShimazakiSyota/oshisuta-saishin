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
		<title>管理職業選択</title>
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
		<h1>管理職業選択</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./jobTop.php'>職業TOPページへ戻る</a><br></h3>
		</div></div>

	<center>
	<h2>管理する職業を選択してください</h2>
</center>
		<div class="left">
			<?php

			$jobAll = jobAll($_POST['jobUpd']);//指定された区分のタグ全てを取得

		//職業詳細以外を選択した場合
		if($_POST['jobUpd'] != 0){
			echo "<form action='./jobMake2.php' method = 'POST'>";
			echo "<input type='hidden' name='jobUpd' value='".$_POST['jobUpd']."'>";
				$selectedTagFrag = '0'; //最初のラジオボタン用のフラグ
				//１ループでタグ1つがボタン形式で表示され、データが無くなるとループを抜けます。
				//while ($data = $jobAll){
				foreach($jobAll as $data){
				if($selectedTagFrag =='0'){ echo "<input type='radio' name='selectedJob' value='".$data[0]."' checked='checked'>". $data[1] ."<br />";$selectedTagFrag ='1';}
				else  { echo "<input type='radio' name='selectedJob' value='".$data[0]."'>". $data[1]."<br>";}
				}
		}
					echo "<br />";
					echo "</div><center><input type=submit value=新規></form><br /><br />";

			dconnect($con); //データベース切断
		?>
		</center>
	</body>
</html>
