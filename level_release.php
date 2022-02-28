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

    <link rel="stylesheet" href="/css/level_release.css?<?php print(date("Ymd_His")); ?>" type="text/css"></link>
	<script type="module" src="src/level_release/main.js?<?php print(date("Ymd_His")); ?>"></script>

	<title>レベル上限解放</title>
</head>
<body>

<main class="quizgame-fluid">

<div class="row level_up_unit">
    <div class="offset-1 col-4 level_up_icon">
        <img src="/img/sozai/empty_icon.png">
    </div>
    <div class="col-3 status_name">
        <div>Lv上限</div>
        <div>Lv</div>
        <div>経験値</div>
        <div>攻撃力</div>
        <div>HP</div>
    </div>

    <div class="col-4 status_value">
        <div>100</div>
        <div>18</div>
        <div>
            <progress class="experience_bar" value="40" max="100"></progress>
        </div>
        <div>1500</div>
        <div>1000</div>
    </div>

</div>

<div class="row element_units">
    <div class="offset-1 col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png">
    </div>
    <div class="col-2 element_unit">
        <img class="element_img" src="/img/sozai/empty_icon.png">
    </div>
</div>

<div class="row">
    <div class="offset-3 col-6 level_up_button_parent">
        <div class="level_up_button">上限解放</div>
    </div>
</div>

<div class="row my_units">
    <div class="offset-1 col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
</div>

<div class="row my_units">
    <div class="offset-1 col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
</div>

<div class="row my_units">
    <div class="offset-1 col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
</div>

<div class="row my_units">
    <div class="offset-1 col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="select_element_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
</div>

</main>

<?php
require("w_menu.php");
?>

</body>
</html>
