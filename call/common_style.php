<?php
	header('Content-Type: text/css; charset=utf-8');
	$flex_width = "892px";
?>

:root{
	--flex_width: <?php print($flex_width); ?>;
}



.quizgame-fluid{
	position: absolute;
	padding-bottom: calc(env(safe-area-inset-bottom));
	width: 100%;
}
@media (min-width: <?php print($flex_width); ?>) {	/* 固定幅を超えた場合の処理 */
  .quizgame-fluid {
	width: var(--flex_width);
	max-width: var(--flex_width);
    right: calc(50% - var(--flex_width) / 2 );
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

#stone_num {
    color: #ee0600;
}


.levelBox {
    position: fixed;
    top: -25px;
    z-index: 9999;
    text-align: center;
    box-shadow: 3px 7px 22px -2px #7cf9cb;
    background: linear-gradient(to bottom, #559191 5%, #02282b 100%);
    background-color: #234863;
    border-radius: 25px;
    border: 1px solid #00ffd2;
    display: inline-block;
    cursor: pointer;
    font-family: Arial;
    font-size: 26px;
    padding: 28px 20px;
    text-decoration: none;
    color: #ffe9ab;
    text-shadow: -1px 1px 0 #41ba45, 1px 1px 0 #c63d2b, 1px -1px 0 #42afac, -1px -1px 0 #c6c23f;
    width: 180px;
    height: 130px;
    /* transform: skew(-20deg); */
    border-width: 8px;
}
@media (min-width: <?php print($flex_width); ?>) {
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
    box-shadow: 3px 7px 22px -2px #fff;
    background: linear-gradient(to bottom, #003d40 5%, #007070 100%);
    background-color: #0f192b;
    border-radius: 5px;
    display: inline-block;
    cursor: pointer;
    color: #ffffff;
    font-family: Arial;
    font-size: 20px;
    padding: 5px 20px;
    text-decoration: none;
    text-shadow: 0px 2px 0px #283966;
    left: 110px;
}
@media (min-width: <?php print($flex_width); ?>) {
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
.background-star img {
	/* max-width: 600px; */
	width: 100%;
	min-height: 550px;
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
    box-shadow: 3px 10px 22px -2px #fff;
    background: linear-gradient(to bottom, #003d40 5%, #007070 100%);
	/* background: url(../img/sozai/main_header_01.png); */
	background-position: bottom right;
	background-size: cover;
    background-color: #0f192b;
    border-radius: 5px;
    cursor: pointer;
    color: #ffffff;
    font-family: Arial;
    font-size: 20px;
    padding: 5px 20px;
    text-decoration: none;
    text-shadow: 0px 2px 0px #283966;
    left: 100px;
}
@media (min-width: <?php print($flex_width); ?>) {
  .headerMiniBox {
	left: calc((50% - var(--flex_width) / 2) + 110px );
	width: calc( var(--flex_width) - 300px );
  }
}
.headerMiniBoxExpLabel{
	width:70px;
	font-size: 0px;
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
.headerStone img {
	max-width: 30px;
	margin-right: 5px;
}
@media (min-width: <?php print($flex_width); ?>) {
  .headerStone {
	right: calc((50% - var(--flex_width) / 2) + 45px );
  }
}
.progress-bar {
	width: 30%;
    background-color: #fd0303;
    background-image: repeating-linear-gradient(135deg, #ffca07, transparent 7px);
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
@media (min-width: <?php print($flex_width); ?>) {
  .headerPresent {
	right: calc((50% - var(--flex_width) / 2) + 40px );
  }
}
.headerPresentIcon {
	font-size:30px;
}
.headerPresentIcon img {
	max-width: 40px;
    width: 100%;
}
.headerPresentLetter {
	text-shadow: -1px 0px 9px #01f53a;
    padding: 5px 0;
    color: #f30404;
    font-weight: bolder;
}

.headerPresentBaloonTop{
	position: fixed;
	top: 74px;
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
@media (min-width: <?php print($flex_width); ?>) {
  .headerPresentBaloonTop {
	right: calc((50% - var(--flex_width) / 2) + 61px );
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
.background-star {
    /* background: url(../img/sozai/star7.png) repeat-y; */
    background-size: 100% auto;
	padding: calc((25px - 3vw)) 0 0;
	overflow: hidden;
	position: relative;
}

.animate__animated {
	position: relative;
	animation: myanimation 10s infinite;
	z-index: 3;
}

.star_animation {
	position: absolute;
	top: 0;
	right: 0;
	width: 100%;
	z-index: 2;
	background: #fff;
	animation: myanimation 10s infinite;
}

@keyframes myanimation {
	40% {transform: scale(1.02);}
	50% {transform: scale(1.02);}
	90% {transform: scale(1);}
	/*
	92% {filter: invert(0);}
	92.5% {filter: invert(1);}
	93% {filter: invert(0);}
	95% {filter: invert(0);}
	95.5% {filter: invert(1);}
	96% {filter: invert(0);}
	97% {filter: invert(0);}
	97.5% {filter: invert(1);}
	98.5% {filter: invert(0);}
	*/
}

footer{
	display: flex;
	justify-content: space-between;
	font-size: 12px;
	/* background: #efefef; */
	z-index: 9999;
	position: fixed;
	bottom: 0;
	background: url(../img/sozai/footer_background.png) no-repeat;
	background-size: 100% 100%;
	width: 100%;
	min-height: 78px;
	/* height: calc(55px + env(safe-area-inset-bottom)); */
	line-height: 55px;
	padding-top: 17px;
	padding-left: 77px;
    padding-right: 80px;
	text-shadow: 0px 2px 0px #283966;
}

@media (min-width: <?php print($flex_width); ?>) {
  footer {
	width: var(--flex_width);
	right: calc(50% - var(--flex_width) / 2 );
  }
}
footer .btn {
	max-width: 70px;
	width: 100%;
    border: solid 2px #7cf9cb;
	border-bottom: none;
    border-radius: 10px 10px 0 0;
    padding: 8px 8px 0;
    background: #00e8ff;
    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
}

footer a{
	display: inline-block;
    color: #fff;
	font-size: 0.6rem;
    text-decoration: none;
	text-align: center;
}
a:hover {
    color: #fff;
    text-decoration: none;
}

footer i{ padding-right: 0px; font-size: 35px; }
footer .white{ color: #fff; }
footer .green{ color: #7eab55; }
footer .blue{ color: #2aa4ef; }

footer .red{ color: #d3386d; }
footer div{ line-height:13px; text-align: center; }

.firstBtn a{ padding-left: 0px; }
.endBtn a{ padding-right: 0px; }
.more_slower{ --animate-duration: 14s; }
@media (max-width: <?php print($flex_width); ?>) {
	.levelBox {
		position: fixed;
		top: -25px;
		z-index: 9999;
		text-align: center;
		box-shadow: 3px 7px 22px -2px #7cf9cb;
		background: linear-gradient(to bottom, #559191 5%, #02282b 100%);
		background-color: #234863;
		border-radius: 25px;
		border: 1px solid #00ffd2;
		display: inline-block;
		cursor: pointer;
		font-family: Arial;
		font-size: 26px;
		padding: 28px 20px;
		text-decoration: none;
		color: #ffe9ab;
		text-shadow: -1px 1px 0 #41ba45, 1px 1px 0 #c63d2b, 1px -1px 0 #42afac, -1px -1px 0 #c6c23f;
		height: 130px;
		border-width: 8px;
		min-width: 150px;
		width: 22vw;
	}
	.levelBox {
		position: fixed;
		top: -25px;
		z-index: 9999;
		text-align: center;
		box-shadow: 3px 7px 22px -2px #7cf9cb;
		background: linear-gradient(to bottom, #559191 5%, #02282b 100%);
		background-color: #234863;
		border-radius: 25px;
		border: 1px solid #00ffd2;
		display: inline-block;
		cursor: pointer;
		font-family: Arial;
		font-size: 26px;
    	padding: 28px 2vw 3vw 2vw;
		text-decoration: none;
		color: #ffe9ab;
		text-shadow: -1px 1px 0 #41ba45, 1px 1px 0 #c63d2b, 1px -1px 0 #42afac, -1px -1px 0 #c6c23f;
		height: 130px;
		border-width: 8px;
		min-width: 60px;
		width: 22vw;
		max-width: 180px;
	}
}
@media (max-width: 660px) {
	.headerBox {
		position: fixed;
		top: 0px;
		z-index: 9599;
		text-align: center;
		width: calc( 100% - 17vw );
		height: calc((10vw + 20px) / 2);
		box-shadow: 3px 7px 22px -2px #fff;
		background: linear-gradient(to bottom, #003d40 5%, #007070 100%);
		background-color: #0f192b;
		border-radius: 5px;
		color: #ffffff;
		left: 17vw;
		font-size: calc((5vw + 8px) / 2);
		max-height: 40px;
	}
	.headerBoxDegree {
		position: absolute;
		top: 0px;
		left: 10%;
		height: calc((8vw + 25px) /2);
		width: 30%;
		font-family: Arial;
		padding: 5px 2vw;
	}
	.headerBoxStaminaProgress {
		padding-top: calc((2.2vw + 1px) / 2);
	}
	.headerBoxStamina {
		position: absolute;
		display: flex;
		flex-direction: row;
		top: 0px;
		left: 42%;
		z-index: 9699;
		text-align: center;
		width: 60%;
		height: calc((8vw + 25px) /2);
		text-decoration: none;
		font-family: Arial;
		padding: 5px 2vw;
	}
	.levelBox {
		font-size: 4vw;
		max-height: 130px;
		height: calc((25vw + 110px) / 2);
		border-width: calc((2vw + 8px) / 2);
	}
	.headerBoxStaminaLabel{
		font-size: calc((2.0vw + 10px) / 2);
		line-height: 3.0vw;
	}
	.progress {
		height: calc((3.0vw + 10px) / 2);
	}
	.headerBoxStaminaValue {
		width: 60px;
		font-size: calc((2.0vw + 8px) / 2);
		line-height: 3.0vw;
	}
	.headerMiniBox {
		top: 40px;
		z-index: 9599;
		text-align: center;
		width: calc( 100% - 37vw );
		height: calc((10vw + 20px) / 2);
		box-shadow: 3px 10px 22px -2px #fff;
		font-size: calc((5vw + 8px) / 2);
		padding: 5px 2vw;
		text-decoration: none;
		text-shadow: 0px 2px 0px #283966;
		left: 11vw;
		max-height: 40px;
	}
	.headerMiniBoxExpLabel {
		width: 12vw;
		font-size: 0vw;
		padding-top: 1vw;
	}
	.headerMiniBoxExpProgress {
		padding-top: calc((2.0vw + 1px) / 2);
	}
	.headerStone {
		position: fixed;
		top: 58px;
		right: calc((6vw - 16px));
	}
	.headerPresent {
		position: fixed;
		top: 90px;
		right: calc((6vw - 20px));
	}
	.headerPresentBaloonTop {
		position: fixed;
		right: 6vw;
	}
}
@media (max-width: 650px) {
	.headerMiniBox {
		top: calc((10vw + 20px) / 2);
	}
	footer {
		padding-left: 9vw;
		padding-right: 9vw;
	}
	.fa, .fas {
		font-weight: 900;
		font-size: 5vw;
	}


}
@media (max-width: 607px) {
	.headerMiniBox {
		top: calc((10vw + 20px) / 2);
	}
	footer {
		background: url(../img/sozai/footer_background.png) no-repeat;
		background-size: 118% 100%;
		background-position: 48%;
		width: 100%;
		padding-left: 2vw;
    	padding-right: 2vw;
	}
	footer a {
		font-size: 1.6vw;
	}

}
@media (max-width: 550px) {
	footer {
		bottom: calc((-15px + 2vw));
	}
}
@media (max-width: 490px) {
	footer {
		bottom: calc((-25px + 3vw));
	}
}
@media (max-width: 400px) {
	footer {
		bottom: calc((-25px + 2vw));
	}
}
