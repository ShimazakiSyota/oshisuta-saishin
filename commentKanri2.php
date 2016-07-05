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
		<title>コメント変更入力画面</title>
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
		<h1>コメント変更入力画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./jobTop.php'>職業TOPページへ戻る</a><br></h3>
		</div></div>

<script type="text/javascript">
//ポップアップのソース
function disp(){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
        var flag = confirm ( "この内容で追加してよろしいですか？");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
}
</script>
<center>
			<?php

		//選択された職業情報の取得
		$jobKanri = joblist ($_POST['selectedJob']);



		echo "<br /><h3>職業名<br />" . $jobKanri['JOBNAME'] ."</h3>";

		//学生インタビューの変更処理
		if($_POST['KanriJobType'] == 1){

		//学生インタビューテーブルの取得
		$interviewlist2 = stviewlist2($_POST['studentID']);

				echo "<form action='./interviewUpdate.php' method='post' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<b>見出し:</b><input type='text' name='interview[]' value='".$interviewlist2[0][3]."' required><br><br>";
				echo "<b>学生名:</b><input type='text' name='interview[]' value='".$interviewlist2[0][4]."' required><br /><br />";
				echo "<b>取材日:</b><input type='date' name='interview[]' value='".$interviewlist2[0][5]."' required><br><br>";
				echo "<b>取材者:</b><input type='text' name='interview[]' value='".$interviewlist2[0][6]."' required><br><br>";
				echo "<b>インタビュー時:</b><input type='text' name='interview[]' value='".$interviewlist2[0][7]."' required><br /><br />";

				echo "<h4>変更する場合は画像を選択してください</h4>";
				echo "写真：<input type='file' name='upfile' size='30' /><br /><br />";
			//画像がある場合のみ
	   		if($interviewlist2[0][2] != 0) {
	       			echo "画像1<br><img height='100' src='./create_image.php?id=".$interviewlist2[0][2]."' />";
			}
				echo "<input type='hidden' name='picID' value='".$interviewlist2[0][2]."'>";
				echo "<input type='hidden' name='studentID' value='".$interviewlist2[0][0]."'>";

				echo "<h2>コメント変更</h2>";
		//コメント変更用情報取得
		$studentcomment = cstviewlist($interviewlist2[0][0]);
			for ($i=0; $i<10; $i++){
			echo "<hr color='#FF69B4' size='1'>";
				//$KakuninFlag=0;//コメントがあるか確認するフラグ
				//コメントがある場合
				if(isset($studentcomment[$i][3])){
					//画像がある場合のみ
	       			 if($studentcomment[$i][0] != 0) {
					 echo "<img height='100' src='./create_image.php?id=".$studentcomment[$i][0]."' />";
					 echo"<input type='checkbox' name='deletepic[]' value='".$studentcomment[$i][3]."'>この画像を削除<br><br>";
					 }
					
						echo "写真：<input type='file' name='upfile1[]' size='30' /><br /><br />";
						echo "<h4>Q</h4><input type='text' name='interview2[]' value='".$studentcomment[$i][1]."'><br>";
						echo "<h4>A</h4><textarea name='interview3[]' cols=50 rows=5>".$studentcomment[$i][2]."</textarea><br /><br />";
						echo "<input type='hidden' name='commentID[]' value='".$studentcomment[$i][3]."'>";
						echo"<input type='checkbox' name='deleteall[]' value='".$studentcomment[$i][3]."'>このコメントを削除";

				}else{
						//新しいコメントの追加
						echo "<h3>コメント追加</h3>";
						echo "写真：<input type='file' name='upfile1[]' size='30' /><br /><br />";		
						echo "Q:<input type='text' size='20' NAME='interview2[]'><br /><br />";
						echo "A:<textarea name='interview3[]' cols='50' rows='5'></textarea><br /><br />";
						
						echo "<input type='hidden' name='count' value='".$i."'>";
				}
		}
				echo "<br /><input type=submit value='変更'><br /><br />";
				echo"</form>";

	}

		//専門家のコメントの変更処理
		if($_POST['KanriJobType'] == 2){

		//専門家コメントテーブルの取得
		$expertlist2 = expertlist2($_POST['expertID']);

				echo "<form action='./expertUpdate.php' method='post' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<b>見出し:</b><input type='text' name='expert[]' value='".$expertlist2[0][3]."' required><br>";
				echo "<b>専門家名:</b><input type='text' name='expert[]' value='".$expertlist2[0][4]."' required><br /><br />";
				echo "<b>取材日:</b><input type='date' name='expert[]' value='".$expertlist2[0][5]."' required><br>";
				echo "<b>取材者:</b><input type='text' name='expert[]' value='".$expertlist2[0][6]."' required><br>";

				echo "<H4>変更する場合は画像を選択してください</H4>";
				echo "写真：<input type='file' name='upfile' size='30' /><br /><br />";
		//画像がある場合のみ
   		if($expertlist2[0][2] != 0) {
       		echo "写真：<img height='100' src='./create_image.php?id=".$expertlist2[0][2]."' />";
		}
			echo "<input type='hidden' name='picID' value='".$expertlist2[0][2]."'>";
			echo "<input type='hidden' name='expertID' value='".$expertlist2[0][0]."'>";

					echo "<h4>コメント変更</h4>";
		//コメント変更用情報取得
		$expertcomment = cexpertlist($expertlist2[0][0]);
			for ($i=0; $i<10; $i++){
			echo "<hr color='#FF69B4' size='1'>";
				//コメントがある場合
				if(isset($expertcomment[$i][3])){
					//画像がある場合のみ
		   			if($expertcomment[$i][0] != 0) {
			       			echo "<img height='100' src='./create_image.php?id=".$expertcomment[$i][0]."' />";
					 	echo"<input type='checkbox' name='deletepic[]' value='".$expertcomment[$i][3]."'>この画像を削除<br><br>";					
					}
						echo "写真：<input type='file' name='upfile2[]' size='30' /><br /><br />";
						echo "<h4>Q</h4><input type='text' name='expert2[]' value='".$expertcomment[$i][1]."'><br>";
						echo "<h4>A</h4><textarea name='expert3[]' cols=50 rows=5>".$expertcomment[$i][2]."</textarea><br /><br />";
						echo "<input type='hidden' name='commentID[]' value='".$expertcomment[$i][3]."'>";
						echo"<input type='checkbox' name='deleteall[]' value='".$expertcomment[$i][3]."'>このコメントを削除";

				}else{
						//新しいコメントの追加
						echo "<h3>コメント追加</h3>";
						echo "写真：<input type='file' name='upfile2[]' size='30' /><br /><br />";		
						echo "Q:<input type='text' size='20' NAME='expert2[]'><br /><br />";
						echo "A:<textarea name='expert3[]' cols='50' rows='5'></textarea><br /><br />";

						echo "<input type='hidden' name='count' value='".$i."'>";
				}


		}
				echo "<br /><input type=submit value='変更'><br /><br />";
				echo"</form>";

	}


		//レポートの変更処理
		if($_POST['KanriJobType'] == 3){

		//レポートコメントテーブルの取得
		$jobstadiumlist2 = jobstadiumlist2($_POST['workID']);
				echo "<form action='./reportUpdate.php' method='post' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<b>見出し:</b><input type='text' name='report[]' value='".$jobstadiumlist2[0][3]."' required><br>";
				echo "<b>取材日:</b><input type='date' name='report[]' value='".$jobstadiumlist2[0][4]."' required><br>";
				echo "<b>取材者:</b><input type='text' name='report[]' value='".$jobstadiumlist2[0][5]."' required><br>";

				echo "<H4>変更する場合は画像を選択してください</H4>";
				echo "写真：<input type='file' name='upfile' size='30' /><br /><br />";
			//画像がある場合のみ
   			if($jobstadiumlist2[0][2] != 0) {
       				echo "写真：<img height='100' src='./create_image.php?id=".$jobstadiumlist2[0][2]."' />";
			}
				echo "<input type='hidden' name='picID' value='".$jobstadiumlist2[0][2]."'>";
				echo "<input type='hidden' name='workID' value='".$jobstadiumlist2[0][0]."'>";


					echo "<h4>コメント変更</h4>";
		//コメント変更用情報取得
		$reportcomment = cjobstadiumlist($jobstadiumlist2[0][0]);
			for ($i=0; $i<10; $i++){
			echo "<hr color='#FF69B4' size='1'>";
				//コメントがある場合
				if(isset($reportcomment[$i][3])){
					//画像がある場合のみ
		   			if($reportcomment[$i][0] != 0) {
			       			echo "<img height='100' src='./create_image.php?id=".$reportcomment[$i][0]."' />";
					 	echo"<input type='checkbox' name='deletepic[]' value='".$reportcomment[$i][3]."'>この画像を削除<br><br>";
					}
						echo "写真：<input type='file' name='upfile3[]' size='30' /><br /><br />";
						echo "<h4>Q</h4><input type='text' name='report2[]' value='".$reportcomment[$i][1]."'><br>";
						echo "<h4>A</h4><textarea name='report3[]' cols=50 rows=5>".$reportcomment[$i][2]."</textarea><br /><br />";
						echo "<input type='hidden' name='commentID[]' value='".$reportcomment[$i][3]."'>";
						echo"<input type='checkbox' name='deleteall[]' value='".$reportcomment[$i][3]."'>このコメントを削除";
				}else{
						//新しいコメントの追加
						echo "<h3>コメント追加</h3>";
						echo "写真：<input type='file' name='upfile3[]' size='30' /><br /><br />";		
						echo "Q:<input type='text' size='20' NAME='report2[]'><br /><br />";
						echo "A:<textarea name='report3[]' cols='50' rows='5'></textarea><br /><br />";
				
						echo "<input type='hidden' name='count' value='".$i."'>";
				}
		}
				echo "<br /><input type=submit value='変更'><br /><br />";
				echo"</form>";

	}



			dconnect($con); //データベース切断
		?>
		</center>
	</body>
</html>