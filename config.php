<?php
ini_set('display_errors', 1);
//error_reporting(E_ALL);

if(!isset($_SESSION["session_test"])){
	session_start(); 
	$_SESSION["session_test"] = "on";
}

date_default_timezone_set('Asia/Tokyo');

//require_once __DIR__ . '/AmazonPay/facebook.php';

//サーバー設定
//本番機
if($_SERVER["HTTP_HOST"] == "boki.quiz.army"){
	$dbServ   = '';
	$dbUsername ='';
	$dbPassword ='';
	$database ='';
	
	$baseUrl = "https://boki.quiz.army";
}
//開発機
elseif($_SERVER["HTTP_HOST"] == "test.quiz.army"){
	$dbServ   = 'localhost';
	$dbUsername ='root';
	$dbPassword ='uV7akbi2E';
	$database ='quiz';
	
	$baseUrl = "https://test.quiz.army";

}
//ローカル設定
else{
	
}

//twitter API設定
$CONSUMER_KEY = "";
$CONSUMER_SECRET = "";
$BEARER_TOKEN = "";
$ACCESS_TOKEN = "";
$ACCESS_TOKEN_SECRET = "";
//コールバックURL
$TWITTER_CALLBACK = $baseUrl."/login_callback.php";

//////////////////////////////
//共通関数
//////////////////////////////

//----------------------------------------------------------
//DBのコネクションを作成する
//----------------------------------------------------------
function getDBConnection(){
	global $dbServ;
	global $dbUsername;
	global $dbPassword;
	global $database;
	
	$conn = mysqli_connect($dbServ, $dbUsername, $dbPassword, $database);
	//mysql_query("SET NAMES UTF8",$conn);
	mysqli_set_charset($conn,"utf8"); //クエリの文字コードを設定
	mb_language("uni");
	mb_internal_encoding("utf-8"); //内部文字コードを変更
	mb_http_input("auto");
	mb_http_output("utf-8");
	
	return $conn;
}



//----------------------------------------------------------
//ver_dumpをテキストにする
//----------------------------------------------------------
function dumper($obj){
   ob_start();
   var_dump($obj);
   $ret = ob_get_contents();
   ob_end_clean();
   return $ret;
}

//----------------------------------------------------------
//phpのエラー出力をする。ログ目的
//----------------------------------------------------------
function putLog($text){
   trigger_error($text, E_USER_NOTICE);
}

//----------------------------------------------------------
//var_dumpの前後にpreのタグを付ける
//----------------------------------------------------------
function var_dump_pre($obj){
	print("<pre>");
  var_dump($obj);
	print("</pre>");
}




//----------------------------------------------------------
//DBにテキストを入れるさい、htmlエンコードを行う
//----------------------------------------------------------
function setTextToDb($con,$text){
	return mysqli_real_escape_string($con,htmlspecialchars($text));
}


//データがない時用のクラス
class NoDataException extends Exception {}

?>