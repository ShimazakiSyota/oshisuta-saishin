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
		<title>タグ変更情報入力画面</title>
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
		<h1>タグ変更情報入力画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./tagTop.php'>タグTOPページへ戻る</a><br></h3>
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

			//選択されたタグを送り、そのタグ情報と関連情報を取得
			$tagKanri = tagKanri( $_POST['selectedTag']);
			
			echo "<center><H2>タグ名：".$tagKanri[0][1]."</H2>";//タグ名表示
				echo "<form action='./tagDelete.php' method = 'POST'  onsubmit='return disp()'>";
				echo "<button class='del' type='submit' name='tagID' value='".$tagKanri[0][0]."'>このタグを削除する</button>";
				echo "</form>";

			echo "<form action='./tagUpdate.php' method = 'POST'  enctype='multipart/form-data' onsubmit='return disp2()'>";
			echo "<input type='hidden' name='tagZyoho[]' value ='".$tagKanri[0][0]."'>";

			echo "タグ名：<input type='text' name='tagZyoho[]' size='20' value='".$tagKanri[0][1]."'><br>";
			if ($tagKanri[0][2] == 0) {
				if($tagKanri[0][3] != 0) {
				echo "<h2>TOPページで表示するアイコン</h2>";
				echo "<img height='100' img src='./create_image.php?id=".$tagKanri[0][3]."' />";
				}
					echo "<H4>変更する場合は画像を選択してください</H4>";
					echo "写真1：<input type='file' name='upfile' size='30' /><br /><br />";
			}

			echo "</center><div class='left'>";
			if ($tagKanri[0][2] == 1) {echo "<H3>連携させる大分類";}//タグの種類が中分類タグなら
	else	if ($tagKanri[0][2] == 0) {echo "<H3>連携させる中分類";}//タグの種類が大分類タグなら
			if ($tagKanri[0][2] != 2) {echo "タグを選択してください</H3>";//タグの種類が感覚タグ以外なら
			
				//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
				foreach($tagKanri[1] as $data){
				
				$renkeiFlag=0;//連携しているか確認するフラグ
					foreach($tagKanri[2] as $renkei){
					if ($data[0]==$renkei[0]){$renkeiFlag=1;}
					}
						if ($renkeiFlag==1){//既に連携している場合
						echo "<input name='kanrenTag[]' type='checkbox' value='".$data[0]."'checked='checked'>". $data[1];
						}else{//連携をしていない場合
						echo "<input name='kanrenTag[]' type='checkbox' value='".$data[0]."'>". $data[1];
						}
				echo "<br>";
				}
			}
			
			if ($tagKanri[0][2] != 0) {echo "<H3>連携させる職業を選択してください</H3>";//タグの種類が大分類タグ以外なら
				if ($tagKanri[0][2] == 1) {//タグの種類が中分類タグなら
				$allJob = $tagKanri[3];
				$allJobFlag = $tagKanri[4];
				}
				if ($tagKanri[0][2] == 2) {//タグの種類が感覚タグなら
				$allJob = $tagKanri[1];
				$allJobFlag = $tagKanri[2];
				}
				//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
				foreach($allJob as $data){
				
				$renkeiFlag=0;//連携しているか確認するフラグ
					foreach($allJobFlag as $renkei){
					if ($data[0]==$renkei[0]){$renkeiFlag=1;}
					}
						if ($renkeiFlag==1){//既に連携している場合
						echo "<input name='kanrenJob[]' type='checkbox' value='".$data[0]."'checked='checked'>". $data[1];
						}else{//連携をしていない場合
						echo "<input name='kanrenJob[]' type='checkbox' value='".$data[0]."'>". $data[1];
						}
				echo "<br>";
				}
			}
			echo "<input type='hidden' name='tagZyoho[]' value ='".$tagKanri[0][2]."'>";
			echo "</div><center><input type='submit' value='変更'/></form>";
			
			dconnect($con); //データベース切断
			?>
		</center>
	</body>
</html>
