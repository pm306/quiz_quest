<?php
require_once "config.php";

require_once "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//コールバックURLがある場合の処理
if(isset($_GET["tw_callback_url"])){
	$_SESSION['tw_callback_url'] = $_GET["tw_callback_url"];
}

$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
//var_dump_pre($connection);
$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $TWITTER_CALLBACK));

//リクエストトークンはコールバックページでも利用するためセッションに格納しておく
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

//Twitterの認証画面のURL
$oauthUrl = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	  <title>twitterでログイン</title>
	<meta name="robots" content="noindex, nofollow">
	</head>
	<body>
        	<section class="box1 entry">
            	<h1 class="boxh1_2">ログイン</h1>

                <p class="bluebox">Twitterの認証システムを利用することにより、<span class="bold">安全</span>かつ簡単にログインできます。<br>
下のボタンから認証を行ってください。</p>
				<p class="alc"><a href="<?php print($oauthUrl); ?>" class="loginbtn lbt"><i class="fab fa-twitter"></i>Twitterでログイン</a></p>
                
                <p class="grnbox"><strong>勝手にツイートや投稿、RT,フォロー等がされることはありません。</strong>
                安心してご利用ください。</p>
                
                
            </section>
  </body>
</html>