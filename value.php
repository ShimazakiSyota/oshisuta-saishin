<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">


<html>
<head>



</head>
<body>

<?php
require_once 'DBmanager.php';//クラスファイル呼び出し


$Jid = $_POST['data1'];
$Tid = $_POST['data2'];
 $con = connect();
good($Jid,$Tid);

dconnect($con);
?>

</body>
</html>
