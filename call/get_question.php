<?php

/**
* クイズ画面のhtml
* 
* 特徴：クエスト画面から以外からの問い合わせは受け付けないようにする
* 
* @param int $_REQUEST["qid"]		クイズID
* @param int $_REQUEST["correct"]	 1:正解、2:間違い。正答率を計算するために使う
* @return string html	クイズ画面のhtml（エラー時はエラーメッセージのみ）
*/
require_once("../config.php");

//var_dump($postdata_array);

try {
	$con = getDBConnection();
	
	//ログインしているか確認。していない場合はuidで抽出できないように-1とする
	$uid = -1;
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid']; 
	}

	
	//現在の画面がquest画面でない場合は終了する
	//if(!(isset($_SESSION['now_view']) )){
	if(!(isset($_SESSION['now_view']) and $_SESSION['now_view']=="quest")){
		throw new RuntimeException("呼び出しエラー");
	}
	

	//記事のIDを確認。パラメータで受け取っていなければ終了
	$qid = 0;
	if(isset($_REQUEST["qid"])){
		$qid = (int)$_REQUEST["qid"];
	}
	else{
		throw new RuntimeException("呼び出しエラー");
	}

	$query = "SELECT qid, question_txt, question_img, a1_txt, a1_img, a2_txt, a2_img, a3_txt, a3_img, a4_txt, a4_img, answer, genre 
			  FROM quiz_data WHERE qid = $qid";
	//echo $query;
	//$return_array["query"] = $query;	//メッセージにログ出力。必ずコメントアウトすること！
	$result_quiz = mysqli_query($con,$query);
	if($rs_quiz = mysqli_fetch_array($result_quiz)) {
?>

<div id="modal_dialog" class="modal-dialog" role="document" data-qid="<?php print($rs_quiz["qid"]); ?>" data-genre="<?php print($rs_quiz["genre"]); ?>">
	<div class="modal-content">
		<div id="answer_top" class="modal-header" data-answer_right="<?php print($rs_quiz["answer"]); ?>">
			<div><?php print($rs_quiz["question_txt"]); ?></div>
			<div class="answer_top_img"><?php print($rs_quiz["question_img"]); ?></div>
		</div>
		<div class="modal-body">
			<div class="answer_time_box">
				<progress id="answer_time" class="answer_time" value="101" max="100" data-progress_on="1"></progress>
				<div id="answer_time_bou"><img src="./img/sozai/answer_check/blue_line.png"></div>
			</div>
			<div class="answer_box" data-answer_number="1">
				<div><?php print($rs_quiz["a1_txt"]); ?></div>
				<div class="answer_box_img"><?php print($rs_quiz["a1_img"]); ?></div>
			</div>
			<div class="answer_box answer_box_gray" data-answer_number="2">
				<div><?php print($rs_quiz["a2_txt"]); ?></div>
				<div class="answer_box_img"><?php print($rs_quiz["a2_img"]); ?></div>
			</div>
			<div class="answer_box" data-answer_number="3">
				<div><?php print($rs_quiz["a3_txt"]); ?></div>
				<div class="answer_box_img"><?php print($rs_quiz["a3_img"]); ?></div>
			</div>
			<div class="answer_box answer_box_gray" data-answer_number="4">
				<div><?php print($rs_quiz["a4_txt"]); ?></div>
				<div class="answer_box_img"><?php print($rs_quiz["a4_img"]); ?></div>
			</div>
		</div>
	</div>
</div>

<?php
	}
	else{
		trigger_error("DBエラーが発生しました $query", E_USER_NOTICE);
		throw new RuntimeException("DB整合性エラー：クイズマスタ / qid=$qid");
	}
	
	mysqli_close($con);

}
catch (Exception $e) {
	print(getMessage());
}


