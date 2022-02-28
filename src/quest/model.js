/* 表に見えない操作や、サーバーとのやりとりをまとめたファイル */

/**
 * 味方を作り出して、配列に格納する
 * @param {number} heroNumber 味方の数
 */
const createHeros = (heroNumber=5) => {
	heros.length = 0;
	const colors = ["blue", "red", "yellow", "yellow", "blue"];
	for(let index=1; index<=heroNumber; index++){
		const hero = new Hero(index,100,80,colors[index-1]);
		heros.push(hero);
		
		// HPバーの色を決める 
		$(hero.hpBarId).addClass(`${colors[index-1]}_bar`);
	}
}
/**
 * 新しく敵を作り出して、配列に格納する
 * @param {number} enemyNumber 敵の数
 */
const createEnemies = (enemyNumber=getRandomArbitrary(1,4)) =>{
	enemies.length = 0;

	for(let index=1; index<=enemyNumber; index++){
		const enemy = new Enemy(index);
		enemies.push(enemy);

		$(enemy.hpBarId).addClass(`green_bar`);
	}

	//敵の数に応じたレイアウト調整 TODO:関数の細分化、リファクタ
	const tmp = "#enemy_box_";
	$(tmp + 1).removeClass("offset-4 offset-2");

	if(enemyNumber == 1){ 
		$(tmp + 1).addClass("offset-4");
		$(tmp + 2).css("display", "none");
		$(tmp + 3).css("display", "none");		
	}

	if(enemyNumber == 2){
		$(tmp + 1).addClass("offset-2");
		$(tmp + 3).css("display", "none");			
	}

	// 敵キャラの画像をランダムに更新する 
	for(enemy of enemies){
		const enemy_new_img = "/img/jewel-s/image/character/f" + ('000' + getRandomArbitrary(1,371)).slice(-3) + ".png";
		$(enemy.imgId).attr("src", enemy_new_img);
		$(enemy.id).css("display", "block");
	}
}

/**
 * 問題選択前に最低限の情報だけを読み込んでHTMLに埋め込む
 */
const preLoadQuizData = async () => {
	const quizNumber = 4;
	const idArray = Array(quizNumber);
	const set = new Set([]); //既に選んだ問題idを記録
	
	// 問題idをランダムに4つ取得する 
	for(let i=0; i<quizNumber; i++){
		while(true){
			const rand = getRandomArbitrary(1,721);
			// 重複していなければ採用 
			if(!set.has(rand)){
				idArray[i] = rand;
				set.add(rand);
				break;
			}
		}
	}
	// 選んだ問題のid, ジャンル, 正答率を取得してHTMLに埋め込む。正答率は未実装 
	await new Promise(resolve => {
		$(".set_pre_quizdata").load("/call/get_questionId.php?qid_1="+ idArray[0] +"&qid_2="+ 
		idArray[1] +"&qid_3="+ idArray[2] +"&qid_4="+idArray[3], ()=>{
			resolve();
		});
	});
	return;
}

/** 
 * クイズデータを1件読み込む    
 * Promise内で呼ぶ作りになっているが、第二引数を指定しなければ普通の関数として振る舞う。
 * @param {number} qid 読み込むクイズデータの主キー番号
 * @param {function} resolve =Promise.resolve():Promiseの状態を「成功」にする関数
 */

const loadQuizData = async (qid)=> {
	await new Promise(resolve => {
		const moodalId = "#question_moodal";
		$(moodalId).load("/call/get_question.php?qid="+ qid, ()=>{
			resolve();
		});
	});
	return;
}

/**
 *  現在の誤答数を返す
 * @return {number} 誤答数
 */
const countWrongAnswer = () => {
	let ngCount = 0;
		$(".answer_box").each(function(){
		$(this).addClass("answer_end");
		if($(this).hasClass("answer_ng")){
			ngCount++;
		}
	});
	return ngCount;
}

/**
 * 正解／不正解の情報をサーバーに送信する(停止中)
 * @param {number} isCorrect 正解したかどうか
 */
const sendQuizRecord = (isCorrect) => {
	const qid = $("#modal_dialog").attr("data-qid");
	const correct = isCorrect ? 1 : 0;
	//console.log("qid: " + qid + " cor: " + correct);
	//$.get("/call/update_question_answer.php?qid="+ qid +"&correct=" + correct);
}

/** 生きている敵の数を数える
 *	@return {number} 生存している数
 */ 
const countAliveEnemy = () => {	
	let aliveCount = 0;
	for(enemy of enemies){
		if(enemy.isAlive())aliveCount++;
	}
	return aliveCount;
}

/**
 * min以上、max未満の乱数（整数値）を作る
 * @param {number} min 最小値 
 * @param {number} max 最大値 + 1
 * @return {number} 乱数
 */
const getRandomArbitrary = (min, max) => {
    return Math.floor(Math.random() * (max - min) + min);
}

