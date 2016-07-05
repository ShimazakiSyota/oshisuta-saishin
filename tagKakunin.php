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
		<title>変更タグ詳細確認画面</title>
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
		<h1>変更タグ詳細確認画面</h1>
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
</script>

			<?php

			//選択されたタグを送り、そのタグ情報と関連情報を取得
			$tagKanri = tagCheck( $_POST['selectedTag']);
			
			echo "<center><H2>タグ名：".$tagKanri[1]."</H2>";//タグ名表示
				echo "<form action='./tagDelete.php' method = 'POST'  onsubmit='return disp()'>";
				echo "<button class='del' type='submit' name='tagID' value='".$tagKanri[0]."'>このタグを削除する</button>";
				echo "</form>";


			if ($tagKanri[2] != 2){
				if ($tagKanri[2] == 0){
				echo "<h2>TOPページで表示するアイコン</h2>";
				echo "<img height='100' img src='./create_image.php?id=".$tagKanri[3]."' />";
				
				echo "<h2>連携中分類タグ</h2>";
				}
				else{echo "<h2>連携大分類タグ</h2>";}
					$renkeitag = tagRelationSelect($tagKanri[0]);
					$nullflag = 0;
					echo "<h3>";
					foreach($renkeitag as $data){
						$nullflag = 1;
						$tag = tagCheck($data[0]);
						echo "・".$tag[1]."<br>";
					}
					if ($nullflag == 0){echo "連携しているタグはありません";}
					echo "</h3>";
			}
			if ($tagKanri[2] != 0){
				echo "<h2>連携職業</h2>";
					$renkeijob = jobRelationSelect($tagKanri[0]);
					$nullflag = 0;
					echo "<h3>";
					foreach($renkeijob as $data){
						$nullflag = 1;
						$job = joblist($data[0]);
						echo "・".$job[1]."<br>";
					}
					if ($nullflag == 0){echo "連携している職業はありません";}
					echo "</h3>";
			}
			echo "<form action='./tagKanri.php' method = 'POST'>";
				echo "<input type='hidden' name='selectedTag' value ='".$_POST['selectedTag']."'>";
			echo "<center><input type='submit' value='変更する'/>";
			echo "</form>";
			
			dconnect($con); //データベース切断
			?>
		</center>
	</body>
</html>