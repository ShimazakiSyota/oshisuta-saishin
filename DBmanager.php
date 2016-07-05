<?php
// エラー出力しない場合
ini_set('display_errors', 0);

function connect(){//データベースに接続
// エラー出力しない場合
//ini_set('display_errors', 0);

    try {
//データベースに接続 //
$con = mysql_connect("sddb0040191940.cgidb", "sddbODQ3MzQz","2OcR#n7m");


//データベースを選択//
mysql_select_db("sddb0040191940", $con);

//文字コードをセット//
mysql_query('SET NAMES utf8', $con );

return $con;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function dconnect($con){//データベース切断
    try {
	
	$con2 = mysql_close($con);
		if (!$con2) {
			  exit('データベースとの接続を閉じられませんでした。');
		}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function sessionCheck($id,$pass){//セッション確認、ログイン認証

    try {
	//SQL文をセット//
	$con2 = mysql_query('SELECT PASS FROM user where ID = '.$id);
		if (!$con2) {
    	//header( "Location: ./sessionMisu.php" ) ;
		throw new Exception('エラー');
		}
	$row = mysql_fetch_assoc($con2);
		if($row['PASS'] != $pass){
		//	header( "Location: ./sessionMisu.php" ) ;
				throw new Exception('エラー');

		}
		return 'true';
    } catch (Exception $e) {
       //     header( "Location: ./sessionMisu.php" ) ;
	   		return 'error';
    }
}
////////////////////////////////////////////追加
function sessionName($id,$pass){//セッション確認、ログイン認証
;
    try {
	//SQL文をセット//
	$queryset = mysql_query('SELECT NAME FROM user where ID = '.$id.' AND PASS ='.$pass);
		$data = mysql_fetch_array($queryset);
		return $data;
    } catch (Exception $e) {
		echo ('システムエラーが発生しました');	
    }
}

function tagSelectAllKubun($kubun){//指定されたタグ区分に該当するすべてのタグを取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT * FROM tag where TAGDIV ='.$kubun.' ORDER BY tagid DESC');
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function tagCheck($tagId){//指定されたタグ情報を取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT * FROM tag where TAGID ='.$tagId);
		$data = mysql_fetch_array($queryset);
		return $data;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function tagKanri($tagId){//指定されたタグに関連する項目を取得

    try {
	$tagKanri = array();
		$arr = tagCheck($tagId);
		array_push($tagKanri, $arr);
		if ($arr[2] != 2) {
			if ($arr[2] == 1) {
			$arr2 = tagSelectAllKubun('0');
			array_push($tagKanri, $arr2);
			}else{
			$arr2 = tagSelectAllKubun('1');
			array_push($tagKanri, $arr2);
			}
		$arr3 = tagRelationSelect($tagId);
		array_push($tagKanri, $arr3);
		}
		
		if ($arr[2] != 0) {
		$arr4 = jobAll();
		array_push($tagKanri, $arr4);
		$arr5 = jobRelationSelect($tagId);
		array_push($tagKanri, $arr5);
		}
		return $tagKanri;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function jobAll(){//全ての職業情報を取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT * FROM job');
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function tagRelationSelect($tagId){//選択されたのタグに関連するタグIDを取得

    try {$arr = tagCheck($tagId);
	//SQL文をセット//
		$queryset = mysql_query('SELECT HIGHTAG FROM tagmg where LOWTAG ='.$tagId);
		if ($arr[2] == 0) {
			$queryset = mysql_query('SELECT LOWTAG FROM tagmg where HIGHTAG ='.$tagId);
		}
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function jobRelationSelect($tagId){//選択されたのタグに関連する職業IDを取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT JOBID FROM tagjob where TAGID ='.$tagId);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function tagDelete($tagId){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM tag WHERE TAGID ='.$tagId);
		trDelete($tagId);
		tjrDelete($tagId);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function tjrDelete($tagId){//選択されたのタグの、タグ職業関連を削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM tagjob WHERE TAGID ='.$tagId);

			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function trDelete($tagId){//選択されたのタグの、タグ関連を削除

    try {$arr = tagCheck($tagId);
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM tagmg WHERE HIGHTAG ='.$tagId);
		if ($arr[2] == 1) {
		$result_flag = mysql_query('DELETE FROM tagmg WHERE LOWTAG ='.$tagId);
		}
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function joblist($jobId){//選択されたの職業の職業情報を取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT * FROM job where JOBID ='.$jobId);
		$data = mysql_fetch_array($queryset);
		return $data;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function trRelation($tagId,$tagId2){//タグ関連の追加

    try {$arr = tagCheck($tagId);
	//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO tagmg (HIGHTAG, LOWTAG) VALUES ('$tagId','$tagId2')");
		if ($arr[2] == 1) {
		$result_flag = mysql_query("INSERT INTO tagmg (HIGHTAG, LOWTAG) VALUES ('$tagId2','$tagId')");
		}
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function tjrRelation($tagId,$jobID){//タグ職業関連の追加

    try {
	//SQL文をセット//

	$result_flag = mysql_query("INSERT INTO tagjob (JOBID, TAGID) VALUES ('$jobID','$tagId')");
		
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function tagUpdate($tagZyoho){//タグの更新

    try {
	//SQL文をセット//
		$result_flag = mysql_query("UPDATE tag SET TAGNAME = '$tagZyoho[1]' WHERE TAGID = '$tagZyoho[0]'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function tagInsert($tagZyoho){//タグの追加
    try {
	//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO tag (TAGNAME,TAGDIV) VALUES ('$tagZyoho[0]','$tagZyoho[1]')");
		
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
		return maxTag();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function maxTag(){//最終更新したタグのID取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT MAX(TAGID) as value FROM tag');
 		$data = mysql_fetch_assoc($queryset);
		return $data['value'];
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function jDelete($jobID){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM job WHERE JOBID ='.$jobID);
		jtrDelete($jobID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function jtrDelete($jobID){//選択されたのタグの、タグ職業関連を削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM tagjob WHERE JOBID ='.$jobID);

			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function jobTagRelationSelect($jobID){//選択されたの職業の職業情報を取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT TAGID FROM tagjob where JOBID ='.$jobID);
		$arr = array();
			while ($data = mysql_fetch_array($queryset)){
			array_push($arr, tagCheck($data[0]));
			}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function lowtagName($jobID){

    try {
	$data = jobTagRelationSelect($jobID);
	$arr = array();
	foreach($data as $tag){
		if($tag[2]==1){
			array_push($arr, $tag);
		}
	}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function imageName($jobID){

    try {
	$data = jobTagRelationSelect($jobID);
	$arr = array();
	foreach($data as $tag){
		if($tag[2]==2){
			array_push($arr, $tag);
		}
	}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function jobKanri($jobId){//指定されたタグに関連する項目を取得

    try {
	$jobKanri = array();
		$arr1 = tagSelectAllKubun(1);
		array_push($jobKanri, $arr1);
		
		$arr2 = lowtagName($jobId);
		array_push($jobKanri, $arr2);

		$arr3 = tagSelectAllKubun(2);
		array_push($jobKanri, $arr3);
		
		$arr4 = imageName($jobId);
		array_push($jobKanri, $arr4);
		
		return $jobKanri;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function stviewlist($jobid){//学生インタビュー情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM studentiv WHERE JOBID ='.$jobid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}



function jobstadiumlist($jobid){//お仕事スタジアムレポート情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM workrp WHERE JOBID ='.$jobid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


function expertlist($jobid){//専門家情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM expert WHERE JOBID ='.$jobid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function rank(){//{気になるランキング

    try {
		$queryset = mysql_query('SELECT job.JOBID,job.JOBNAME,COUNT(good.JOBID) AS CJOBID FROM job,good WHERE job.JOBID =good.JOBID GROUP BY good.JOBID ORDER BY CJOBID DESC,JOBID');
		$arr = array();
			while ($data = mysql_fetch_array($queryset)){
			array_push($arr, $data);
			}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function kie($fkie){//フリーワード検索

   try {
	$text1 = $fkie;
	$sql ="SELECT JOBID,JOBNAME,JOBCC FROM job";
	//キーワードが入力されているときはwhere以下を組み立てる
	if (strlen($text1)>0){
		//受け取ったキーワードの全角スペースを半角スペースに変換する
		$text2 = str_replace("　", " ", $text1);
		//'を に変える
		$text3 = str_replace("'", " ", $text2);

		//キーワードを空白で分割する

		$array1 = explode(" ",$text3);
		//分割された個々のキーワードをSQLの条件where句に反映する
		$where = " WHERE ";
		for($i = 0; $i < count($array1);$i++){
			$where .= "JOBNAME LIKE '%".$array1[$i]."%'";
			$where .= "OR JOBJPN LIKE '%".$array1[$i]."%'";
			$where .= "OR JOBENG LIKE '%".$array1[$i]."%'";
			$where .= "OR JOBCC LIKE '%".$array1[$i]."%'";
			$where .= "OR JOBINTRO LIKE '%".$array1[$i]."%'";
			if ($i <count($array1) -1){
				$where .= " AND ";
			}
		}
	}
		$sql .= $where;
		$sql .= ";";
	$queryset = mysql_query($sql);
		$arr = array();

			while ($data = mysql_fetch_array($queryset)){

			array_push($arr, $data);
			}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


////////////////////////////////////書き直し

function order($arry){//50音検索

   try {
	$sql ="SELECT JOBID,JOBNAME,JOBCC FROM job WHERE JOBJPN LIKE '".$arry."%'";

	$queryset = mysql_query($sql);
		$arr = array();

			while ($data = mysql_fetch_array($queryset)){

			array_push($arr, $data);
			}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}



/////////////////////////////////////書き直し




function studentnull($jobid){//学生インタビューがあるかないか(ある場合1以上、ない場合" "を返す)
   try {
		$queryset = mysql_query('SELECT JOBID FROM studentiv WHERE JOBID ='.$jobid);
			$arr = array();
			while ($data = mysql_fetch_array($queryset)){
			array_push($arr, $data);
			}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

/////////////////////////////////////書き直し


function expertnull($jobid){//専門家があるかないか(ある場合1以上、ない場合" "を返す)
   try {
		$queryset = mysql_query('SELECT JOBID FROM expert WHERE JOBID ='.$jobid);
			$arr = array();
			while ($data = mysql_fetch_array($queryset)){
			array_push($arr, $data);
			}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}



/////////////////////////////////////書き直し


function workrpnull($jobid){//学生インタビューがあるかないか(ある場合1以上、ない場合" "を返す)
   try {
		$queryset = mysql_query('SELECT JOBID FROM workrp WHERE JOBID ='.$jobid);
			$arr = array();
			while ($data = mysql_fetch_array($queryset)){
			array_push($arr, $data);
			}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
//気になる登録
function goodIn($jobid,$tid){
	try{
		$queryset = mysql_query('INSERT INTO good (JOBID,TINFO) VALUES ('.$jobid.','.$tid.')');
    	} catch (Exception $e) {
          	echo ('システムエラーが発生しました');
    	}

}

//気になる取消
function goodDel($jobid,$tid){
	try{
		$queryset = mysql_query('DELETE FROM good WHERE JOBID='.$jobid.' AND TINFO='.$tid);
    	} catch (Exception $e) {
          	echo ('システムエラーが発生しました');
    	}

}


//気になる検索
function goodSearch($jobid,$tid){
    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT TINFO FROM good WHERE JOBID ='.$jobid.' AND TINFO='.$tid);

		return $queryset;

    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


//端末情報tableから番号の取得
function terminal(){
    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT TID FROM terminal');
		$data= mysql_result($queryset,0);
		return $data;

    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

//端末情報table番号更新
function terminalup($terminal){
    try {
	//SQL文をセット//
		$queryset = mysql_query('UPDATE terminal SET TID='.$terminal);
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

//端末にcookie登録確認
function cookie(){
//cookie情報取得
	if(isset($_COOKIE['test'])){
		//cookie登録されている
	}else{
		//cookie登録されていない
		$queryset=terminal();
		$queryset=$queryset++;
		//cookie登録↓
		$flag = setcookie('test',$queryset,time()+ 2 * 365 * 24 * 3600);
		//端末番号最後尾更新
		terminalup($queryset);
		

	}
}

//気になる画像切り替え時処理
function good($jobid,$tid){
	$quryset=goodSearch($jobid,$tid);
	$data = mysql_fetch_row($quryset);

		if($data>0){
		//気になるがある場合
		goodDel($jobid,$tid);
		}else{
		//気になるがない場合
		goodIn($jobid,$tid);
		}
}

function comentInsert($school,$text,$jid,$upfile){//タグの追加
    try {
		$fileID = picSet($upfile);
		$result_flag;
		if($school==1){
			$result_flag = mysql_query("INSERT INTO studentiv (INTERVIEW,JOBID,SIMAGE) VALUES ('$text','$jid','$fileID')");
		}
		if($school==2){
			$result_flag = mysql_query("INSERT INTO expert (EXPERTCM,JOBID,EIMAGE) VALUES ('$text','$jid','$fileID')");
		}
		if($school==3){
			$result_flag = mysql_query("INSERT INTO workrp (REPORT,JOBID,WIMAGE) VALUES ('$text','$jid','$fileID')");
		}
		if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
		}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
//更新
function comentUpdate($school,$text,$textid){
    try {
	$result_flag;
		if($school==1){
		$result_flag = mysql_query("UPDATE studentiv SET INTERVIEW = '$text' WHERE STUDENTID = '$textid'");
		}
		if($school==2){
		$result_flag = mysql_query("UPDATE expert SET EXPERTCM = '$text' WHERE EXPERTID = '$textid'");
		}
		if($school==3){
		$result_flag = mysql_query("UPDATE workrp SET REPORT = '$text' WHERE WORKID = '$textid'");
		}
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}

    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function getcoment($jobID,$school){//コメント変更用情報取得

    try {
	$arr = array();
	$queryset;
		if($school==1){$queryset = mysql_query('SELECT * FROM studentiv WHERE JOBID ='.$jobID);}
		if($school==2){$queryset = mysql_query('SELECT * FROM expert WHERE JOBID ='.$jobID);}
		if($school==3){$queryset = mysql_query('SELECT * FROM workrp WHERE JOBID ='.$jobID);}
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;

    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function jobInsert($jobInfo,$upfile){//お仕事登録
    try {
	$fileID = picSet($upfile);
	//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO job (JOBNAME,JOBJPN,JOBENG,JOBCC,JOBINTRO,JIMAGE) VALUES ('$jobInfo[0]','$jobInfo[1]','$jobInfo[2]','$jobInfo[3]','$jobInfo[4]','$fileID')");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		return maxJob();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function maxJob(){//最終更新した職業のID取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT MAX(JOBID) as value FROM job');
 		$data = mysql_fetch_assoc($queryset);
		return $data['value'];
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function picSet($upfile){//画像の設定

    try {
    //バイナリデータ
    $fp = fopen($upfile["tmp_name"], "rb");
    $imgdat = fread($fp, filesize($upfile["tmp_name"]));
    fclose($fp);
    $imgdat = addslashes($imgdat);

    //拡張子
    $dat = pathinfo($upfile["name"]);
    $extension = $dat['extension'];

    // MIMEタイプ
    if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
    else if( $extension == "gif" ) $mime = "image/gif";
    else if ( $extension == "png" ) $mime = "image/png";
	
	//
		$result_flag = mysql_query("INSERT INTO `image` (`IMAGE`, `MIME`) VALUES ('$imgdat', '$mime')");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
	return mysql_insert_id();

    }catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function jobUpdate($jobID,$jobInfo){//タグの更新

    try {
	jtrDelete($jobID);
	jobmgDelete($jobID);
	//SQL文をセット//
		$result_flag = mysql_query("UPDATE job SET JOBNAME = '$jobInfo[0]' , JOBJPN = '$jobInfo[1]' , JOBENG = '$jobInfo[2]' , JOBCC = '$jobInfo[3]' , JOBINTRO = '$jobInfo[4]' WHERE JOBID = '$jobID'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function picGet($id){//タグの更新

    try {
	//SQL文をセット//
		$result = mysql_query("SELECT * FROM image WHERE IMAID = ".$id);
    	$data = mysql_fetch_row($result);
		return $data;
	    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function picUpd($upfile,$id){//画像の更新

    try {
    //バイナリデータ
    $fp = fopen($upfile["tmp_name"], "rb");
    $imgdat = fread($fp, filesize($upfile["tmp_name"]));
    fclose($fp);
    $imgdat = addslashes($imgdat);

    //拡張子
    $dat = pathinfo($upfile["name"]);
    $extension = $dat['extension'];

    // MIMEタイプ
    if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
    else if( $extension == "gif" ) $mime = "image/gif";
    else if ( $extension == "png" ) $mime = "image/png";
	
		$result_flag = mysql_query("UPDATE image SET IMAGE='$imgdat' , MIME='$mime' WHERE IMAID = '$id'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    }catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function sbjctImgResult($tagID){//分野とイメージ結果
   try {
			$arr = array();
		$tag = tagCheck($tagID);
		if ($tag[2] == 0){
			 $tag1 = tagRelationSelect($tagID);
			foreach($tag1 as $data){
			$jobid = jobRelationselect($data[0]);
				foreach($jobid as $data1){
				$jobid1 = joblist($data1[0]);
				$flag = 0;
						foreach($arr as $data2){
							if($data2[0]==$jobid1[0]){
							$flag = 1;
							}
						}
					if($flag==0){
					array_push($arr, $jobid1);
					}
				}
			}
		}else{
			$jobid = jobRelationselect($tagID);
			foreach($jobid as $data1){
			$jobid1 = joblist($data1[0]);
			array_push($arr, $jobid1);
			}
		}
		
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
///////////////////////////////////////////書き直し
function asolist($jobID){//学校情報取得

    try {
	$arr = array();
	//SQL文をセット//
		$list = getDepartmentID($jobID);
			foreach($list as $data){
				$list2 = getDepartment($data[0]);
				$list3 = getSchool($list2[0]);
				$array = array($list3[1],$list2[2],$list2[3]);
				array_push($arr, $array);
			}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
////////////////////////////////////////////////
function getDepartmentID($jobid){//学校情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT DEPARTMENTID FROM jobmg WHERE JOBID ='.$jobid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function getDepartmentJobID($id){//学校情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT JOBID FROM jobmg WHERE DEPARTMENTID ='.$id);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function getDepartment($departmentID){//学校情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM department WHERE DEPARTMENTID ='.$departmentID);
		$data = mysql_fetch_array($queryset);
		return $data;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function getSchool($schoolID){//学校情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM school WHERE SCHOOLID ='.$schoolID);
		$data = mysql_fetch_array($queryset);
		return $data;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function getSchoolAll(){//学校情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM school');
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function getDepartmentAll(){//学校情報取得

    try {
	//SQL文をセット//
		$queryset = mysql_query('SELECT * FROM department');
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function jobSchoolRelationInsert($jobID,$departmentID){//タグ職業関連の追加

    try {
	//SQL文をセット//

	$result_flag = mysql_query("INSERT INTO jobmg (JOBID, DEPARTMENTID) VALUES ('$jobID','$departmentID')");
		
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function jobmgDelete($jobID){//選択されたのタグの、タグ職業関連を削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM jobmg WHERE JOBID ='.$jobID);

			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function jobmgDelete2($id){//選択されたのタグの、タグ職業関連を削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM jobmg WHERE DEPARTMENTID ='.$id);

			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
////////////////////////////////////////書き直し
//学校登録
function schoolInsert($schoolInfo){
    try {
	//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO school (SNAME,FLAG) VALUES ('$schoolInfo[0]','$schoolInfo[1]')");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
/////////////////////////////////////////
/////////////////////////////////////////書き直し
function departmentInsert($name,$school,$url){//学科の登録
    try {
	//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO department (SCHOOLID,DNAME,URL) VALUES ('$school','$name','$url')");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
/////////////////////////////////////////
function SchoolRelationUpdate($departmentID,$schoolID){
	try{
		$result_flag = mysql_query("UPDATE department SET SCHOOLID = '$schoolID' WHERE DEPARTMENTID = '$departmentID'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
//////////////////////////////////////////////////////書き直し
//学校の変更
function schoolUpdate($school){
	try{
		$result_flag = mysql_query("UPDATE school SET SNAME = '$school[1]' , FLAG = '$school[2]' WHERE SCHOOLID = '$school[0]'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////書き直し
//学科の変更
function departmentUpdate($school){
	try{
	jobmgDelete2($school[0]);
		$result_flag = mysql_query("UPDATE department SET DNAME = '$school[1]' , URL = '$school[2]',SCHOOLID = '$school[3]' WHERE DEPARTMENTID = '$school[0]'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
//////////////////////////////////////////////////////
function recently($re){//最近気になった仕事

    try {
		$queryset = mysql_query("SELECT job.JOBID,job.JOBNAME FROM job,good WHERE job.JOBID =good.JOBID AND good.TINFO LIKE '%".$re."%'");
		$arr = array();
			while ($data = mysql_fetch_array($queryset)){
			array_push($arr, $data);
			}
	return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function jobmgJobDelete($jobID){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM jobmg WHERE JOBID ='.$jobID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function jobmgdepartmentDelete($departmentID){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM jobmg WHERE DEPARTMENTID ='.$departmentID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function departmentDelete($departmentID){//選択されたのタグの削除

    try {
	jobmgdepartmentDelete($departmentID);
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM department WHERE DEPARTMENTID ='.$departmentID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function schoolDelete($schoolID){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM school WHERE SCHOOLID ='.$schoolID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

////////職業複数コメントテーブル取得///////////////////////
function cstviewlist($stid){//学生インタビュー情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM studentview WHERE STUDENTID ='.$stid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}




function cjobstadiumlist($workid){//お仕事スタジアムレポート情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM workrpdate WHERE WORKID ='.$workid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


function cexpertlist($exid){//専門家情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM expartview WHERE EXPERTID ='.$exid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
//////////////////j仕事テーブルの画像IDの変更
function jobFileIDUpdate ($jobID,$fileID){
    try {
		$result_flag = mysql_query("UPDATE job SET JIMAGE = '$fileID' WHERE JOBID = '$jobID'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
		}catch (Exception $e) {
   	    echo ('システムエラーが発生しました');
    }
}
//////////////////j仕事テーブルの画像IDの変更
function tagFileIDUpdate ($tagID,$fileID){
    try {
		$result_flag = mysql_query("UPDATE tag SET TIMAGE = '$fileID' WHERE TAGID = '$tagID'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
		}catch (Exception $e) {
   	    echo ('システムエラーが発生しました');
    }
}

////////////////////////////////////////書き直し
function interviewInsert($interview,$upfile,$time,$KanriName){//学生インタビュー登録
    try {
		if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {

			$fileID = picSet($upfile);
	//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO studentiv (JOBID,IHEAD,IATTIME,STNAME,IDATE,INAME,SIMAGE,IUPTIME,IUPNAME) VALUES ('$interview[0]','$interview[1]','$interview[2]','$interview[3]','$interview[4]','$interview[5]','$fileID','$time','$KanriName')");
		} else {
		$result_flag = mysql_query("INSERT INTO studentiv (JOBID,IHEAD,IATTIME,STNAME,IDATE,INAME,SIMAGE,IUPTIME,IUPNAME) VALUES ('$interview[0]','$interview[1]','$interview[2]','$interview[3]','$interview[4]','$interview[5]','0','$time','$KanriName')");
		}
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function expertInsert($expert,$upfile2,$time,$KanriName){//専門家登録
    try {
		if (is_uploaded_file($_FILES["upfile2"]["tmp_name"])) {

			$fileID = picSet($upfile2);
	//SQL文をセット//
			$result_flag = mysql_query("INSERT INTO expert (JOBID,EHEAD,EXNAME,EDATE,ENAME,EIMAGE,EUPTIME,EUPNAME) VALUES ('$expert[0]','$expert[1]','$expert[2]','$expert[3]','$expert[4]','$fileID','$time','$KanriName')");
		} else {
			$result_flag = mysql_query("INSERT INTO expert (JOBID,EHEAD,EXNAME,EDATE,ENAME,EIMAGE,EUPTIME,EUPNAME) VALUES ('$expert[0]','$expert[1]','$expert[2]','$expert[3]','$expert[4]','0','$time','$KanriName')");
		}
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function reportInsert($report,$upfile4,$time,$KanriName){//レポート登録
    try {

		if (is_uploaded_file($_FILES["upfile4"]["tmp_name"])) {
			$fileID = picSet($upfile4);
			//SQL文をセット//
			$result_flag = mysql_query("INSERT INTO workrp (JOBID,WHEAD,WDATE,WNAME,WIMAGE,WUPTIME,WUPNAME) VALUES ('$report[0]','$report[1]','$report[2]','$report[3]','$fileID','$time','$KanriName')");
		}else{
			$result_flag = mysql_query("INSERT INTO workrp (JOBID,WHEAD,WDATE,WNAME,WIMAGE,WUPTIME,WUPNAME) VALUES ('$report[0]','$report[1]','$report[2]','$report[3]','0','$time','$KanriName')");
		}

			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


///////////////////////////////////////////書き直し
function studentviewInsert($interview2,$interview3,$upfile1,$interview){//学生インタビューの登録　コメント
    try {
	for ($i=0;(isset($interview2[$i]) && $interview2[$i] != ""); $i++){
		if (is_uploaded_file($_FILES["upfile1"]["tmp_name"][$i])) {
		$fileID = picSet2($upfile1,$i);
		//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO studentview (ICHEAD,INTERVIEW,SVIMAGE,STUDENTID) VALUES ('$interview2[$i]','$interview3[$i]','$fileID','$interview')");
		}else{
		$result_flag = mysql_query("INSERT INTO studentview (ICHEAD,INTERVIEW,SVIMAGE,STUDENTID) VALUES ('$interview2[$i]','$interview3[$i]','0','$interview')");
		}
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function expartviewInsert($expert2,$expert3,$upfile3,$expert){//専門家の登録　コメント
    try {
	for ($i=0;(isset($expert2[$i]) && $expert2[$i] != ""); $i++){
		if (is_uploaded_file($_FILES["upfile3"]["tmp_name"][$i])) {
			$fileID = picSet2($upfile3,$i);
			//SQL文をセット//
			$result_flag = mysql_query("INSERT INTO expartview (ECHEAD,EXPERTCOM,EVIMAGE,EXPERTID) VALUES ('$expert2[$i]','$expert3[$i]','$fileID','$expert')");
			}else{
			$result_flag = mysql_query("INSERT INTO expartview (ECHEAD,EXPERTCOM,EVIMAGE,EXPERTID) VALUES ('$expert2[$i]','$expert3[$i]','0','$expert')");
		}
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function workrpdateInsert($report2,$report3,$upfile5,$work){//お仕事スタジアムレポート登録　コメント
    try {
	for ($i=0;(isset($report2[$i]) && $report2[$i] != ""); $i++){
		if (is_uploaded_file($_FILES["upfile5"]["tmp_name"][$i])) {
			$fileID = picSet2($upfile5,$i);
			//SQL文をセット//
			$result_flag = mysql_query("INSERT INTO workrpdate (WCHEAD,REPORT,WIMAGE,WORKID) VALUES ('$report2[$i]','$report3[$i]','$fileID','$work')");
			}else{
			$result_flag = mysql_query("INSERT INTO workrpdate (WCHEAD,REPORT,WIMAGE,WORKID) VALUES ('$report2[$i]','$report3[$i]','0','$work')");
		}
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function picSet2($upfile,$i){//画像の設定

    try {
    //バイナリデータ
    $fp = fopen($upfile["tmp_name"][$i], "rb");
    $imgdat = fread($fp, filesize($upfile["tmp_name"][$i]));
    fclose($fp);
    $imgdat = addslashes($imgdat);

    //拡張子
    $dat = pathinfo($upfile["name"][$i]);
    $extension = $dat['extension'];

    // MIMEタイプ
    if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
    else if( $extension == "gif" ) $mime = "image/gif";
    else if ( $extension == "png" ) $mime = "image/png";
	
	//
		$result_flag = mysql_query("INSERT INTO `image` (`IMAGE`, `MIME`) VALUES ('$imgdat', '$mime')");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
	return mysql_insert_id();

    }catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


////////////////////追加
function interviewUpdate($interview,$time,$KanriName,$studentID){//学生インタビューの更新

    try {
	//SQL文をセット//
		$result_flag = mysql_query("UPDATE studentiv SET IHEAD = '$interview[0]',STNAME = '$interview[1]', IDATE = '$interview[2]', INAME = '$interview[3]',IATTIME = '$interview[4]',IUPTIME = '$time',IUPNAME = '$KanriName'  WHERE STUDENTID = '$studentID'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

////////////////////追加
function expertUpdate($expert,$time,$KanriName,$expertID){//専門家のコメントの更新

    try {
	//SQL文をセット//
		$result_flag = mysql_query("UPDATE expert SET EHEAD = '$expert[0]' , EXNAME = '$expert[1]' , EDATE = '$expert[2]' , ENAME = '$expert[3]',EUPTIME = '$time',EUPNAME = '$KanriName' WHERE EXPERTID = '$expertID'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

////////////////////追加
function reportUpdate($report,$time,$KanriName,$workID){//お仕事レポートの更新

    try {
	//SQL文をセット//
		$result_flag = mysql_query("UPDATE workrp SET WHEAD = '$report[0]' , WDATE = '$report[1]' , WNAME = '$report[2]',WUPTIME = '$time',WUPNAME = '$KanriName' WHERE WORKID = '$workID'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


////////////////////追加
function stviewlist2($studentid){//学生インタビュー情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM studentiv WHERE STUDENTID ='.$studentid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


////////////////////追加
function jobstadiumlist2($workid){//お仕事スタジアムレポート情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM workrp WHERE WORKID ='.$workid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

////////////////////追加
function expertlist2($expertid){//専門家情報取得

    try {
	//SQL文をセット//00
		$queryset = mysql_query('SELECT * FROM expert WHERE EXPERTID ='.$expertid);
		$arr = array();
		while ($data = mysql_fetch_array($queryset)){
		array_push($arr, $data);
		}
		return $arr;
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


///////////////////////////////////////////書き直し
function studentviewUpdate($interview2,$interview3,$commentID){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("UPDATE studentview SET ICHEAD = '$interview2',INTERVIEW = '$interview3' WHERE SCOMMENT = '$commentID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

////////////追加
function studentviewInsert2($interview2,$interview3,$interview){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO studentview (ICHEAD,INTERVIEW,SVIMAGE,STUDENTID) VALUES ('$interview2','$interview3','0','$interview')");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
		return mysql_insert_id();
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function picUpd2($upfile,$i,$id){//画像の更新

    try {
    //バイナリデータ
    $fp = fopen($upfile["tmp_name"][$i], "rb");
    $imgdat = fread($fp, filesize($upfile["tmp_name"][$i]));
    fclose($fp);
    $imgdat = addslashes($imgdat);

    //拡張子
    $dat = pathinfo($upfile["name"][$i]);
    $extension = $dat['extension'];

    // MIMEタイプ
    if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
    else if( $extension == "gif" ) $mime = "image/gif";
    else if ( $extension == "png" ) $mime = "image/png";
	
		$result_flag = mysql_query("UPDATE image SET IMAGE='$imgdat' , MIME='$mime' WHERE IMAID = '$id'");
			if (!$result_flag) {
	    	die('UPDATEクエリーが失敗しました。'.mysql_error());
			}
    }catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function picInsert($fileID){
    try {
	//SQL文をセット//
		$result_flag = mysql_query("UPDATE studentview SET SVIMAGE = '$fileID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function studentviewDelete($ID){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM studentview WHERE SCOMMENT ='.$ID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}
function picDelete($ID){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM image WHERE IMAID ='.$ID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function commentPicIDUpd($commentID,$picID){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("UPDATE studentview SET SVIMAGE = '$picID' WHERE SCOMMENT = '$commentID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


function expartviewDelete($ID){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM expartview WHERE ECOMMENT ='.$ID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function workrpdateDelete($ID){//選択されたのタグの削除

    try {
	//SQL文をセット//
		$result_flag = mysql_query('DELETE FROM workrpdate WHERE WCOMMENTID ='.$ID);
			if (!$result_flag) {
	    	die('DELETEクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function expartviewUpdate($expert2,$expert3,$commentID){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("UPDATE expartview SET ECHEAD = '$expert2',EXPERTCOM = '$expert3' WHERE ECOMMENT = '$commentID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

////////////追加
function expertviewInsert2($expert2,$expert3,$expert){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO expartview (ECHEAD,EXPERTCOM,EVIMAGE,EXPERTID) VALUES ('$expert2','$expert3','0','$expert')");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function picInsert2($fileID){
    try {
	//SQL文をセット//
		$result_flag = mysql_query("UPDATE expartview SET EVIMAGE = '$fileID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function picInsert3($fileID){
    try {
	//SQL文をセット//
		$result_flag = mysql_query("UPDATE workrpdate SET WIMAGE = '$fileID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function commentPicIDUpd2($commentID,$picID){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("UPDATE expartview SET EVIMAGE = '$picID' WHERE ECOMMENT = '$commentID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

function commentPicIDUpd3($commentID,$picID){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("UPDATE workrpdate SET WIMAGE = '$picID' WHERE WCOMMENTID = '$commentID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

///////////////////////////////////////////書き直し
function workrpdateUpdate($report2,$report3,$commentID){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("UPDATE workrpdate SET WCHEAD = '$report2',REPORT = '$report3' WHERE WCOMMENTID = '$commentID'");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}

////////////追加
function workrpdateInsert2($report2,$report3,$report){//学生インタビューの登録　コメント
    try {
		//SQL文をセット//
		$result_flag = mysql_query("INSERT INTO workrpdate (WCHEAD,REPORT,WIMAGE,WORKID) VALUES ('$report2','$report3','0','$report')");
			if (!$result_flag) {
	    	die('INSERTクエリーが失敗しました。'.mysql_error());
			}
    } catch (Exception $e) {
            echo ('システムエラーが発生しました');
    }
}


?>   