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
		<title>変更職業情報入力画面</title>
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
		<h1>変更職業情報入力画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./jobTop.php'>職業TOPページへ戻る</a><br></h3>
		</div></div>

<script type="text/javascript">
//ポップアップのソース
function disp(){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
        var flag = confirm ( "本当に削除してもよろしいですか？");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
}
function disp2(){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
        var flag = confirm ( "この内容で更新してよろしいですか？");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
}
</script>

		

<?php

//選択された職業を送り、そのタグ情報と関連情報を取得
$jobKanri = joblist ($_POST['selectedJob']);
$jobKanri2 = jobKanri($_POST['selectedJob']);
$jobKanri3 = getDepartmentID($_POST['selectedJob']);
$jobKanri4 = getDepartmentAll();


//職業名表示
echo "<center><H2>職業名：".$jobKanri[1]."</H2>";
	echo "<form action='./jobDelete.php' method='POST' onsubmit='return disp()'>";
	echo "<button class='del' type='submit' name='jobID' value='".$jobKanri[0]."'>この職業を削除する</button>";
	echo "</form>";

//職業詳細取得
echo "<form action='./jobUpdate.php' method='post' enctype='multipart/form-data' onsubmit='return disp2()'><br /><br />";
	echo "職業名<br /><input type='text' name='jobInfo[]' value='" . $jobKanri['JOBNAME'] ."'><br /><br />";
	echo "職業名【ふりがな】<br /><input type='text' name='jobInfo[]' value='" . $jobKanri['JOBJPN'] ."'><br /><br />";
	echo "職業名【英語】<br /><input type='text' name='jobInfo[]' value='". $jobKanri['JOBENG'] ."'><br /><br />";
	echo "一行キャッチコピー<br /><input type='text' name='jobInfo[]' value='". $jobKanri['JOBCC'] ."'><br /><br />";
	echo "紹介文<br /><input type='text' name='jobInfo[]' value='". $jobKanri['JOBINTRO'] ."'><br /><br />";

	//画像がある場合のみ
   		if($jobKanri['JIMAGE'] != 0) {
       		echo "画像1：<img height='100' src='./create_image.php?id=".$jobKanri['JIMAGE']."' />";
		}
		echo "<H4>変更する場合は画像を選択してください</H4>";
		echo "写真1：<input type='file' name='upfile' size='30' /><br /><br /></center>";
echo "<div class='left'><H3>連携させる中分類タグを選択してください</H3>";

//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
		foreach($jobKanri2[0] as $data){
				
		$renkeiFlag=0;//連携しているか確認するフラグ
			foreach($jobKanri2[1] as $renkei){
			if ($data[0]==$renkei[0]){$renkeiFlag=1;}
			}
				if ($renkeiFlag==1){//既に連携している場合
				echo "<input name='kanrenTag[]' type='checkbox' value='".$data[0]."'checked='checked'>". $data[1];
				}else{//連携をしていない場合
				echo "<input name='kanrenTag[]' type='checkbox' value='".$data[0]."'>". $data[1];
				}
				echo "<br>";
		}


echo "<H3>連携させる感覚タグを選択してください</H3>";

//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
		foreach($jobKanri2[2] as $data){
				
		$renkeiFlag=0;//連携しているか確認するフラグ
			foreach($jobKanri2[3] as $renkei){
			if ($data[0]==$renkei[0]){$renkeiFlag=1;}
			}
				if ($renkeiFlag==1){//既に連携している場合
				echo "<input name='kanrenTag[]' type='checkbox' value='".$data[0]."'checked='checked'>". $data[1];
				}else{//連携をしていない場合
				echo "<input name='kanrenTag[]' type='checkbox' value='".$data[0]."'>". $data[1];
					}
				echo "<br>";
				}

echo "<H3>関連する学科を選択してください</H3>";

//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
		foreach($jobKanri4 as $data){
				
		$renkeiFlag=0;//連携しているか確認するフラグ
			foreach($jobKanri3 as $renkei){
			if ($data[0]==$renkei[0]){$renkeiFlag=1;}
			}
				if ($renkeiFlag==1){//既に連携している場合
					echo "<input name='RenkeiSchool[]' type='checkbox' value='".$data[0]."'checked='checked'>". $data[2];
				}else{//連携をしていない場合
					echo "<input name='RenkeiSchool[]' type='checkbox' value='".$data[0]."'>". $data[2];
					}
				echo "<br>";
				}

	echo "<input type='hidden' name='jobID' value ='".$jobKanri[0]."'>";
	echo "<input type='hidden' name='jobInfo[]' value ='".$jobKanri['JIMAGE']."'>";

echo "<br /></div><center><input type=submit value=変更><br /><br />";
echo"</form>";


 //データベース切断
dconnect($con);

?>
</center>
	</body>
</html>