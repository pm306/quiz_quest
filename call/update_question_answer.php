<?php

/**
* 正答率計算のために、１回目の回答で正解か不正解かを受け取ってquiz_dataテーブルを更新する
* 
* 特徴：クエスト画面から以外からの問い合わせは受け付けないようにする
* 
* @param int $_REQUEST["qid"]		クイズID
* @param int $_REQUEST["correct"]	 1:正解、2:間違い。正答率を計算するために使う
* @return string status		正常 or異常
* @return string msg		メッセージ、異常時のメッセージ用
*/
require_once("../config.php");


try {
	$con = getDBConnection();
	
	//ログインしているか確認。していない場合はuidで抽出できないように-1とする
	$uid = -1;
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid']; 
	}

	//現在の画面がquest画面でない場合は終了する
	if(!(isset($_SESSION['now_view']) and $_SESSION['now_view']=="quest")){
		throw new RuntimeException("呼び出しエラー");
	}

	//記事のIDを確認。パラメータで受け取っていなければ終了
	$qid = 0;
	$correct_answer = 0;
	$incorrect_answer = 0;
	if(isset($_REQUEST["qid"]) and isset($_REQUEST["correct"])){
		$qid = (int)$_REQUEST["qid"];
		$correct = (int)$_REQUEST["correct"];
		if($correct > 0){
			$correct_answer = 1;
		}
		else{
			$incorrect_answer = 1;
		}
	}
	else{
		throw new RuntimeException("呼び出しエラー");
	}
    
	//更新
	$query = "UPDATE quiz_data SET correct_answer=correct_answer+$correct_answer,  incorrect_answer=incorrect_answer+$incorrect_answer WHERE qid=$qid";
	//echo $query;
    
	if(!mysqli_query($con,$query)){
		trigger_error("DBエラーが発生しました $query", E_USER_NOTICE);
		throw new RuntimeException('DBエラーが発生しました');
  	}
    	
	mysqli_close($con);
  
	$return_array["msg"] = "更新しました";
	$return_array["status"] = "success";
    
}
catch (Exception $e) {
	$return_array["msg"] = $e->getMessage();
	$return_array["status"] = "danger";
}

print(json_encode($return_array));

?>