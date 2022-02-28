<?php
require_once("config.php");
// セッション変数を全て解除する
$_SESSION = array();

// セッションを切断するにはセッションクッキーも削除する。
// Note: セッション情報だけでなくセッションを破壊する。
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// 最終的に、セッションを破壊する
@session_destroy();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8" />
	<title>ログアウト</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
					<div>
						ログアウトしました。トップページへ移動します。<br>
						<a href="/">自動で移動しない場合はこちらをクリックして下さい</a>
					</div>
					<script>
						setTimeout(function(){
							window.location.href = "/";
						}, 1000);
					</script>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>