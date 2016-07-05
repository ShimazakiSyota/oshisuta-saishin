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
		<title>変更学科情報確認画面</title>
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
		<h1>変更学科情報確認画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./schoolTop.php'>学校・学科TOPページへ戻る</a><br></h3>
		</div></div>

<script type="text/javascript">
//ポップアップのソース
function disp(){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
        var flag = confirm ( "本当に削除してもよろしいですか？");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
}
</script>

<?php

$school = getDepartment($_POST['selected']);

//学科名表示
echo "<center>";
	echo "<form action='./departmentDelete.php' method='POST' onsubmit='return disp()'>";
	echo "<button class='del' type='submit' name='departmentID' value='".$school[0]."'>この学科タグを削除する</button></center>";
	echo "</form><br>";

		echo "<form action=departmentChange.php method =POST>";
		echo "<input type='hidden' NAME=selected value='".$_POST['selected']."'>";
		echo "<div class='left'><H2>学科名：".$school[2]."</H2><br /><br />";
		echo "URL : ".$school['3']."<br /><br />";
					$SchoolAll = getSchoolAll();
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。

					foreach($SchoolAll as $data){
if($data[0] == $school[1]){ echo "この学科の属する学校:". $data[1]."<br>"; }
					}
					
					echo "<H4>関連する職業</H4>";
					$jobAll = jobAll();	//全ての職業を取得
					$getDepartmentJobID = getDepartmentJobID($_POST['selected']);
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($jobAll as $data){
						$renkeiFlag=0;//連携しているか確認するフラグ
							foreach($getDepartmentJobID as $renkei){
							if ($data[0]==$renkei[0]){$renkeiFlag=1;}
							}
				if ($renkeiFlag==1){//既に連携している場合
					echo "・". $data[1];
				}
				echo "<br>";
				}
		echo "<br /></div><center><input type =submit value=更新する></center>";
		echo "</form>";

 //データベース切断
dconnect($con);

?>

	</body>
</html>