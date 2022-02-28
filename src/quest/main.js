/* 変数ここから */

/** 現在のフェーズ,最終フェーズ */
let currentPhase = 1;
const lastPhase = 3;

/** 選択した問題ジャンルのボックス番号 */
let genreBoxNumber = -1;

/** 連想配列 key:ジャンルのアルファベット value:ジャンル名 */
const genreNames = new Map([["T","テクノロジ系"], ["M","マネジメント系"], ["S","ストラテジ系"]]);
/** 連想配列 key:色の名前 value:パーティクルの名前 */
const effectPattern = new Map([["red",DAMAGE_PARTICLE.FIRE], ["blue",DAMAGE_PARTICLE.ICE], ["yellow",DAMAGE_PARTICLE.THUNDER]]);
/** 連想配列 key:正解ランク value:インデックス */
const rankIndex = new Map([["perfect",1],["great",2],["nice",3],["ok",4],["ng",5]]);
/** 敵オブジェクトを格納する配列 */
const enemies = [];
/** 味方オブジェクトを格納する配列 */
const heros = [];

/** 一定時間処理を停止する(async構文を使った関数内のみ有効) */
const wait = (msec) => new Promise(resolve => setTimeout(() => resolve(), msec));

/* 変数ここまで */
$(()=>{
	beginQuest();
});

/**  クエスト開始に伴う処理 */
const beginQuest = () => {
	createHeros();

	beginNewPhase(1000);
}

/**
 * フェーズ開始に伴う処理
 * @param {number} beginFadeout 暗転が始まるまでのタイムラグ
 */
const beginNewPhase = async (beginFadeout=0) => {

	createEnemies();

	await wait(beginFadeout);
	fadeScreen();

	await wait(2000);
	for(enemy of enemies){
		fadeinElements(enemy.imgId, enemy.hpBarId);
	}

	beginNewTurn();
}

/**
 * ターン開始に伴う処理
 */
const beginNewTurn = () => {

	preLoadQuizData()
	.then(() => {
		setGenreBoxIcon();
		setGenreName();

		setGenreClickEvent();
	});
}

/**
 * クイズ終了時に伴う一連の処理
 */
const afterQuizEvent = async () => {

	await hideAnswerWindow();

	battleEvent();
}

/**  バトル処理  味方→敵、の順番でターンを交代する */
const battleEvent = async () => {

	const correctRank = $(".set_tmp_data").attr("data-rank");
	if(correctRank != "ng"){
		await heroTurnEvent();
	}

	if(countAliveEnemy() > 0){
		await enemyTurnEvent();
	}

	if(countAliveEnemy() > 0){
		beginNewTurn();
	}else{
		currentPhase++;
		if(currentPhase > lastPhase){
			// ステージクリア画像を表示する
			await wait(1000);
			$(".stage_clear_img").css({'display': 'block'});
		}else{
			beginNewPhase(1000);
		}
	}
}




