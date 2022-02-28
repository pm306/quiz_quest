<?php
require_once("config.php");

//ログイン確認できるように
$uid = 0;
if(isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
}
$_SESSION['now_view'] = "unit";

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

	<?php /* jQuery */ ?>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

	<?php /* bootstarp */ ?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<link src="./lib/bootstrap/bootstrap-notify.min.js"></link>
	<link src="./lib/barIndicator-master/barIndicator/jquery-barIndicator.js"></link>

	<link src="https://kit.fontawesome.com/0f8c1ac530.js" crossorigin="anonymous"></link>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"></link>

    <?php /* Animate.css */ ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></link>

	<link src="./call/common_js.php?<?php print(date("Ymd_His")); ?>"></link>
	<link href="./call/common_style.php?<?php print(date("Ymd_His")); ?>" rel="stylesheet"></link>

    <link rel="stylesheet" href="/css/party.css?<?php print(date("Ymd_His")); ?>" type="text/css"></link>
	<script type="module" src="src/party/main.js?<?php print(date("Ymd_His")); ?>"></script>

	<title>パーティ編成</title>
</head>
<body>

<main class="quizgame-fluid">

<div class="party_header">
	<span>パーティ編成</span>
</div>

<div class="row party_boxes">
	<div class="left_offset col-2">
		<img class="party_offset" src="/img/sozai/touka_icon.png">
		<div class="status_name">
			<div>レベル</div>
			<div>攻撃力</div>
			<div>HP</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="confirm_button_parent offset-3 col-6">
        <div class="confirm_button">確定</div>
    </div>
</div>

<div class="row my_units overflow-auto"></div>

</main>

<?php
require("w_menu.php");
?>

</body>
</html>
