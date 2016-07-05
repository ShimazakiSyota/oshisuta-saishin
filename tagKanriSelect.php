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
		<title>変更タグ選択画面</title>
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
		<h1>変更タグ選択画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./tagTop.php'>タグTOPページへ戻る</a><br></h3>
		</div></div>
<center>
	<h2>管理するタグを選択してください</h2></center>
			<?php

			$tagAll = tagSelectAllKubun( $_POST['kanriTaguType']);	//指定された区分のタグ全てを取得

			echo "<form action='./tagKakunin.php' method = 'POST'>";
			
				$selectedTagFrag = '0'; //最初のラジオボタン用のフラグ
				//１ループでタグ1つがボタン形式で表示され、データが無くなるとループを抜けます。
				echo "<h3>";
				foreach($tagAll as $data){
					echo "<div class='left'>";
if($selectedTagFrag =='0'){ echo "<input type='radio' name='selectedTag' value='".$data[0]."' checked='checked'>". $data[1]."<br>"; $selectedTagFrag ='1';}
					else  { echo "<input type='radio' name='selectedTag' value='".$data[0]."'>". $data[1]."<br>";}
					//↑ラジオボタンの表示
					echo "</div>";
				}
				echo "</h3>";
			echo "<center><input type='submit' value='変更'/>";
			echo "</form>";
			
			dconnect($con); //データベース切断
			?>
		</center>
	</body>
</html>
