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

	<link src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></link>

	<?php /* bootstarp */ ?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<link src="./lib/bootstrap/bootstrap-notify.min.js"></link>
	<link src="./lib/barIndicator-master/barIndicator/jquery-barIndicator.js"></link>


	<link src="https://kit.fontawesome.com/0f8c1ac530.js" crossorigin="anonymous"></link>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"></link>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></link>

	<link src="./call/common_js.php?20201013"></link>
	<link href="./call/common_style.php?20201013" rel="stylesheet"></link>


	<title>クイズ</title>
</head>
<body>

<script>
$(function(){
	$('#stamina_bar').barIndicator();
});

</script>

<style>

.container-fluid{
	position: relative;
	padding-bottom: calc(env(safe-area-inset-bottom));
	transform: translateY(10px);
	background-image: url(./img/soza/bg_gallery.jpg);
}
/* 固定幅を超えた場合の処理 */
@media (min-width: <?php print($flex_width); ?>) {
  .container-fluid {
    max-width: var(--flex_width);
  }
}
@media (max-width: 660px) {
	.container-fluid {
		position: relative;
		top: calc((10vw - 140px));
	}
}
@media (max-width: 650px) {
	.container-fluid {
		position: absolute;
		top: 0vw;
		transform: translateY(calc((15vw)));
	}
}


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
		<img src="./img/sozai/diamond.png">
		<span id="stone_num">3,000</span>
	</div>

	<div class="headerPresent">
		<span class="headerPresentIcon">
			<img src="./img/sozai/present.png">
		</span>
		<p class="headerPresentLetter">プレゼント</p>
	</div>
	<div class="headerPresentBaloonTop">
		<div class="headerPresentBaloon">
			<span id="present_num">11</span>
		</div>
	</div>

</header>

<main class="quizgame-fluid">
<div class="container-fluid">
<div class="row">
	<div class="col-md-12">
	</div>
</div>

<div class="row">
	<div class="col-md-12 background-star">
		<img class="animate__animated animate__pulse animate__infinite more_slower" src="./img/jewel-s/image/character/f036.png" >
		<img class="star_animation" src="./img/sozai/star7.png"/>
	</div>
</div>
</div>
</main>


<?php
require("w_menu.php");
?>

</body>


</html>
