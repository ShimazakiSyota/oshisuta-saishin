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
		<title>追加職業関連情報選択画面</title>
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
		<h1>追加職業関連情報選択画面</h1>
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

<?php

	$jobAll = jobAll($_POST['jobUpd']);
if($_POST['jobUpd'] != 0){
	$jobKanri = joblist ($_POST['selectedJob']);
}



	mb_regex_encoding("UTF-8"); 

	if ($_POST['jobUpd'] == 0){//職業詳細
		echo "<form action=jobInsert.php method =POST enctype='multipart/form-data' onsubmit='return disp()'>";
		echo "<center>職業名 : <input type='text' size='15' NAME='jobInfo[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='日本語で入力してください' required><br /><br />";
		echo "職業名【ふりがな】: <input type='text' size='15' NAME='jobInfo[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んー一-]+$' title='ひらがなで入力してください' required><br /><br />";
		echo "職業名【英語】：<input type='text' size='15' NAME='jobInfo[]' style='font-family:Tahoma; ime-mode:disabled;' pattern='^[A-Za-z\s]+$' title='英語で入力してください' required><br /><br />";
		echo "一行キャッチコピー：<input type='text' size='15' NAME='jobInfo[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";
		echo "紹介文：<input type='text' size='15' NAME='jobInfo[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";
		echo "写真1：<input type='file' name='upfile' size='30' /><br /><br />";


			echo "</center><div class='left'><H4>連携させたい中分類タグを選択してください</H4>";
					$tagAll = tagSelectAllKubun("1");	//指定された区分のタグ全てを取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($tagAll as $data){
					echo "<input name='Renkei[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}

			echo "<H4>連携させたい感覚タグを選択してください</H4>";
					$tagAll = tagSelectAllKubun("2");	//指定された区分のタグ全てを取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($tagAll as $data){
					echo "<input name='Renkei[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}

			echo "<H4>関連する学科を選択してください</H4>";
					$SchoolAll = getDepartmentAll();	//指定された区分のタグ全てを取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($SchoolAll as $data){
					echo "<input name='RenkeiSchool[]' type='checkbox' value='".$data[0]."'>". $data[2]."<br>";
					}
			echo "<br /></div>";
			echo "<br /><center><input type='submit' value='追加'></center>";
			echo "</form>";

	}else{
			echo "<center>";

			if ($_POST['jobUpd'] == 1) {//学生インタビュー
				echo "<form action='interviewInsert.php' method ='POST' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<input type='hidden' name='interview[]' value ='".$jobKanri[0]."'>";
				echo "見出し:<input type='text' size='20' NAME='interview[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";
				echo "写真：<input type='file' name='upfile' size='30' /><br /><br />";		
				echo "インタビュー時の肩書(例：Webクリエイター科２年) <br /><input type='text' size='20' NAME='interview[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />"; 
				echo "学生名:<input type='text' size='20' NAME='interview[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";
				echo "取材日：<input type='date' name='interview[]'><br /><br />";		
				echo "取材者：<input type='text' size='20' NAME='interview[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";

			for ($i=0; $i<10; $i++){
				echo "<hr color='#FF69B4' size='1'>";
				echo "<h4>コメント追加</h4>";
				echo "写真：<input type='file' name='upfile1[]' size='30' /><br /><br />";		
				echo "Q:<input type='text' size='20' NAME='interview2[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' ><br /><br />";
				echo "A:<textarea name='interview3[]' cols='50' rows='5' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' ></textarea><br /><br />";
			}
				echo "<br /><input type =submit value=追加>";
				echo "</form>";
			}

			if ($_POST['jobUpd'] == 2) { //専門家
				echo "<form action='expertInsert.php' method ='POST' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<input type='hidden' name='expert[]' value ='".$jobKanri[0]."'>";
				echo "見出し:<input type='text' size='20' NAME='expert[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />"; 
				echo "写真：<input type='file' name='upfile2' size='30' /><br /><br />";						
				echo "専門家名 <br /><input type='text' size='20' NAME='expert[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";
			for ($i=0; $i<10; $i++){
				echo "<hr color='#FF69B4' size='1'>";
				echo"<h4>コメント追加</h4>";
				echo "写真：<input type='file' name='upfile3[]' size='30' /><br /><br />";		
				echo "Q:<input type='text' size='20' NAME='expert2[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' ><br /><br />";
				echo "A:<textarea name='expert3[]' cols='50' rows='5' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' ></textarea><br /><br />";
			}
				echo "取材日：<input type='date' size='20' NAME='expert[]' ><br /><br />";		
				echo "取材者：<input type='text' size='20' NAME='expert[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";
				echo "<br /><input type =submit value=追加>";
				echo "</form>";

						
			}
			if ($_POST['jobUpd'] == 3) {//レポート
				echo "<form action='reportInsert.php' method ='POST' enctype='multipart/form-data' onsubmit='return disp()'>";
				echo "<input type='hidden' name='report[]' value ='".$jobKanri[0]."'>";
				echo "見出し:<input type='text' size='20' NAME='report[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";
				echo "写真：<input type='file' name='upfile4' size='30' /><br /><br />";		
			for ($i=0; $i<10; $i++){
				echo "<hr color='#FF69B4' size='1'>";
				echo"<h4>コメント追加</h4>";
				echo "写真：<input type='file' name='upfile5[]' size='30' /><br /><br />";
				echo "見出し：<input type='text' size='20' NAME='report2[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' ><br /><br />";		
				echo "<textarea name='report3[]' cols='50' rows='5' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' ></textarea><br /><br />";
			}
				echo "取材日：<input type='date' size='20' NAME='report[]' ><br /><br />";		
				echo "取材者：<input type='text' size='20' NAME='report[]' style='font-family:Tahoma; ime-mode:auto;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。! ！\n\r\s]+$' title='入力してください' required><br /><br />";
				echo "<br /><input type =submit value=追加>";
				echo "</form>";

						
	}
	echo "</center>";
}


//データベース切断
dconnect($con);

?>
	</body>
</html>