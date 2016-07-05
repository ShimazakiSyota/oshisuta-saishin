<html>
	<head>
		<meta http-equiv="REFRESH" content="1;URL=./tagTop.php">
		<title>タグ情報更新</title>
	</head>
	<body>
		<h1>タグ情報更新</h1>

			<?php

			session_start(); //session開始
			$_SESSION['id'] = 1234;
			$_SESSION['pass'] = 4321;
			
			echo $_SESSION['id'].$_SESSION['pass'] ;
			?>
	</body>
</html>
