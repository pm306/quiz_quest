<?php
require_once("config.php");

//ログイン確認できるように
$uid = 0;
if(isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
}
$_SESSION['now_view'] = "quest";

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

	<?php /* bootstrap標準のjqueryだとload関数などが存在しないのでこちらを使う */ ?>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

	<?php /* bootstarp */ ?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<link src="./lib/bootstrap/bootstrap-notify.min.js"></link>
	<link src="./lib/barIndicator-master/barIndicator/jquery-barIndicator.js"></link>

	<link src="https://kit.fontawesome.com/0f8c1ac530.js" crossorigin="anonymous"></link>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"></link>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></link>

	<?php /* パーティクルのライブラリ  https://ics.media/entry/11172/ */ ?>
	<script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
	<script src="https://cdn.rawgit.com/ics-creative/ParticleJS/release/1.0.0/libs/particlejs.min.js"></script>
	<script src="./call/particle_json.php?<?php print(date("Ymd_His")); ?>"></script>

	<link src="./call/common_js.php?<?php print(date("Ymd_His")); ?>"></link>
	<link href="./call/common_style.php?<?php print(date("Ymd_His")); ?>" rel="stylesheet"></link>

	<?php /* スタイルシートの読み込み */ ?>
	<link rel="stylesheet" href="css/quest.css?<?php print(date("Ymd_His")); ?>" type="text/css"></link>
	<?php /* スクリプトの読み込み */ ?>
	<script type="text/javascript" src="src/quest/main.js?<?php print(date("Ymd_His")); ?>"></script>
    <script type="text/javascript" src="src/quest/class.js?<?php print(date("Ymd_His")); ?>"></script>
	<script type="text/javascript" src="src/quest/model.js?<?php print(date("Ymd_His")); ?>"></script>
	<script type="text/javascript" src="src/quest/view.js?<?php print(date("Ymd_His")); ?>"></script>
	<script type="text/javascript" src="src/quest/battle/hero_battle.js?<?php print(date("Ymd_His")); ?>"></script>
	<script type="text/javascript" src="src/quest/battle/enemy_battle.js?<?php print(date("Ymd_His")); ?>"></script>

	<title>クエスト</title>
</head>

<body>

<main class="quizgame-fluid">

<div class="row enemy_boxes">

	<div>
		<img class="stage_clear_img" src="./img/sozai/stage_clear.png">
	</div>

	<div id="enemy_box_1" class="col-4 enemy_box">
			<img  id="enemy_img_1" class="enemy_img" src="/img/sozai/touka_enemy.png">
		<div>
			<progress id="enemy_hp_1" class="enemy_hp"value="100" max="100"></progress>
		</div>
	</div>

	<div id="enemy_box_2" class="col-4 enemy_box">
			<img  id="enemy_img_2" class="enemy_img" src="/img/sozai/touka_enemy.png">
		<div>
			<progress id="enemy_hp_2" class="enemy_hp" value="100" max="100"></progress>
		</div>
	</div>

	<div id="enemy_box_3" class="col-4 enemy_box">
			<img id="enemy_img_3" class="enemy_img" src="/img/sozai/touka_enemy.png">
		<div>
			<progress id="enemy_hp_3" class="enemy_hp" value="100" max="100"></progress>
		</div>
	</div>

</div>

<div class="row hero_boxes" sytle="max-height:40px;">

	<div id="hero_box_1" class="col hero_box">
			<img id="hero_img_1" class="hero_img" src="/img/jewel-s/image/icon/f001.png">
		<div>
			<progress id="hero_hp_1" class="hero_hp" value="100" max="100"></progress>
		</div>
	</div>

	<div id="hero_box_2" class="col hero_box">
			<img id="hero_img_2" class="hero_img" src="/img/jewel-s/image/icon/f068.png">
		<div>
			<progress id="hero_hp_2" class="hero_hp" value="100" max="100"></progress>
		</div>
	</div>

	<div id="hero_box_3" class="col hero_box">
			<img id="hero_img_3" class="hero_img" src="/img/jewel-s/image/icon/f121.png">
		<div>
			<progress id="hero_hp_3" class="hero_hp" value="100" max="100"></progress>
		</div>
	</div>

	<div id="hero_box_4" class="col hero_box">
			<img id="hero_img_4" class="hero_img" src="/img/jewel-s/image/icon/f010.png">
		<div>
			<progress id="hero_hp_4" class="hero_hp" value="100" max="100"></progress>
		</div>
	</div>

	<div id="hero_box_5" class="col hero_box">
			<img id="hero_img_5" class="hero_img" src="/img/jewel-s/image/icon/f054.png">
	<div>
			<progress id="hero_hp_5" class="hero_hp" value="100" max="100"></progress>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 genre_top">

		<div class="row genre_boxes">

			<div class="col-sm-6 col-xs-12">
				<div id="genre_box_1" class="genre_box text-center" data-question_number="1">
					<img class="color_icon" src="/img/jewel-s/processed/color_icon/touka.png">
					<span id= "genre_text_1" class="genre_text"></span>
				</div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<div id="genre_box_2" class="genre_box text-center" data-question_number="2">
					<img class="color_icon" src="/img/jewel-s/processed/color_icon/touka.png">
					<span id= "genre_text_2" class="genre_text"></span>
				</div>
			</div>
		</div>

		<div class="row genre_boxes">
			<div class="col-sm-6 col-xs-12">
				<div id="genre_box_3" class="genre_box text-center" data-question_number="3">
					<img class="color_icon" src="/img/jewel-s/processed/color_icon/touka.png">
					<span id= "genre_text_3" class="genre_text"></span>
				</div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<div id="genre_box_4" class="genre_box text-center" data-question_number="4">
					<img class="color_icon" src="/img/jewel-s/processed/color_icon/touka.png">
					<span id= "genre_text_4" class="genre_text"></span>
				</div>
			</div>
		</div>

	</div>
</div>
<div class="row bottom_box">
</div>


</main>


<div class="modal fade"
	id="question_moodal" tabindex="-1" role="dialog"
	aria-labelledby="questionLabel" aria-hidden="true" data-backdrop="static">
</div>

<div id="answer_check_overlay_0" class="answer_check_overlay">
</div>
<div id="answer_check_overlay_1" class="answer_check_overlay">
	<div class="answer_check_img">
		<img id="answer_check_img_1" class="answer_check_img" src="./img/sozai/answer_check/1_perfect.png">
	</div>
</div>
<div id="answer_check_overlay_2" class="answer_check_overlay">
	<div class="answer_check_img">
		<img id="answer_check_img_2" class="answer_check_img" src="./img/sozai/answer_check/2_great.png">
	</div>
</div>
<div id="answer_check_overlay_3" class="answer_check_overlay">
	<div class="answer_check_img">
		<img id="answer_check_img_3" class="answer_check_img" src="./img/sozai/answer_check/3_nice.png">
	</div>
</div>
<div id="answer_check_overlay_4" class="answer_check_overlay">
	<div class="answer_check_img">
		<img id="answer_check_img_4" class="answer_check_img" src="./img/sozai/answer_check/4_ok.png">
	</div>
</div>
<div id="answer_check_overlay_5" class="answer_check_overlay">
	<div class="answer_check_img">
		<img id="answer_check_img_5" class="answer_check_img" src="./img/sozai/answer_check/5_miss.png">
	</div>
</div>

<div class="phase_start">
	<div id="phase_start_overlay_1" class="phase_start_overlay">
		<img class="phase_start_img d-block mx-auto" src="./img/sozai/phase_start_1.png">
	</div>
	<div id="phase_start_overlay_2" class="phase_start_overlay">
		<img class="phase_start_img d-block mx-auto" src="./img/sozai/phase_start_2.png">
	</div>
	<div id="phase_start_overlay_3" class="phase_start_overlay">
		<img class="phase_start_img d-block mx-auto" src="./img/sozai/phase_start_3.png">
	</div>
</div>


<div class="set_tmp_data"></div>
<div class="set_pre_quizdata"></div>

<?php
require("w_menu.php");
?>

</body>


</html>
