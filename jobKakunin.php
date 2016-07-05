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
		<title>変更職業情報確認画面</title>
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
		<h1>変更職業情報確認画面</h1>
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
echo "<form action='./jobChange.php' method='post'><br /><br />";
	echo "職業名". $jobKanri['JOBNAME']."<br /><br />";
	echo "職業名【ふりがな】". $jobKanri['JOBJPN'] ."<br /><br />";
	echo "職業名【英語】". $jobKanri['JOBENG'] ."<br /><br />";
	echo "一行キャッチコピー<br />". $jobKanri['JOBCC'] ."<br /><br />";
	echo "紹介文<br />". $jobKanri['JOBINTRO'] ."<br /><br />";

	//画像がある場合のみ
   		if($jobKanri['JIMAGE'] != 0) {
       		echo "画像1：<img height='100' img src='./create_image.php?id=".$jobKanri['JIMAGE']."' />";
		}
		echo "</center>";
		
		echo "<div class='left'>";
		echo "<H3>連携している中分類タグ</H3>";

					$nullflag = 0;
					echo "<h3>";
					foreach($jobKanri2[1] as $data){
						$nullflag = 1;
						$tag = tagCheck($data[0]);
						echo "・".$tag[1]."<br>";
					}
					if ($nullflag == 0){echo "連携している中分類タグはありません";}
					echo "</h3>";
		echo "<H3>連携している感覚タグ</H3>";

					$nullflag = 0;
					echo "<h3>";
					foreach($jobKanri2[3] as $data){
						$nullflag = 1;
						$tag = tagCheck($data[0]);
						echo "・".$tag[1]."<br>";
					}
					if ($nullflag == 0){echo "連携している感覚タグはありません";}
					echo "</h3>";

		echo "<H3>関連している学科</H3>";

					$nullflag = 0;
					echo "<h3>";
					foreach($jobKanri3 as $data){
						$nullflag = 1;
						$gakka = getDepartment($data[0]);
						echo "・".$gakka['DNAME']."<br>";
					}
					if ($nullflag == 0){echo "連携している学科はありません";}
					echo "</h3>";
	echo "<input type='hidden' name='selectedJob' value ='".$jobKanri[0]."'>";

echo "<br /></div><center><input type=submit value=変更><br /><br />";
echo"</form>";


 //データベース切断
dconnect($con);

?>
</center>
	</body>
</html>