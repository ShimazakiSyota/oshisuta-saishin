<html>
	<head>
		<meta http-equiv="REFRESH" content="1;URL=./login.html">
		<title>セッションが切断</title>
	</head>
	<body>
		<h1>セッションが切断、またはログインに失敗しました</h1>
	<?php
	session_start(); //session開始
	$_SESSION = array(); //session破棄
	session_destroy(); //session破棄
	?>
	</body>
</html>
