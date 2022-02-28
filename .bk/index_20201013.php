<?php
require_once("config.php");

//ログイン確認できるように
$uid = 0;
if(isset($_SESSION['uid'])){
	$uid = $_SESSION['uid']; 
}

$kid = 0;
$og_data = "";
if(isset($_GET["kid"])){
	$kid = (int)$_GET["kid"];

	$con = getDBConnection();
	$query = "SELECT kid, uid, title, tags  FROM kiji_title WHERE kid=$kid";
	//echo $query;
	$result_title = mysqli_query($con,$query);
	if($rdata = mysqli_fetch_array($result_title)) {
		$kid = $rdata["kid"];
		$u_uid = $rdata["uid"];
		$title = $rdata["title"];
		$tags = $rdata["tags"];
	}
	else{
		print("記事が存在しません");
		exit;
	}

	$query = "SELECT uid, twsname  FROM c_user_id WHERE uid=$u_uid";
	//echo $query;
	$result_u = mysqli_query($con,$query);
	if($r_user = mysqli_fetch_array($result_u)) {
		$twsname = $r_user["twsname"];
	}
	else{
		print("記事が存在しません");
		exit;
	}

	//twitter cardのために画像やタイトルなどの情報を取得する
	$og_data
		 .="<meta property='og:title' content='$title' />\n"
		 . "<meta property='og:type' content='artcle' />\n"
		 . "<meta property='og:url' content='$baseUrl/?kid=$kid' />\n"
		 . "<meta property='og:image' content='$baseUrl/call/get_kijifimg.php?kid=$kid' />\n"
		 . "<meta property='og:site_name' content='@$twsname' />\n"
		 . "<meta property='og:description' content='$tags /同人誌などの情報交換所' />\n"
		 . "<meta name='twitter:card' content='Summary with Large Image' />\n";
		 

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
	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<script src="./bootstrap/bootstrap-notify.min.js"></script>
	
	<link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="./call/common_js.js?20200923"></script>

	<?php print($og_data); ?>

	<title>同人誌販促</title>
</head>
<body>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<style>

header a{
	 display: block;
	 position: fixed;
	 top: 8px;
	 z-index: 9999;
	 color: #7eab55;
	 font-size: 24px;
	 width: 32px;
	 height: 32px;
	 text-align: center;
}
.userBox a{ left: 16px;}
.uploadBox a{ right: 16px;}
.searchBox a{ right: 48px;}
#creator_twicon{ border-radius:50% 50% 50% 50%; }
.user_twicon{ max-width:24px; max-height:24px; border-radius:50% 50% 50% 50%; }

.container{padding-bottom: calc(env(safe-area-inset-bottom));}
.color01{ color: #7eab55; }

.swiper-container{
	position: relative;
	width: 100%;
	height: 90vh;
	overflow: hidden;
	margin: 0 auto;
	text-align: center;
}
.swiper-slide { }
.imgBox{
	text-align: center;
	line-height: 1;
	display: flex;
	align-items: flex-start;
	justify-content: center;
	margin: 40px auto 0;
	padding: 20px 5px 80px;
	max-width: 100%;
	max-height: 94%;
}
.imgBox img { display: inline; width: auto; max-width: 98%; max-height: 99%; align-self: center; box-shadow: 0 0 2px 2px rgba(0,0,0,0.2); border-radius: 2px; display: inline; text-align: center;}
.txBox{
	text-align: center;
	line-height: 1;
	margin: 40px auto 0;
	padding: 20px 5px 80px;
	max-width: 100%;
	max-height: 94%;
}
.my_sw_lr{ padding: 10px;}
.my_sw_lr{}
.my_sw_ud{}

/*nav*/
.swiper-button-next:focus,
.swiper-button-prev:focus{ outline:none;}

.my_sw_lr .swiper-button-next::before { content:'';
	font-family: "Font Awesome 5 Free";
	font-weight: 900;
	content: "\f104";
 font-size: 36px; color: #fff; text-shadow: 0 0 4px #333;}
.my_sw_lr .swiper-button-prev::before { content:'';
	font-family: "Font Awesome 5 Free";
	font-weight: 900;
	content: "\f105";
 font-size: 36px; color: #fff; text-shadow: 0 0 4px #333;}

.swiper-container-rtl .swiper-button-next:after{ content:'';}
.swiper-container-rtl .swiper-button-prev:after{ content:'';}

.swiper-button-prev,
.swiper-container-rtl .swiper-button-next { left: 0px; right: auto;}
 
.swiper-button-next,
.swiper-container-rtl .swiper-button-prev { right: 0px; left: auto;}

.my-next,
.my-prev{ font-size: 32px; }

.my-up,
.my-down{ font-size: 12px;width: 100%; margin: 0 auto; color: #666; }

.my-up { top: 5px; bottom: auto;}
.my-down { position: fixed; top: auto; bottom: 80px;}



footer{
	display: flex; 
	justify-content: space-between;
	font-size: 12px;
	background: #efefef;
	z-index: 9999;
	position: fixed;
	bottom: 0;
	left: 0;
	border-top: 1px solid #ccc;
	width: 100%;
	height: calc(55px + env(safe-area-inset-bottom));
	line-height: 55px;
	padding-bottom: calc(env(safe-area-inset-bottom));
	padding-top: calc(env(safe-area-inset-bottom) - 35px);
	padding-left: 16px;
}

footer a{ display: inline-block; color: #666; }

footer i{ padding-right: 5px; font-size: 18px; }
footer .fas{ color: #7eab55;}

.followBtn img{ width: 32px; height: 32px; margin-right: 5px; }
.twitterBtn a{ padding: 0 20px; color: #2aa4ef; }
footer .twitterBtn i{ padding: 0; }
footer .red{ color: #d3386d; }

.marquee{
	width: 100%;
	display: block; 
	font-size: 12px; 
	z-index: 9998; 
	position: fixed; 
	left: 0; 
	bottom: 60px; 
	padding-bottom: calc(env(safe-area-inset-bottom));
	padding-top: calc(env(safe-area-inset-bottom) - 50px); 
}
.marquee{
	text-shadow:2px 2px 3px #fff, 0px 0px 2px #fff;
}

</style>

<header>
<div class="userBox">

<?php 

if($uid==0){
	print('<a href="./login.php"><i class="fas fa-user-circle"></i></a>');
}
else{
	$con = getDBConnection();
	$query = "SELECT twicon FROM c_user_id WHERE uid=$uid";
	//echo $query;
	$result_user = mysqli_query($con,$query);
	if($rdata = mysqli_fetch_array($result_user)) {
		$twicon = $rdata["twicon"];
	}
	print('<a href="./u_menu.php"><img class="user_twicon" src="'.$twicon.'"/></a>');
}

?>
</div>
<div class="uploadBox"><a href="/m_upload.php"><i class="far fa-arrow-alt-circle-up"></i></a></div>
<?php
//あとでサーチを足す場合の処理
// <div class="searchBox"><a href=""><i class="fas fa-search"></i></a></div>
?>
</header>


<main class="container">
<div class="row">
	<div class="col-md-12">

		<?php 
		// Swiper 上下 START
		?>
		<div class="swiper-container my_sw_ud" dir="rtl">
			<div id="swiper_ud_top" class="swiper-wrapper swiper-wrapper-ud">
<?php
/* 
元々のタグ構造。参考までに残しておく
				<div class="swiper-slide swiper-slide-ud">
					<div class="swiper-container my_sw_lr" dir="rtl">
						<div class="swiper-wrapper swiper-wrapper-lr">
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/img001.jpg"></div>
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/img002.jpg"></div>
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/img003.jpg"></div>
							<div class="swiper-slide swiper-slide-lr txBox">
								この作品の詳細<br>
								<br>
								<a href="https://seiga.nicovideo.jp/comic/35365">ニコニコ静画</a><br>
								<br>
								aaa
							</div>
						</div>
						<div class="swiper-button-prev my-prev"></div>
						<div class="swiper-button-next my-next"></div>
					</div>
				</div>	
				
				<div class="swiper-slide swiper-slide-ud">				
					<div class="swiper-container my_sw_lr" dir="rtl">
						<div class="swiper-wrapper swiper-wrapper-lr">
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/100_1.jpg"></div>
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/100_2.jpg"></div>
							<div class="swiper-slide swiper-slide-lr">
								この作品の詳細<br>
								<br>
								<a href="https://seiga.nicovideo.jp/comic/35365">ニコニコ静画</a><br>
								<br>
								aaa
							</div>
						</div>
						<div class="swiper-button-prev my-prev"></div>
						<div class="swiper-button-next my-next"></div>
					</div>
				</div>

				<div class="swiper-slide swiper-slide-ud">
					<div class="swiper-container my_sw_lr" dir="rtl">
						<div class="swiper-wrapper swiper-wrapper-lr">
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/img004.jpg"></div>
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/100_1.jpg"></div>
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/100_2.jpg"></div>
							<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/img005.jpg"></div>
							<div class="swiper-slide swiper-slide-lr">
								この作品の詳細<br>
								<br>
								<a href="https://seiga.nicovideo.jp/comic/35365">ニコニコ静画</a><br>
								<br>
								aaa
							</div>
						</div>
						<div class="swiper-button-prev my-prev"></div>
						<div class="swiper-button-next my-next"></div>
					</div>
				</div>	
				<div class="swiper-slide swiper-slide-ud">Slide 3</div>
				<div class="swiper-slide swiper-slide-ud">Slide 4</div>
				<div class="swiper-slide swiper-slide-ud">Slide 5</div>
 */
?>

			</div>
			
			<div class="swiper-button-prev my-up"><i class="fas fa-chevron-up"> 前の作品</i></div>
			<div class="swiper-button-next my-down"><i class="fas fa-chevron-down"> 次の作品</i></div>
			
		</div>
		<?php 
		// Swiper 上下 END
		?>
		
	</div>
</div>
</main>


<marquee class="marquee"></marquee>

<footer>
<div class="followBtn"><a href=""><img id="creator_twicon" ></a><a id="follow_btn" href="">フォロー</a></div>
<div class="commentBtn"><a href=""><i class="fas fa-comment-dots"></i>(開発中)</a></div>
<div class="heartBtn">
	<a id="like_btn" href=""></a>
	<span id="like_num"></span>
</div>
<div class="twitterBtn">
	<a id="tw_btn"  href="" target="_blank">
		<i class="fab fa-twitter"></i>
		シェア
	</a>
</div>
</footer>
</body>

<script>

var kijis = Array();
kijis.push(<?php print($kid); ?>);


//フォロー処理
$('#follow_btn').on('click', function() {
	var callUrl = "./call/update_follow.php";
	senddata = new Object();
	senddata.creator_uid   = $("#creator_twicon").attr("data-creator_uid");
	if($("#follow_btn").text() == "フォロー"){
		senddata.follow_yes = "yes";
	}
	else{
		//確認
		if(window.confirm("フォローを外しますか？") == false){
			return false;
		}
		senddata.follow_yes = "no";
	}
	$.post(callUrl, { json : JSON.stringify(senddata) }, 
		function(objRes){
			if(objRes.status == "success"){
				if(objRes.follow_yes=="no"){
					$("#follow_btn").text("フォロー");
				}
				else{
					$("#follow_btn").text("following");
				}
			}
			else{
				$.notify(objRes.msg);
			}
		}, "json")
	;
	return false;	//ジャンプしない
});

//いいね処理
$('#like_btn').on('click', function() {
	var callUrl = "./call/update_like.php";
	senddata = new Object();
	senddata.kid   = $("#like_btn").attr("data-kid");
	//yes noの入れ替え
	senddata.like_yes = "no";
	console.log();
	if($("#like_btn").attr("data-like_yes") == "no"){
		senddata.like_yes = "yes";
	}

	$.post(callUrl, { json : JSON.stringify(senddata) }, 
		function(objRes){
			if(objRes.status == "success"){
				
				$("#like_btn").attr("data-like_yes",objRes.like_yes);
				$("#like_btn").empty();
				if(objRes.like_yes=="no"){
					$("#like_btn").append($("<i>",{class:"far fa-heart"}));
				}
				else{
					$("#like_btn").append($("<i>",{class:"fas fa-heart red"}));
				}

				$("#like_num").text(objRes.like_num);

				//表示中ページのパラメータも更新
				var active_page = $(".swiper-slide-ud" + ".swiper-slide-active");
				active_page.attr("data-like_yes",objRes.like_yes);
				active_page.attr("data-like_num",objRes.like_num);
			}
			else{
				$.notify(objRes.msg);
			}
		}, "json")
	;
	return false;	//ジャンプしない
});


//スワイプ処理
var lrSwiper = new Swiper('.my_sw_lr', {
	direction: 'horizontal',		//横方向
	mousewheel: {
		forceToAxis: true,		//マウスの方向と同じ時だけ動かす
		invert: false,
		autoHeight: true
	},
	keyboard: true,
	nested: true,
	//observer: true,
	//observerParent: true,
	navigation: {			//左と右のボタン
		nextEl: '.my-next',
		prevEl: '.my-prev'
	}
});

var udSwiper = new Swiper('.my_sw_ud', {
	direction: 'vertical',		//縦方向
	mousewheel: {
		forceToAxis: true,		//マウスの方向と同じ時だけ動かす
		invert: false,
		autoHeight: true
	},
	keyboard: true,
	observer: true,				//追加要素の監視
	nested: true,
		navigation: {			//上下ボタン
		nextEl: '.my-down',
		prevEl: '.my-up'
	},
	on: {
		reachEnd: function (sqiper) {
			var senddata = new Object();
			senddata.kijis = kijis;
			$.post("./call/get_kiji.php", { json : JSON.stringify(senddata) }, 
				function(objRes){
					if(objRes.status == "success"){
						createKiji(objRes.section);
					}
					else{
						$.notify(objRes.msg);
					}
				}
			, "json");
		},	//event reachEnd end
		slideChange: kijiSwipe,
    },
});

//初期処理(記事のIDを飛ばす)
$(function(){
	var senddata = new Object();
	senddata.kid = <?php print($kid); ?>;
	senddata.kijis = Array();
	$.post("./call/get_kiji.php", { json : JSON.stringify(senddata) }, 
		function(objRes){
			if(objRes.status == "success"){
				createKiji(objRes.section);
			}
			else{
				$.notify(objRes.msg);
			}
			kijiSwipe(udSwiper);
		}
	, "json");
});

function createKiji(section){
	var swiper_ud = $("<div>",{class:"swiper-slide swiper-slide-ud"});

	swiper_ud.attr("data-kid",section.kid);
	swiper_ud.attr("data-uid",section.uid);
	swiper_ud.attr("data-title",section.title);
	swiper_ud.attr("data-url1",section.url1);
	swiper_ud.attr("data-url2",section.url2);
	swiper_ud.attr("data-url3",section.url3);
	swiper_ud.attr("data-url4",section.url4);
	swiper_ud.attr("data-url5",section.url5);
	swiper_ud.attr("data-tags",section.tags);
	swiper_ud.attr("data-twid",section.twid);
	swiper_ud.attr("data-twsname",section.twsname);
	swiper_ud.attr("data-twtname",section.twtname);
	swiper_ud.attr("data-twicon",section.twicon);
	swiper_ud.attr("data-follow_yes",section.follow_yes);
	swiper_ud.attr("data-like_yes",section.like_yes);
	swiper_ud.attr("data-like_num",section.like_num);

	kijis.push(section.kid);

	
	var swiper_lr_top =  $("<div>",{class:"swiper-container my_sw_lr", dir:"rtl",id:"kid_"+section.kid});
	swiper_ud.append(swiper_lr_top);
	var swiper_lr_wp = $("<div>",{class:"swiper-wrapper swiper-wrapper-lr"});
	swiper_lr_top.append(swiper_lr_wp);

	$.each(section.img_data, function(index, value) {
		//console.log(value);
		var swiper_lr_page =  $("<div>",{class:"swiper-slide swiper-slide-lr imgBox"});
		swiper_lr_wp.append(swiper_lr_page);
		swiper_lr_page.attr("data-knum",value.knum);

		var swiper_img = $("<img>");
		swiper_img.attr("src",value.imgdata);
		swiper_lr_page.append(swiper_img);
	});

	//URLページ
	var swiper_url_page =  $("<div>",{class:"swiper-slide swiper-slide-lr urlPage"});
	swiper_lr_wp.append(swiper_url_page);
	swiper_url_page.attr("data-knum","url");
	swiper_url_page.append($("<br>")).append($("<br>")).append($("<br>"));
	swiper_url_page.append($("<p>").text("詳しい情報はこちら"));
	swiper_url_page.append($("<br>")).append($("<br>"));
	swiper_url_page.append($("<a>",{href:section.url1}).text(section.url1));
	swiper_url_page.append($("<br>")).append($("<br>"));
	swiper_url_page.append($("<a>",{href:section.url2}).text(section.url2));
	swiper_url_page.append($("<br>")).append($("<br>"));
	swiper_url_page.append($("<a>",{href:section.url3}).text(section.url3));
	swiper_url_page.append($("<br>")).append($("<br>"));
	swiper_url_page.append($("<a>",{href:section.url4}).text(section.url4));
	swiper_url_page.append($("<br>")).append($("<br>"));
	swiper_url_page.append($("<a>",{href:section.url5}).text(section.url5));

	//送りボタン
	var swiper_lr_prev = $("<div>",{class:"swiper-button-prev my-prev"});
	swiper_lr_top.append(swiper_lr_prev);
	var swiper_lr_next = $("<div>",{class:"swiper-button-next my-next"});
	swiper_lr_top.append(swiper_lr_next);

	$("#swiper_ud_top").append(swiper_ud);
	new Swiper(swiper_lr_top[0], {
		direction: 'horizontal',		//横方向
		mousewheel: {
			forceToAxis: true,		//マウスの方向と同じ時だけ動かす
			invert: false,
			autoHeight: true
		},
		keyboard: true,
		nested: false,
		navigation: {			//左と右のボタン
			nextEl: '.my-next',
			prevEl: '.my-prev'
		}
	});
}

function kijiSwipe(sqiper) {
	var active_page = $(sqiper.slides[sqiper.activeIndex]);
	$("#creator_twicon").attr("src",active_page.attr("data-twicon"));
	$("#creator_twicon").attr("data-creator_uid",active_page.attr("data-uid"));
	
	//フォロー
	if(active_page.attr("data-follow_yes")=="no"){
		$("#follow_btn").text("フォロー");
	}
	else{
		$("#follow_btn").text("following");
	}
	
	//いいね
	$("#like_btn").attr("data-kid",active_page.attr("data-kid"));
	$("#like_btn").attr("data-like_yes",active_page.attr("data-like_yes"));
	$("#like_btn").attr("data-like_num",active_page.attr("data-like_num"));
	$("#like_num").text(active_page.attr("data-like_num"));
	$("#like_btn").empty();
	if(active_page.attr("data-like_yes")=="no"){
		$("#like_btn").append($("<i>",{class:"far fa-heart"}));
	}
	else{
		$("#like_btn").append($("<i>",{class:"fas fa-heart red"}));
	}
	
	
	//タイトル
	$(".marquee").text(active_page.attr("data-title"));

	//twiiterシェア
	var tw_href = "https://twitter.com/intent/tweet?text="
				+ encodeURIComponent(active_page.attr("data-title")+"\n"+base_url+"?kid="+active_page.attr("data-kid")+"\n");
	$("#tw_btn").attr("href",tw_href);
}
</script>
</html>
