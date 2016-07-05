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
		<title>コメント選択画面</title>
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
		<h1>コメント選択画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./jobTop.php'>職業TOPページへ戻る</a><br></h3>
		</div></div>

<center>
			<?php

		
		//選択された職業情報の取得
		$jobKanri = joblist ($_POST['selectedJob']);


		echo "<br /><h3>職業名<br />" . $jobKanri['JOBNAME'] ."</h3>";

		//学生インタビューの変更処理
		if($_POST['KanriJobType'] == 1){

		//学生インタビューテーブルの取得
		$interviewlist = stviewlist($jobKanri[0]);

			foreach( $interviewlist as $value ){
				echo "<form action='./commentKanri2.php' method='post' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<b>見出し:</b> ".$value['IHEAD']."<br>";
				echo "<b>インタビュー時:</b> ".$value['IATTIME']."<br />";
				echo "<b>学生名:</b> ".$value['STNAME']."<br /><br />";
				echo "<b>取材日:</b> ".$value['IDATE']."<br>";
				echo "<b>取材者:</b> ".$value['INAME']."<br><br />";
			//画像がある場合のみ
	   		if($value['SIMAGE'] != 0) {
	       			echo "画像1<br><img height='100' src='./create_image.php?id=".$value['SIMAGE']."' /><br />";
			}
				echo "<input type='hidden' name='KanriJobType' value='".$_POST['KanriJobType']."'>";
				echo "<input type='hidden' name='selectedJob' value='".$_POST['selectedJob']."'>";
				echo "<input type='hidden' name='studentID' value='".$value['STUDENTID']."'>";
				echo "<br /><input type=submit value=変更><br /><br />";
				echo"</form>";
			}
		}
		

		//専門家のコメントの変更処理
		if($_POST['KanriJobType'] == 2){

		//専門家コメントテーブルの取得
		$expertlist = expertlist($jobKanri[0]);

			foreach( $expertlist as $value ){
				echo "<form action='./commentKanri2.php' method='post' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<h4>見出し</h4>".$value['EHEAD']."<br>";
				echo "<h4>専門家名</h4>".$value['EXNAME']."<br />";
				echo "<h4>取材日</h4>".$value['EDATE']."<br>";
				echo "<h4>取材者</h4>".$value['ENAME']."<br>";
		//画像がある場合のみ
   		if($value['EIMAGE'] != 0) {
       		echo "写真：<img height='100' src='./create_image.php?id=".$value['EIMAGE']."' />";
		}
				echo "<input type='hidden' name='KanriJobType' value='".$_POST['KanriJobType']."'>";
				echo "<input type='hidden' name='selectedJob' value='".$_POST['selectedJob']."'>";
				echo "<input type='hidden' name='expertID' value='".$value['EXPERTID']."'>";
				echo "<br /><br /><input type=submit value=変更><br /><br />";
				echo"</form>";
			}
		}

		//レポートの変更処理
		if($_POST['KanriJobType'] == 3){

		//レポートテーブルの取得
		$reportlist = jobstadiumlist($jobKanri[0]);

			foreach( $reportlist as $value ){
				echo "<form action='./commentKanri2.php' method='post' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<h4>見出し</h4>".$value['WHEAD']."<br>";
				echo "<h4>取材日</h4>".$value['WDATE']."<br>";
				echo "<h4>取材者</h4>".$value['WNAME']."<br>";
			//画像がある場合のみ
   			if($value['WIMAGE'] != 0) {
       				echo "写真：<img height='100' src='./create_image.php?id=".$value['WIMAGE']."' />";
			}
				echo "<input type='hidden' name='KanriJobType' value='".$_POST['KanriJobType']."'>";
				echo "<input type='hidden' name='selectedJob' value='".$_POST['selectedJob']."'>";
				echo "<input type='hidden' name='workID' value='".$value['WORKID']."'>";
				echo "<br /><input type=submit value=変更><br /><br />";
				echo"</form>";
			}
		}



			dconnect($con); //データベース切断
		?>
		</center>
	</body>
</html>