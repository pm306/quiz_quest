<?php
require_once("config.php");

//ログイン確認できるように
$uid = 0;
if(isset($_SESSION['uid'])){
	$uid = $_SESSION['uid']; 
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
	<link href="./lib/bootstrap/css/bootstrap.min.css" media="all" rel="stylesheet" />
	<script src="./lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="./lib/bootstrap/bootstrap-notify.min.js"></script>
	<script src="./lib/barIndicator-master/barIndicator/jquery-barIndicator.js"></script>


	<script src="https://kit.fontawesome.com/0f8c1ac530.js" crossorigin="anonymous"></script>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

	<script src="./call/common_js.php?20201013"></script>

	

	<?php print($og_data); ?>

	<title>簿記クイズ</title>
</head>
<body>

<script>
$(function(){
	$('#stamina_bar').barIndicator();
});

</script>

<style>
:root{
	--flex_width: 892px;
}

.container-fluid{padding-bottom: calc(env(safe-area-inset-bottom));}
@media (min-width: 892px) {	/* 固定幅を超えた場合の処理 */
  .container-fluid {
    max-width: var(--flex_width);
  }
}


header{
	display: flex; 
	font-size: 12px;
	z-index: 9599;
	bottom: 0;
	width: 100%;
	height: 150px;
}


.levelBox {
	position: fixed;
	top: -25px;
	left:;
	z-index: 9999;
	text-align: center;
	width: 130px;
	height: 130px;
	box-shadow: 3px 7px 22px -2px #9fb4f2;
	background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
	background-color:#7892c2;
	border-radius:65px;
	border:1px solid #4e6096;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:20px;
	padding:28px 20px;
	text-decoration:none;
	text-shadow:0px 2px 0px #283966;
}
@media (min-width: 892px) {
  .levelBox {
	left: calc((50% - var(--flex_width) / 2) );
  }
}


.headerBox {
	position: fixed;
	top: 0px;
	z-index: 9599;
	text-align: center;
	width: calc( 100% - 110px );
	height: 40px;
	box-shadow: 3px 7px 22px -2px #9fb4f2;
	background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
	background-color:#7892c2;
	border-radius:5px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:20px;
	padding:5px 20px;
	text-decoration:none;
	text-shadow:0px 2px 0px #283966;
	left: 110px;
}
@media (min-width: 892px) {
  .headerBox {
	left: calc((50% - var(--flex_width) / 2) + 110px );
	width: calc( var(--flex_width) - 110px );
  }
}
.headerBoxDegree{
	position: absolute;
	top: 0px;
	left: 10%;
	height: 40px;
	width: 30%;
	text-decoration:none;
	font-family:Arial;
	padding:5px 20px;
	text-decoration:none;
	text-shadow:0px 2px 0px #283966;

}
.headerBoxStamina{
	position: absolute;
	display: flex;
	flex-direction: row;
	top: 0px;
	left: 42%;
	z-index: 9699;
	text-align: center;
	width: 60%;
	height: 40px;
	text-decoration:none;
	font-family:Arial;
	padding:5px 20px;
	text-decoration:none;
	text-shadow:0px 2px 0px #283966;
}
.headerBoxStaminaLabel{
	width:70px;
	font-size: 12px;
	line-height:14px;
}
.headerBoxStaminaProgress{
	width:100%;
	padding-top:7px;
}
.headerBoxStaminaValue{
	width:60px;
	font-size: 12px;
	line-height:14px;
}

.headerMiniBox {
	position: fixed;
	display: flex;
	flex-direction: row;
	top: 40px;
	z-index: 9599;
	text-align: center;
	width: calc( 100% - 300px );
	height: 40px;
	box-shadow: 3px 7px 22px -2px #9fb4f2;
	background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
	background-color:#7892c2;
	border-radius:5px;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:20px;
	padding:5px 20px;
	text-decoration:none;
	text-shadow:0px 2px 0px #283966;
	left: 100px;
}
@media (min-width: 892px) {
  .headerMiniBox {
	left: calc((50% - var(--flex_width) / 2) + 110px );
	width: calc( var(--flex_width) - 300px );
  }
}
.headerMiniBoxExpLabel{
	width:70px;
	font-size: 12px;
	padding-top:8px;
}
.headerMiniBoxExpProgress{
	width:100%;
	padding-top:7px;
}

.headerStone {
	position: fixed;
	top: 40px;
	right:40px;
	z-index: 9599;
	text-align: right;
	height: 40px;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:14px;
	padding:5px 20px;
	text-decoration:none;
	text-shadow:0px 2px 0px #283966;
}
@media (min-width: 892px) {
  .headerStone {
	right: calc((50% - var(--flex_width) / 2) + 40px );
  }
}


.headerPresent {
	position: fixed;
	top: 90px;
	right:40px;
	width: 100px;
	z-index: 9599;
	text-align: center;
	height: 40px;
	cursor:pointer;
	font-family:Arial;
	font-size:8px;
	padding:5px 20px;
	text-decoration:none;
	line-height: 14px;
}
@media (min-width: 892px) {
  .headerPresent {
	right: calc((50% - var(--flex_width) / 2) + 40px );
  }
}
.headerPresentIcon {
	font-size:30px;
}

.headerPresentBaloonTop{
	position: fixed;
	top: 67px;
	right:60px;
	width: 100px;
	z-index: 9799;
	text-align: center;
	height: 40px;
	cursor:pointer;
	font-family:Arial;
	font-size:8px;
	padding:5px 20px;
	text-decoration:none;
	line-height: 14px;
}
@media (min-width: 892px) {
  .headerPresentBaloonTop {
	right: calc((50% - var(--flex_width) / 2) + 60px );
  }
}
.headerPresentBaloon {
position: relative;
	display: inline-block;
	margin: 1.5em 15px 1.5em 0;
	padding: 0px;
	width: 15px;
	height: 15px;
	line-height: 14px;
	text-align: center;
	color: #FFF;
	font-size: 10px;
	font-weight: bold;
	background: #ff8e9d;
	border-radius: 50%;
	box-sizing: border-box;
}
.headerPresentBaloon:before {
	content: "";
	position: absolute;
	top: 50%;
	right: -9px;
	margin-top: -4px;
	border: 4px solid transparent;
	border-left: 7px solid #ff8e9d;
	z-index: 0;
}


footer{
	display: flex; 
	justify-content: space-between;
	font-size: 12px;
	background: #efefef;
	z-index: 9999;
	position: fixed;
	bottom: 0;
	border-top: 1px solid #ccc;
	width: 100%;
	height: calc(55px + env(safe-area-inset-bottom));
	line-height: 55px;
	padding-bottom: calc(env(safe-area-inset-bottom));
	padding-top: calc(env(safe-area-inset-bottom) - 35px);
	padding-left: 0px;
}
@media (min-width: 892px) {
  footer {
	width: 800px;
	right: calc(50% - var(--flex_width) / 2 );
  }
}

footer a{ display: inline-block; color: #666; }

footer i{ padding-right: 6px; font-size: 35px; }
footer .green{ color: #7eab55; }
footer .blue{ color: #2aa4ef; }

footer .red{ color: #d3386d; }
footer div{ line-height:13px; text-align: center; }

.firstBtn a{ padding-left: 0px; }
.endBtn a{ padding-right: 10px; }
.more_slower{ --animate-duration: 14s; }

</style>
<header>
	<div class="levelBox">
		<div>Level</div>
		<div id="level_num">11</div>
	</div>
	<div class="headerBox">


		<div class="headerBoxStamina">
			<div class="headerBoxStaminaLabel">スタミナ<br>あと<span id="stamina_time">5:10</span></div>
			<div class="headerBoxStaminaProgress">
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
			<div class="headerBoxStaminaValue"><span id="stamina_value">102<br>/<span id="stamina_max">200</span></div>
		</div>

		<div class="headerBoxDegree">
			見習い戦士
		</div>

	</div>


	<div class="headerMiniBox">
		<div class="headerMiniBoxExpLabel">経験値</div>
		<div class="headerMiniBoxExpProgress">
			<div class="progress">
				<div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>

	<div class="headerStone">
		✨　<span id="stone_num">3,000</span>
	</div>

	<div class="headerPresent">
		<span class="headerPresentIcon">🎁</span><br>プレゼント
	</div>
	<div class="headerPresentBaloonTop">
		<div class="headerPresentBaloon">
			<span id="present_num">11</span>
		</div>
	</div>

</header>

<main class="container-fluid">
<div class="row">
	<div class="col-md-12">
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<img class="animate__animated animate__pulse animate__infinite more_slower" src="./img/jewel-s/image/character/f036.png" >
	</div>
</div>
</main>

<footer>
	<div class="firstBtn">
		<a href="">
		<i class="fas fa-home green"></i><br>ホーム&nbsp;
		</a>
	</div>
	<div>
		<a href="">
			<i class="fas fa-gamepad green"></i><br>クエスト
		</a>
	</div>
	<div>
		<a href="">
			<i class="fas fa-users green"></i><br>ユニット
		</a>
	</div>
	<div>
		<a href="">
			<i class="fas fa-star-of-david green"></i><br>ガチャ&nbsp;
		</a>
	</div>
	<div>
		<a id="menu_btn" href="">
			<i class="fas fa-shopping-cart green"></i><br>ショップ
		</a>
	</div>
	<div>
		<a id="menu_btn" href="">
		<i class="fas fa-info-circle green"></i><br>お知らせ
		</a>
	</div>
	<div class="endBtn">
		<a id="tw_btn"  href="" target="_blank">
			<i class="fa fa-bars green"></i><br>メニュー
		</a>
	</div>
</footer>


</body>


</html>
