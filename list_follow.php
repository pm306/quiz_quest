<?php
require_once("config.php");

try {
	$con = getDBConnection();
	
	//ログインしているか確認。していない場合はuidで抽出できないように-1とする
	if(isset($_SESSION['uid'])){
		$uid = $_SESSION['uid']; 
	}
	else{	//ログインしていない場合は、ログイン画面に飛ばす
		$_SESSION['tw_callback_url'] = "/list_follow.php";	//現在のページに戻ってこれるように指定
		header('Location: /login.php');
		exit;
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

	<title>フォローリスト</title>
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

<?php
require_once("header_menu.php");
?>

<br><br>

<main class="container">

<div class="row">
	<div class="col-md-8">
		<h3>フォローしたクリエイターの更新一覧</h3>
		<br>
		<br>
	</div>
</div>

<div class="row">
<?php
//記事の一覧出力
try {	
	
	//フォローしているクリエイター一覧の取得
	$query = "SELECT creator_uid, timestamp FROM c_user_follow WHERE follower_uid=$uid";
	//echo $query;
	$result_follow = mysqli_query($con,$query);
	$kid_arr = [];
	while($rdata_follow = mysqli_fetch_array($result_follow)) {
		$kid_arr[] = $rdata_follow["creator_uid"];
	}
	$kids_str = implode(",",$kid_arr);

	if($kids_str == ""){
		throw new NoDataException();
	}

	$query = "SELECT kid, title, timestamp FROM kiji_title WHERE uid in ($kids_str) ORDER BY timestamp DESC";
	//echo $query;
	$result_kiji_title = mysqli_query($con,$query);

	while($rdata_title = mysqli_fetch_array($result_kiji_title)) {
		
		$kid = $rdata_title["kid"];
		$title = $rdata_title["title"];
		$timestamp = $rdata_title["timestamp"];

		//画像一覧の取得
		$query = "SELECT imgdata FROM kiji_img WHERE kid=$kid AND knum=1";
		//echo $query;
		$result_kiji_img = mysqli_query($con,$query);
		if($rdata_img = mysqli_fetch_array($result_kiji_img)) {
			$imgdata = $rdata_img["imgdata"];
		}
		else{
			throw new RuntimeException("DB整合性エラー：記事画像マスタ / kid=$kid");
		}

		$kiji_html
		= "<div class='col-md-2'>\n"
		. "<img src='$imgdata' class='kijiImg'><br>\n"
		. "<a href='/?kid=$kid'>$title</a><br>\n"
		. "<span class='up_time'>$timestamp</span>\n"
		. "</div>\n";

		print($kiji_html);
		
	}
	
}
catch(NoDataException $e){
	//何もしない
}
catch(Exception $e) {
	//普通はここに来ない
	print($e);
	exit;
}

?>
</div>

</main>

</body>
<script>

</script>
</html>
