<HTML>
<HEAD>
<TITLE>メニュー画面</TITLE>
	<meta http-equiv="REFRESH" content="1;URL=./login.html">

</HEAD>
<BODY>
<?php
	session_start(); //session開始
	//$_SESSION = array(); //session破棄
	session_destroy(); //session破棄

?>
ログアウトしました。
</BODY>
</HTML>