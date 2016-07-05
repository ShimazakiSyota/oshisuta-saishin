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
		<title>変更学校情報確認画面</title>
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
		<h1>変更学校情報確認画面</h1>
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

$school = getSchool($_POST['selected']);

//学校名表示
echo "<center>";
	echo "<form action='./schoolDelete.php' method='POST' onsubmit='return disp()'>";
	echo "<button class='del' type='submit' name='schoolID' value='".$school[0]."'>この学校タグを削除する</button></center>";
	echo "</form>";

		echo "<form action=schoolChange.php method =POST>";
		echo "<input type='hidden' NAME='selected' value='".$_POST['selected']."'>";
		echo "<div class='left'><H2>学校名：".$school['1']."</H2>";

				$selectedTagFrag = '0'; //最初のラジオボタン用のフラグ
		for($i=0;$i<2;$i++){
			if(0 == $school[2]){
				if($selectedTagFrag == 0){ 
				echo "麻生グループ<br />";
				$selectedTagFrag ='1';
				}else{
				break;
				}
			}else if(1 == $school[2]){
				if($selectedTagFrag == 0){ 
				$selectedTagFrag ='1';
				}else{
				echo "その他（麻生グループ以外）<br/>";
				break;
				}
			}
		}
		echo"</div>";



					echo "<div class='left'><H4>関連する学科</H4>";
					$SchoolAll = getDepartmentAll();
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($SchoolAll as $data){
						if($data[1]==$_POST['selected']){
						echo "・". $data[2]."<br>";
						}
					}
		echo "<br /></div><center><input type =submit value=更新する>";
		echo "</form>";

 //データベース切断
dconnect($con);

?>
		</center>
	</body>
</html>