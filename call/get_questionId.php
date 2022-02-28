<?php
/* ボタン設置時にあらかじめ「id」「ジャンル名」「正答率（未実装）」だけを取得しておき、クリックイベント発火時に実際のデータをロードしてくる */

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

//var_dump($_REQUEST);

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
    //$qid_1 = $qid_2 = $qid_3 = $qid_4 = 0;
    $qids = "( ";
    for($i = 1; $i <= 4; $i++){
        if(isset($_REQUEST["qid_".$i])){
            $qids .= $_REQUEST["qid_".$i];
            if($i < 4)$qids .= ", ";
        }
        else{
            throw new RuntimeException("呼び出しエラー");
        }
    }
    $qids .= " )";

	$query = "SELECT qid, genre FROM quiz_data WHERE qid IN $qids ";
	//echo $query;
	//$return_array["query"] = $query;	//メッセージにログ出力。必ずコメントアウトすること！
    $result_quiz = mysqli_query($con,$query);
    $index = 1;
	while($rs_quiz = mysqli_fetch_array($result_quiz)) {
?>
    <div id="quiz_<?php print($index); ?>" data-qid="<?php print($rs_quiz["qid"]); ?>" data-genre="<?php print($rs_quiz["genre"]);?>">
    </div>
    <?php $index++; ?>
<?php
    }	
	mysqli_close($con);

}
catch (Exception $e) {
	print(getMessage());
}


