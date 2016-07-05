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

<HTML>
<HEAD>

	<div class="head">
		<TITLE>管理TOP画面</TITLE>
		<link href="kanristyle.css" rel="stylesheet" type="text/css">
<?php
			if($sessionkanri == 'error') {
			    // エラーページへ遷移
				//header("Location: ./sessionMisu.php");
			echo '<meta http-equiv="REFRESH" content="0;URL=./sessionMisu.php">';
			}
?>
	</HEAD>
<BODY>
	<h1>管理TOP画面<h1>
</div>




<br><br><br><center>
	<form action="./jobTop.php" method="POST">
<button type='submit'><h1>職業管理ページ</h1></button><br><br></form>

	<form action="./tagTop.php" method="POST">
<button type='submit'><h1>タグ管理ページ</h1></button><br><br></form>

	<form action="./schoolTop.php" method="POST">
<button type='submit'><h1>学校・学科情報管理ページ</h1></button><br><br></form>

	<form action="./logout.php" method="POST">
<button type='submit'><h1>ログアウト</h1></button><br><br></form>

</h1></center>

</BODY>
</HTML>