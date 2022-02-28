<?php
require_once "config.php";
require_once "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//login.phpでセットしたセッション
$request_token = [];  // [] は array() の短縮記法。詳しくは以下の「追々記」参照
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

//Twitterから返されたOAuthトークンと、あらかじめlogin.phpで入れておいたセッション上のものと一致するかをチェック
if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    die( 'Error!' );
}

//OAuth トークンも用いて TwitterOAuth をインスタンス化
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

//セッションにアクセストークンを保存
$_SESSION['access_token'] = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
//var_dump($connection);


//アクセストークンから新たにコネクション作成
//どうやら、前のコネクションは再利用できずに、新たに獲得したアクセストークンを使う必要があるようだ
$access_token = $_SESSION['access_token'];
//OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
//ここから、ユーザー情報を取得
$content = $connection->get("account/verify_credentials");

//GETしたユーザー情報をvar_dump
//var_dump_pre( $content );

if(isset($content->errors->message)){
	//プロフィールデータが取得できない（アクセストークンが古い・使用できない）
	//ログアウトする
	header('Location: /logout.php');
	exit;
}

//var_dump($content);
	

//トランザクション開始
$con = getDBConnection(); 
$twid = mysqli_real_escape_string($con,$access_token["user_id"]);

$query = "SELECT * FROM c_user_id WHERE twid='$twid'";
$result = mysqli_query($con,$query);

if(mysqli_num_rows($result) <= 0) { //取得した結果のデータの数が0以下なら新規登録
	$query = "INSERT INTO c_user_id(twid)"
		. " VALUES('$twid')";
	mysqli_query($con,$query);
	$nid = mysqli_insert_id($con);
	
    $query = "SELECT * FROM c_user_id WHERE twid='$twid'";
    $result = mysqli_query($con,$query);
}

if(mysqli_num_rows($result) <= 0){   //ユーザ情報が取得できない場合はエラー
    echo "DB接続で致命的なエラー場発生しました。：エラーコード　callback_db_error";
}

//データが正常に取得できた
$data = mysqli_fetch_array($result);
$uid = $data['uid'];

//echo "<pre>"; var_dump($content); echo "</pre>";

//ツイッターにログインしている
$twsname     = mysqli_real_escape_string($con,$access_token["screen_name"]);
$twtoken     = mysqli_real_escape_string($con,$access_token["oauth_token"]);
$twtname     = setTextToDb($con,$content->name);
$twicon      = mysqli_real_escape_string($con,getIConOriSizeUrl($content->profile_image_url_https));
$twiconl     = mysqli_real_escape_string($con,getIConLargeSizeUrl($content->profile_image_url_https));
$twbanner    = mysqli_real_escape_string($con,$content->profile_banner_url . "/web");
$description = setTextToDb($con,$content->description);
$location    = setTextToDb($con,$content->location);
$hpurl       = mysqli_real_escape_string($con,$content->entities->url->urls[0]->expanded_url);
$followers   = mysqli_real_escape_string($con,$content->followers_count);
$friends     = mysqli_real_escape_string($con,$content->friends_count);
$tweetnum    = mysqli_real_escape_string($con,$content->statuses_count);
$bkimage     = mysqli_real_escape_string($con,$content->profile_background_image_url);
$created_at  = date("Y-m-d H:i:s",strtotime($content->created_at));


$query = "UPDATE c_user_id SET"
			." twsname='$twsname',"
			." twtname='$twtname',"
			." twtoken='$twtoken',"
			." twicon='$twicon',"
			." twiconl='$twiconl',"
			." twbanner='$twbanner',"
			." description='$description',"
			." location='$location',"
			." hpurl='$hpurl',"
			." followers=$followers,"
			." friends=$friends,"
			." tweetnum=$tweetnum,"
			." bkimage='$bkimage',"
			." created_at='$created_at'"
			."\n"
			." WHERE uid='$uid'";
//echo $query;
$result = mysqli_query($con,$query);

mysqli_query($con,"COMMIT");
mysqli_close($con);
	
//idはセッションで管理していく
$_SESSION["uid"] = $uid;
$_SESSION["twid"] = $twid;

//echo $_SESSION['tw_callback_url'];

//戻るページがセッション変数に格納されていた場合
if(isset($_SESSION['tw_callback_url'])){
	
	//echo ($_SESSION['tw_callback_url']);
	header('Location: ' . $_SESSION['tw_callback_url']);
	//jumpPage($_SESSION['tw_callback_url']);
	unset($_SESSION['tw_callback_url']);
	exit;
}

//特に戻るページの記載が無い場合 テストの時にはコメントアウトしよう
header('Location: /');
//jumpPage("/");
unset($_SESSION['tw_callback_url']);
exit;


function jumpPage($jumpurl){
	$html = "<html>\n"
				.	"<head>\n"
				.	"<meta http-equiv='refresh' content='0;URL=$jumpurl'>\n"
				. "</head>\n"
				. "<body>\n"
				. "ログインしました\n"
				. "</body>\n"
				. "<body>\n"
				. "</html>";
	print($html);
}


?>