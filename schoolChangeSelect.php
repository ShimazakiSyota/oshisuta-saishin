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
			<title>変更学校情報選択画面</title>
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
		<h1>変更学校情報選択画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./schoolTop.php'>学校・学科TOPページへ戻る</a><br></h3>
		</div></div>

<?php

	$schoolAll = getSchoolAll();
			echo "<form action='./schoolChangeKakunin.php' method = 'POST'>";
				$selectedTagFrag = '0'; //最初のラジオボタン用のフラグ
				foreach($schoolAll as $data){
				if($selectedTagFrag =='0'){ 
				echo "<div class='left'><input type='radio' name='selected' value='".$data[0]."' checked='checked'>". $data[1] ."<br />";$selectedTagFrag ='1';}
				else  { echo "<input type='radio' name='selected' value='".$data[0]."'>". $data[1]."<br>";}
				}
echo "</div><br /><center><input type =submit value=変更>";
				echo "</form></center>";
 //データベース切断
dconnect($con);

?>

	</body>
</html>