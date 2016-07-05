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
		<title>新規学校情報入力画面</title>
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
		<h1>新規学校情報入力画面</h1>
	<div align="right">
		<h3><a href='./kanri.php'>管理TOPページへ戻る</a><br></h3>
		<h3><a href='./schoolTop.php'>学校・学科TOPページへ戻る</a><br></h3>
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

		echo "<form action=schoolInsert.php method =POST onsubmit='return disp()'>";
		echo "<div class='left'>学校名 : <INPUT TYPE=TEXT NAME=schoolInfo[] style='font-family:Tahoma; ime-mode:disabled;' pattern='^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。\n\r]+$' title='日本語で入力してください' required><br /><br />";
				echo "<input type='radio' name='schoolInfo[]' value='0' checked='checked'>麻生<br />";
				echo "<input type='radio' name='schoolInfo[]' value='1'>その他<br/>";
//		echo "URL: <INPUT TYPE=TEXT NAME=schoolInfo[] style='font-family:Tahoma; ime-mode:disabled;' pattern='/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/',schoolInfo[] title='URLを入力してください' required><br /><br />";
		
					echo "<H4>関連する学科を選択してください</H4>";
					$SchoolAll = getDepartmentAll();
					//１ループでタグ1つがチェックボックス形式で表示され、データが無くなるとループを抜けます。
					foreach($SchoolAll as $data){
					echo "<input name='Renkei[]' type='checkbox' value='".$data[0]."'>". $data[2]."<br>";
					}
		echo "<br /></div><center><input type =submit value=追加></center>";
		echo "</form>";
 //データベース切断
dconnect($con);
?>
	
	</body>
</html>