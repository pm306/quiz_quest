<?php
require_once("config.php");

try {
	$con = getDBConnection();
	
	//ログインしているか確認。していない場合はuidで抽出できないように-1とする
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid']; 
	}
	else{	//ログインしていない場合は、ログイン画面に飛ばす
		$_SESSION['tw_callback_url'] = "/u_menu.php";	//現在のページに戻ってこれるように指定
		header('Location: /login.php');
		exit;
	}

	//ユーザー情報の取得
	$query = "SELECT twid, twsname, twtname, twicon, twiconl, twbanner, description, bkimage, r18_ok  FROM c_user_id WHERE uid=$uid";
	//echo $query;
	$result_user_m = mysqli_query($con,$query);

	if($rdata = mysqli_fetch_array($result_user_m)) {

		$twid = $rdata["twid"];
		$twsname = $rdata["twsname"];
		$twtname = $rdata["twtname"];
		$twicon = $rdata["twicon"];
		$twiconl = $rdata["twiconl"];
		$twbanner = $rdata["twbanner"];
		$description = $rdata["description"];
		$bkimage = $rdata["bkimage"];
		$r18_ok = $rdata["r18_ok"];
		$r18_cheked = "";
		if($r18_ok == 1){
			$r18_cheked = "checked";
		}
		
	}
	else{
		throw new RuntimeException("DB整合性エラー：userマスタ / uid=$uid");
	}
	
}
catch (Exception $e) {
	//普通はここに来ない
	print($e);
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta content="IE=edge" http-equiv="X-UA-Compatible" />
	
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, minimum-scale=1, viewport-fit=cover">
	
	<meta name="description" content="">
	<meta name="author" content="">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="./bootstrap/css/bootstrap.min.css" media="all" rel="stylesheet" />
	<script src="./bootstrap/bootstrap-notify.min.js"></script>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="./call/common_js.js?20200923"></script>

	<title>ユーザー管理</title>
</head>
<body>
<style>

.kijiImg{
	text-align: center;
	line-height: 1;
	display: flex;
	align-items: flex-start;
	justify-content: center;
	margin: 20px auto 0;
	padding: 10px 5px 10px;
	max-width: 100%;
	max-height: 94%;
}


</style>

<main class="container">
<div class="row">
	<div class="col-md-8">
		<h3>新規投稿</h3>
		<br>
		<div>
			<a href="m_upload.php">同人誌情報を新規で投稿する</a>
		</div>
		<br>
		<br>
		<br>
	</div>
</div>


<div class="row">
	<div class="col-md-8">
		<h3>投稿したものの一覧</h3>
		<br>
		<br>
	</div>
</div>

<?php
//記事の一覧出力
try {	
	
	//記事一覧の取得
	$query = "SELECT kid, title, url1, url2, url3, url4, url5, r18, tags  FROM kiji_title WHERE uid=$uid ORDER BY kid DESC";
	//echo $query;
	$result_kiji_title = mysqli_query($con,$query);
	
	while($rdata_title = mysqli_fetch_array($result_kiji_title)) {
		
		$kiji_ar = array();
		$kid = $rdata_title["kid"];
		$title = $rdata_title["title"];
		$url1 = $rdata_title["url1"];
		$url2 = $rdata_title["url2"];
		$url3 = $rdata_title["url3"];
		$url4 = $rdata_title["url4"];
		$url5 = $rdata_title["url5"];
		$r18 = $rdata_title["r18"];
		$r18_text = "NO";
		if($r18 == 1){
			$r18_text = "YES";
		}
		$tags = $rdata_title["tags"];
		
		$title_html = 
			  "<div class='row'>\n"
			. "<div class='col-md-8'>\n"
			. "<h3><a href='/?kid=$kid'>$title</a></h3><br>\n"
			. "</div>\n"
			. "<div class='col-md-2'>\n"
			. "<input type='button' data-kid='$kid' class='kiji_delete_btn btn btn-outline-warning btn-sm' value='削除する' >\n"
			. "</div>\n"
			. "</div>\n";
		
		print($title_html);

		$img_html = "<div class='row'>\n";

		//記事一覧の取得
		$query = "SELECT knum, imgdata FROM kiji_img WHERE kid=$kid";
		//echo $query;
		$result_kiji_img = mysqli_query($con,$query);
		while($rdata_img = mysqli_fetch_array($result_kiji_img)) {
			$knum = $rdata_img["knum"];
			$imgdata = $rdata_img["imgdata"];

			$img_html
				.="<div class='col-md-2'>\n"
				. "<img src='$imgdata' class='kijiImg'>"
				. "</div>\n";
		}
		//URLの表示
		$img_html
		.="<div class='col-md-4'>\n"
		. "タグ: $tags<br>\n"
		. "R18: $r18_text<br>\n"
		. "<a href='$url1'>$url1</a><br>\n"
		. "<a href='$url2'>$url2</a><br>\n"
		. "<a href='$url3'>$url3</a><br>\n"
		. "<a href='$url4'>$url4</a><br>\n"
		. "<a href='$url5'>$url5</a><br><br>\n"
		. "</div>\n";

		$img_html .= "</div><br><br>\n";	//rowの閉じ

		print($img_html);
		
	}
	
}
catch (Exception $e) {
	//普通はここに来ない
	print($e);
	exit;
}

?>

<div class="row">
	<div class="col-md-8">
		<h3>設定</h3>
		<br>
		<br>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<h5>R18の表示</h5>
		<div>
			<p>18歳未満の方はチェックを入れないでください。<br>
			R18を表示する Yesの場合は☑</p>
			<div>
				<input id="check_r18" type="checkbox" <?php print($r18_cheked); ?> />私は18歳以上です。R18の表示に同意します。
			</div>
		</div>
		<br>
		<br>
		<br>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<h3>ログアウト</h3>
		<br>
		<div>
			<a href="logout.php">ログアウト</a>
		</div>
		<br>
		<br>
		<br>
	</div>
</div>


<div class="row">
	<div class="col-md-8">
		<div>
			デザインに手を入れる時間が無かったので、デザインについては少々お待ちください。<br>
		</div>
		<br>
		<br>
		<br>
	</div>
</div>
</main>

</body>
<script>

$('.kiji_delete_btn').on('click', function() {
	var kid = $(this).attr('data-kid');
	var callUrl = "./call/delete_kiji.php";

	senddata = new Object();
	senddata.kid   = kid ;

	$.post(callUrl, { json : JSON.stringify(senddata) }, 
		function(objRes){
			if(objRes.status == "success"){
				$.notify(objRes.msg);
				setTimeout("location.href='/u_menu.php'",3000);
			}
			else{
				$.notify(objRes.msg);
			}
		}, "json")
	;
	return false;	//ジャンプしない
});

//R18の視聴確認
$('#check_r18').on('click', function() {
	$('#check_r18').prop('disabled', true);
	var callUrl = "./call/update_r18.php";

	var r18_ok = 0;
	if($('#check_r18').prop('checked')){
		var r18_ok = 1;
	}
	senddata = new Object();
	senddata.r18_ok   = r18_ok ;

	$.post(callUrl, { json : JSON.stringify(senddata) }, 
		function(objRes){
			if(objRes.status == "success"){
				if(objRes.r18_ok==1){
					$('#check_r18').prop('checked',true);
				}
				else{
					$('#check_r18').prop('checked',false);
				}
				
			}
			else{
				alert(objRes.msg);
			}
			$.notify("R18設定を更新しました");
			$('#check_r18').prop('disabled', false);
		}, "json")
	;
	return false;	//ジャンプしない
});
</script>
</html>
