<?php
require_once("config.php");

?>


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
.likeBox a{ right: 16px; top:40px; }
.followBox a{ right: 16px; top:72px; }
.homeBox a{ right: 16px; top:104px; }

#creator_twicon{ border-radius:50% 50% 50% 50%; }
.user_twicon{ max-width:24px; max-height:24px; border-radius:50% 50% 50% 50%; }

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
<div class="likeBox"><a href="/list_like.php"><i class="far fa-heart"></i></a></div>
<div class="followBox"><a href="/list_follow.php"><i class="fas fa-check"></i></a></div>
<div class="homeBox"><a href="/"><i class="fas fa-home"></i></a></div>

</header>

