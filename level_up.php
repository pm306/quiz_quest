<?php
require_once("config.php");

//ログイン確認できるように
$uid = 0;
if(isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
}
$_SESSION['now_view'] = "level_up";

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

    <link rel="stylesheet" href="/css/level_up.css?<?php print(date("Ymd_His")); ?>" type="text/css"></link>
	<script type="module" src="src/level_up/main.js?<?php print(date("Ymd_His")); ?>"></script>

	<title>レベル強化</title>
</head>
<body>

<main class="quizgame-fluid">

<!-- 2つのtrue/falseで「キャラがセットされているか」「『選択状態』かどうか」を判別する -->
<div class="row level_up_unit" data-isSet="false" data-isSelect="false">
    <div class="offset-1 col-4 level_up_icon">
        <img src="/img/sozai/empty_icon.png">
    </div>
    <!-- 強化キャラのステータス名 -->
    <div class="col-3 status_name">
        <div>Lv上限</div>
        <div>Lv</div>
        <div>経験値</div>
        <div>攻撃力</div>
        <div>HP</div>
    </div>
    <!-- 強化キャラのステータス値 -->
    <div class="col-4 status_value">
        <div>-</div>
        <div>-</div>
        <div>
            <progress class="experience_bar" value="0" max="100"></progress>
        </div>
        <div>-</div>
        <div>-</div>
    </div>

</div>

<!-- 素材キャラリスト　5*2枠 -->
<div class="row element_units">
    <div class="offset-1 col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
</div>

<div class="row element_units">
    <div class="offset-1 col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png" data-isEmpty="true">
    </div>
</div>

<!-- 強化ボタン -->
<div class="row">
    <div class="offset-3 col-6 level_up_button_parent">
        <div class="level_up_button">強化</div>
    </div>
</div>

<!-- 手持ちキャラリスト(動的生成) 個別スクロールする-->
<div class="row my_units overflow-auto"></div>

</main>

<?php
require("w_menu.php");
?>

</body>
</html>
