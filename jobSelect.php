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
		<title>職業詳細変更選択画面</title>
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
		<h1>職業詳細変更選択画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./jobTop.php'>職業TOPページへ戻る</a><br></h3>
		</div></div>

	<center>
	<h2>管理する職業を選択してください</h2>
</center>
		<div class="left">
			<?php


			$jobAll = jobAll($_POST['KanriJobType']);//指定された区分のタグ全てを取得

		//職業詳細を選択したとき
		if($_POST['KanriJobType'] == 0){
			echo "<form action='./jobKakunin.php' method = 'POST'>";
				$selectedTagFrag = '0'; //最初のラジオボタン用のフラグ
				//１ループでタグ1つがボタン形式で表示され、データが無くなるとループを抜けます。
				//while ($data = $jobAll){
				foreach($jobAll as $data){
				if($selectedTagFrag =='0'){ echo "<input type='radio' name='selectedJob' value='".$data[0]."' checked='checked'>". $data[1] ."<br />";$selectedTagFrag ='1';}
				else  { echo "<input type='radio' name='selectedJob' value='".$data[0]."'>". $data[1]."<br>";}
				}
		}
		//職業詳細以外を選択した場合
		if($_POST['KanriJobType'] != 0){
			echo "<form action='./commentKanri.php' method = 'POST'>";
			echo "<input type='hidden' name='KanriJobType' value='".$_POST['KanriJobType']."'>";
				$selectedTagFrag = '0'; //最初のラジオボタン用のフラグ
				//１ループでタグ1つがボタン形式で表示され、データが無くなるとループを抜けます。
				//while ($data = $jobAll){
				foreach($jobAll as $data){
				if($selectedTagFrag =='0'){ echo "<input type='radio' name='selectedJob' value='".$data[0]."' checked='checked'>". $data[1] ."<br />";$selectedTagFrag ='1';}
				else  { echo "<input type='radio' name='selectedJob' value='".$data[0]."'>". $data[1]."<br>";}
				}
		}


					echo "<br />";
					echo "</div><center><input type=submit value=変更>";
					echo "</form>";

			dconnect($con); //データベース切断
		?>
		</center>
	</body>
</html>
