<?php
//データベースに接続 //
$con = mysqli_connect("sddb0040191940.cgidb", "sddbODQ3MzQz","2OcR#n7m","sddb0040191940");

//データベースを選択//
//mysql_select_db("sddb0040191940", $con);

//文字コードをセット//
//mysql_query('SET NAMES utf8', $con);
mysqli_set_charset($con, "utf8");

//画像のtgazouid(ID)を取得
$id = $_GET['id'];

//受け取った画像のIDを元に画像をデータベースから取得
$sql = "SELECT * FROM image WHERE IMAID = '".$id."'";
$result = mysqli_query($con,$sql);
//$result = mysql_query($sql, $con );
$rows = mysqli_num_rows( $result );

//データベース切断
mysqli_close($con);

//取得した画像のバイナリデータとMIMEタイプから画像に変換し表示
if( $rows ){
    while($row = mysqli_fetch_array($result)){
	header("Content-Type:".$row['MIME']);
        echo $row['IMAGE'];
    }
}
?>