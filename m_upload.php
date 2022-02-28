<?php
require_once("config.php");


//ログインしているか確認。していない場合はuidで抽出できないように-1とする
$uid = -1;
if(isset($_SESSION['uid'])){
	$uid = $_SESSION['uid']; 
}
else{	//ログインしていない場合は、ログイン画面に飛ばす
	$_SESSION['tw_callback_url'] = "/u_menu.php";	//現在のページに戻ってこれるように指定
	header('Location: /login.php');
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="./bootstrap/css/bootstrap.min.css" media="all" rel="stylesheet" />
	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<script src="./bootstrap/bootstrap-notify.min.js"></script>
	<script src="./call/common_js.js"></script>
	<title>画像アップロード</title>
<style>
	html, body {
		font-size: 20px;
		text-align: center;
	}
	div#drop-zone {
		border-radius: 20px 20px 20px 20px;
		margin: 1rem auto;
		width: 15rem;
		height: 5rem;
		border: 1px solid #333;
	}
	div#print_image {
		margin: 1rem auto;
	}
	canvas {
		border: 1px solid #333;
		max-width: 100%;
		height: auto;
	}
    
</style>
</head>
<body>

<?php
require_once("header_menu.php");
?>

<main class="container">
<div class="row">
	<div class="col-md-12">
		<h3>同人誌のサンプルページ画像（JPG）をアップロードします</h3>

		<div id="canvas-zone">
		</div>

		<div id="url-zone">
		</div>
		<!--
		<canvas id="mycanvas1">Canvas対応のブラウザで開いて下さい。</canvas>
		-->

		<div id="drop-zone">ここに画像をドロップ！</div>
		<div id="url_zone">
			<div>同人誌のタイトル</div>
			<input type="text" id="hanbai_title" class="form-control" maxlength="100" /><br>

			<div>同人誌販売サイトなどのURL（最大５つ）</div>
			<input type="text" id="hanbai_url_1" class="form-control" placeholder="https://www・・・" maxlength="150" /><br>
			<input type="text" id="hanbai_url_2" class="form-control" placeholder="https://www・・・" maxlength="150" /><br>
			<input type="text" id="hanbai_url_3" class="form-control" placeholder="https://www・・・" maxlength="150" /><br>
			<input type="text" id="hanbai_url_4" class="form-control" placeholder="https://www・・・" maxlength="150" /><br>
			<input type="text" id="hanbai_url_5" class="form-control" placeholder="https://www・・・" maxlength="150" /><br>
			
			<div>タグ（イベント名、ジャンル、キャラクター名など。スペース区切りで）</div>
			<input type="text" id="tags" class="form-control" maxlength="100" /><br>

			<div>R18の場合はチェックしてください</div>
			<input class="form-check-input" type="checkbox" id="r18_button"><br><br>
		</div>
		<div id="print_img">
			<div>
				<button id="add_kiji" class="btn btn-primary btn-lg">データ送信</button>
			</div>
		</div>
	</div>
</div>
<script>

(function() {
    var mycanvas_num = 0;

	//var print_img_id = 'print_img';
	//var print_DataURL_id = 'print_DataURL';
    
    //JQueryでエラーがでたので、javascriptでイベント操作をする
    var dropZone = document.getElementById('drop-zone');
	dropZone.addEventListener('dragover', handleDragOver, false);
	dropZone.addEventListener('drop', handleDragDropFile, false);

	//ドラッグアンドドロップ
	function handleDragOver(e) {
		e.stopPropagation();
		e.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
        e.preventDefault();
	}
	function handleDragDropFile(e) {
		e.stopPropagation();
		e.preventDefault();
		var files = e.dataTransfer.files; // FileList object.
		var file = files[0];
		
        mycanvas_num++;

        //Canvas置き場の作成
        var myparent_canvas = $("<div>");
        var myparent_canvas_id = "myparent_canvas_" + String(mycanvas_num);
        myparent_canvas.attr("id",myparent_canvas_id);
        $("#canvas-zone").append(myparent_canvas);
        
        //Canvas作成
		var mycanvas = $("<canvas>");
		mycanvas.name = "mycanvas";
		mycanvas.addClass("myupcanvas");
        myparent_canvas.append(mycanvas);

        //削除ボタンの作成
        var myparentdelbtn = $("<div>");
        var mydelbtn = $("<button>");
        mydelbtn.text(" ↑ 削除する");
        mydelbtn.on("click", function() {
            myparent_canvas.remove();
        });
        myparent_canvas.append(myparentdelbtn).append(mydelbtn);
        
        //ファイル名入力
        var myparentfilename = $("<div>");
        var myfilenametitle = $("<span>");
        myfilenametitle.text("ファイル名：");
        myparentfilename.append(myfilenametitle);
        var myfilename = $("<span>");
        myfilename.name = "myfilename";
        myfilename.text(escape(file.name));
        myparentfilename.append(myfilename);
        myparent_canvas.append(myparentfilename);
        //ファイル日時入力
        var myparentfiledate = $("<div>");
        var myfiledatetitle = $("<span>");
        myfiledatetitle.text("ファイル作成日時：");
        myparentfiledate.append(myfiledatetitle);
        var myfiledate = $("<span>");
        myfiledate.name = "myfiledate";
        myfiledate.text(new Date(file.lastModified).toLocaleString());
        myparentfiledate.append(myfiledate);
        myparent_canvas.append(myparentfiledate);

        
        
		var reader = new FileReader();
		//dataURL形式でファイルを読み込む
		reader.readAsDataURL(file);
		//ファイルの読込が終了した時の処理
		reader.onload = function(){
			readDrawImg(reader, mycanvas[0], 1000, 1000);
		}
	}
	function readDrawImg(reader, canvas, x, y){
		var img = readImg(reader);
		drawImgOnCav(canvas, img, x, y);
	}
	//ファイルの読込が終了した時の処理
	function readImg(reader){
		//ファイル読み取り後の処理
		var result_dataURL = reader.result;
		var img = new Image();
		img.src = result_dataURL;
		return img;
	}
	//キャンバスにImageを表示
	function drawImgOnCav(canvas, img, x, y) {
		img.onload = function(){
			var ctx = canvas.getContext('2d');
			var wrapper= document.getElementById("print_img");
			var wari_width = this.width / x;
			var wari_height = this.height / y;
			var wariai = 0;
			if(wari_width < wari_height){
				wariai = wari_width;
			}
			else{
				wariai = wari_height;
			}
			
			canvas.width = img.width / wari_height;
			canvas.height = img.height / wari_height;
			ctx.drawImage(img, 0, 0, img.width / wari_height, img.height / wari_height);
		}
	}
	

})();





$('#add_kiji').on('click', function() {
	$("#add_kiji").prop("disabled", true);

	var callUrl = "./call/insert_kiji.php";
	senddata = new Object();
	senddata.hanbai_title   = $("#hanbai_title").val();
	senddata.hanbai_url_1   = $("#hanbai_url_1").val();
	senddata.hanbai_url_2   = $("#hanbai_url_2").val();
	senddata.hanbai_url_3   = $("#hanbai_url_3").val();
	senddata.hanbai_url_4   = $("#hanbai_url_4").val();
	senddata.hanbai_url_5   = $("#hanbai_url_5").val();
	senddata.tags = $("#tags").val();
	senddata.r18 = false;
	if($("#r18_button").prop("checked")){
		senddata.r18 = true;
	}
	var img_list = new Array();
	$('.myupcanvas').each(function (i) {
		var imageType = "image/jpeg";
		var base64 = $(this)[0].toDataURL(imageType);
		img_list.push(base64);
	});
	senddata.img_list = img_list;

	$.post(callUrl, { json : JSON.stringify(senddata) }, 
		function(objRes){
			if(objRes.status == "success"){
				$.notify(objRes.msg);
				setTimeout("location.href='/u_menu.php'",3000);
			}
			else{
				$.notify(objRes.msg);
				$.notify(objRes.query);
				$("#add_kiji").prop("disabled", false);
			}
		}
	, "json");


});



</script>
</body>
</html>