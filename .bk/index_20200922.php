<?php
require_once("config.php");


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
	
	<link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="./call/common_js.js"></script>

	<title>同人誌販促</title>
</head>
<body>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<header>
<div class="userBox"><a href=""><i class="fas fa-user-circle"></i></a></div>
<div class="searchBox"><a href=""><i class="fas fa-search"></i></a></div>
</header>
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
.searchBox a{ right: 16px;}
#owner_twicon{ border-radius:50% 50% 50% 50%; }

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
	max-height: 90%;
}
.imgBox img { display: inline; width: auto; max-width: 98%; max-height: 95%; align-self: center; box-shadow: 0 0 2px 2px rgba(0,0,0,0.2); border-radius: 2px; display: inline; text-align: center;}
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
<main class="container">
<div class="row">
	<div class="col-md-12">

		<!-- Swiper 左右 START -->
		<div class="swiper-container my_sw_ud" dir="rtl">
			<div id="swiper_ud_top" class="swiper-wrapper swiper-wrapper-ud">
				<div class="swiper-slide swiper-slide-ud">
				
				
						<!-- Swiper 左右 START -->
						<div class="swiper-container my_sw_lr" dir="rtl">
							<div class="swiper-wrapper swiper-wrapper-lr">
								<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/img001.jpg"></div>
								<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/img002.jpg"></div>
								<div class="swiper-slide swiper-slide-lr imgBox"><img src="./img/img003.jpg"></div>
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
						<!-- Swiper 左右 END -->

				</div>	
				
				<div class="swiper-slide swiper-slide-ud">
				
						<!-- Swiper 左右 START -->
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
						<!-- Swiper 左右 END -->
				
				</div>
				<div class="swiper-slide swiper-slide-ud">
				
				
						<!-- Swiper 左右 START -->
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
						<!-- Swiper 左右 END -->

				</div>	
<!-- 				<div class="swiper-slide swiper-slide-ud">Slide 3</div>
				<div class="swiper-slide swiper-slide-ud">Slide 4</div>
				<div class="swiper-slide swiper-slide-ud">Slide 5</div> -->
			</div>
			
			<div class="swiper-button-prev my-up"><i class="fas fa-chevron-up"> 前の作品</i></div>
			<div class="swiper-button-next my-down"><i class="fas fa-chevron-down"> 次の作品</i></div>
			
		</div>
		<!-- Swiper 左右 END -->
		
	</div>
</div>
</main>


<marquee class="marquee">時計仕掛けの東北三姉妹はリニアコライダーの夢を見るか</marquee>

<footer>
<div class="followBtn"><a href=""><img id="owner_twicon" src="./img/icon01.png"></a><a href="">フォローする</a></div>
<div class="commentBtn"><a href=""><i class="fas fa-comment-dots"></i>9999</a></div>
<div class="heartBtn"><a href="">
<i class="far fa-heart"></i>
<i class="fas fa-heart red"></i>
9999</a></div>
<div class="twitterBtn">
	<a href="https://twitter.com/intent/follow?screen_name=自分のツイッターID">
		<i class="fab fa-twitter"></i>
		twitterでシェア
	</a>
</div>
</footer>
</body>

<script>
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
		navigation: {			//左と右のボタン
		nextEl: '.my-down',
		prevEl: '.my-up'
	},
	on: {
		reachEnd: function (sqiper) {
			var senddata = "";
			$.post("./call/get_kiji.php", { json : JSON.stringify(senddata) }, 
				function(objRes){
					if(objRes.status == "success"){
						//alert(objRes.msg);
						//console.log(vardump(objRes));
						
						//追加記事DOM生成
						var swiper_ud = $("<div>",{class:"swiper-slide swiper-slide-ud"});

						swiper_ud.attr("data-kid",objRes.section.kid);
						swiper_ud.attr("data-uid",objRes.section.uid);
						swiper_ud.attr("data-title",objRes.section.title);
						swiper_ud.attr("data-url1",objRes.section.url1);
						swiper_ud.attr("data-url2",objRes.section.url2);
						swiper_ud.attr("data-url3",objRes.section.url3);
						swiper_ud.attr("data-url4",objRes.section.url4);
						swiper_ud.attr("data-url5",objRes.section.url5);
						swiper_ud.attr("data-tags",objRes.section.tags);
						swiper_ud.attr("data-twid",objRes.section.twid);
						swiper_ud.attr("data-twsname",objRes.section.twsname);
						swiper_ud.attr("data-twtname",objRes.section.twtname);
						swiper_ud.attr("data-twicon",objRes.section.twicon);


						var swiper_lr_top =  $("<div>",{class:"swiper-container my_sw_lr", dir:"rtl"});
						swiper_ud.append(swiper_lr_top);

						$.each(objRes.section.img_data, function(index, value) {
							//console.log(value);
							var swiper_lr_page =  $("<div>",{class:"swiper-slide swiper-slide-lr imgBox"});
							swiper_lr_top.append(swiper_lr_page);

							swiper_lr_page.attr("data-knum",value.knum);

							var swiper_img = $("<img>");
							swiper_img.attr("src",value.imgdata);
							swiper_lr_page.append(swiper_img);
						});

						//URLページ
						var swiper_lr_page =  $("<div>",{class:"swiper-slide swiper-slide-lr"});
						swiper_lr_top.append(swiper_lr_page);
						swiper_lr_page.attr("data-knum","url");
						
						//送りボタン
						var swiper_lr_prev = $("<div>",{class:"swiper-button-prev my-prev"});
						swiper_lr_top.append(swiper_lr_prev);
						var swiper_lr_next = $("<div>",{class:"swiper-button-next my-next"});
						swiper_lr_top.append(swiper_lr_next);

						$("#swiper_ud_top").append(swiper_ud);
					}
					else{
						alert(objRes.msg);
					}
				}
			, "json");
		},	//event reachEnd end
		slideChange: function (sqiper) {
			var active_page = $(sqiper.slides[sqiper.activeIndex]);
			$("#owner_twicon").attr("src",active_page.data("twicon"));
			$(".marquee").text(active_page.data("title"));

		}	//event slideChange end
    },
});

</script>
</html>
