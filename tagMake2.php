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
		<title>新規タグ連携情報入力画面</title>
			<link href="kanristyle.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
//ポップアップのソース
function disp2(){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
        var flag = confirm ( "この内容で更新してよろしいですか？");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
}
</script>

<?php
			if($sessionkanri == 'error') {
			    // エラーページへ遷移
				//header("Location: ./sessionMisu.php");
			echo '<meta http-equiv="REFRESH" content="0;URL=./sessionMisu.php">';
			}
?>

	</head>
<body>
		<h1>新規タグ連携情報入力画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./tagTop.php'>タグTOPページへ戻る</a><br></h3>
		</div></div>

			<?php

			session_start(); //session開始

			require_once 'DBmanager.php'; //DBマネージャーの読み込み
			$con = connect(); //データベース接続
			

			sessionCheck($_SESSION['id'],$_SESSION['pass']);//セッションの確認

			echo "<center><H2>タグ名：".$_POST['tagName']."</H2>";//タグ名表示
			echo "<H2>タグ区分：";
				if($_POST['tagKubun']==0){echo "大分類タグ";}
		   else if($_POST['tagKubun']==1){echo "中分類タグ";}
				else					 {echo "感覚タグ";}
				echo "</H2></center>";//タグ区分表示


			echo "<div class='left'><form action='./tagInsert.php' method = 'POST' enctype='multipart/form-data' onsubmit='return disp2()'>";
					if($_POST['tagKubun']==0){
					echo "TOPページで表示するアイコンを選択してください：<br><input type='file' name='upfile' size='30' /><br /><br />";
					}
				if ($_POST['tagKubun'] == '1') {//中分類タグなら
					echo "<H3>連携させたい大分類タグを選択してください</H3>";
					$tagAll = tagSelectAllKubun("0");	//指定された区分のタグ全てを取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($tagAll as $data){
					echo "<input name='RenkeiTag[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}
				}
				
				if ($_POST['tagKubun'] == '0') {//大分類タグなら
					echo "<H3>連携させたい中分類タグを選択してください</H3>";
					$tagAll = tagSelectAllKubun("1");	//指定された区分のタグ全てを取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($tagAll as $data){
					echo "<input name='RenkeiTag[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}
				}
				
				if ($_POST['tagKubun'] != '0') {//大分類タグ以外なら
					echo "<H3>連携させたい職業を選択してください</H3>";
					$jobAll = jobAll();	//全ての職業を取得
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($jobAll as $data){
					echo "<input name='RenkeiJob[]' type='checkbox' value='".$data[0]."'>". $data[1]."<br>";
					}
				}

			echo "<input type='hidden' name='tagZyoho[]' value='".$_POST['tagName']."'>";
			echo "<input type='hidden' name='tagZyoho[]' value='".$_POST['tagKubun']."'>";
			
			echo "</div><center><input type='submit' value='タグを追加する'/>";
			echo "</form>";
			
			dconnect($con); //データベース切断

			?>
		</center>
	</body>
</html>
