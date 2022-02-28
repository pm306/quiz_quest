/* 主にブラウザ側を操作する処理をまとめたファイル */

/**
 * 対象をフェードインさせる
 * @param {string} args 対象のid
 */
const fadeinElements = (...args) => {
	const fadeinClassName = "fadein", fadeoutClassName = "fadeout";
	args.forEach( function(target) {
		$(target).removeClass(fadeoutClassName).addClass(fadeinClassName);    
    });
}
/**
 * 対象をフェードアウトさせる
 * @param {string} args 対象のid
 */
const fadeoutElements = (...args) => {
	const fadeinClassName = "fadein", fadeoutClassName = "fadeout";
	args.forEach( function(target) {
		$(target).removeClass(fadeinClassName).addClass(fadeoutClassName);        
    });
}

/** 画面を数秒暗転させ、現在フェーズの画像を表示する */
const fadeScreen = () => {
	const className = ".phase_start";
	const id = "#phase_start_overlay_" + currentPhase;
	$(className).find(id).addClass("is_open");

	const time = 1000;
	setTimeout(() => {
		$(className).find(id).removeClass("is_open");		
	}, time);
}

/** ジャンル名を取得して画面に表示する */
const setGenreName = async () => {
	for(let i=1; i<=4; i++){
		const genreSymbol = $(`#quiz_${i}`).attr("data-genre");
		//console.log(genreSymbol);
		$(`#genre_text_${i}`).text(genreNames.get(genreSymbol));
	}	
}

/** 
 * ジャンルボタンにランダムでアイコンを割り振る
 */
const setGenreBoxIcon = () =>{
	const genreIcons = $(".genre_boxes").find("img" + "[class*=color_icon]");

	for(const icon of genreIcons){
		let iconColor = "";
		const rand = getRandomArbitrary(0, 100);
		if(rand<20)iconColor = "blue";
		else if(rand<40)iconColor = "red";
		else if(rand<60)iconColor = "yellow";
		else if(rand<70)iconColor = "blue_red";
		else if(rand<80)iconColor = "red_yellow";
		else if(rand<90)iconColor = "yellow_blue";
		else iconColor = "blue_red_yellow";
	
		const path = "/img/jewel-s/processed/color_icon/" + iconColor +".png";
		$(icon).attr("src", path).parent().attr("data-icon_color", iconColor);
	}
}

/**
 * ジャンル選択時のイベントを実装する。    
 * HTMLに埋め込んだidから実際のクイズデータを読み込む
 */
const setGenreClickEvent = async () => {
	const moodalId = "#question_moodal";

	for(let id=1; id<=4; id++){
		$(`#genre_box_${id}`).on("click", async () => {
			// クイズidをHTMLから取得する 
			const qid = $(`#quiz_${id}`).attr("data-qid");

			await loadQuizData(qid);			
			// クイズの読み込みが終わったらHTMLを消去する 
			$(".set_pre_quizdata").children().remove();

			genreBoxNumber = id;
			
			setAnswerBoxEvent();

			$(moodalId).modal(
				{
					keyboard: false
				}				
			);
			moveQuizBar();				
		});		
	}
}

/** 
 *クイズのデータ処理のために、回答ボタンにイベントを設置する。ラムダ式を使わない理由はthisを使っているため。
 */ 
const setAnswerBoxEvent = () => {
	$(".answer_box").on("click", function(){
		 /* 正解の場合 */ 
		//if($(this).attr('data-answer_number') == $("#answer_top").attr("data-answer_right")){
		if(true){ //デバッグ用 必ず正解
			// 正解情報の送信(オフ) 
			sendQuizRecord(true);

			 // 「まる」を表示 *
			showMaruBatsu(true, this);
			
			showAnswerAnimation(true);		

			afterQuizEvent();
		}
		 // 不正解の場合  
		else{
			// 不正解情報の送信 
			if(countWrongAnswer()==0){
				sendQuizRecord(false);
			}
			 // 「バツ」を表示 *
			showMaruBatsu(false, this);

			 // 不正解エフェクトを表示 
			showAnswerAnimation(false,1000);

			// 3回誤答したら回答権を失う 
			if(countWrongAnswer()>= 3){
				showAnswerAnimation(false);

				showRestAnswers();	

				afterQuizEvent();
			}
		}
	}
	);
}

/**
 * 誤答した問題にチェックを入れ、「まる」「バツ」を表示する
 */
const showMaruBatsu = (isMaru, boxId) => {
	if(!isMaru){
		$(boxId).addClass("answer_ng");
	}
	const path = isMaru ? "maru" : "batsu";
	const maruBatsuImg = $("<img class='answer_maru_batsu animate__animated animate__flip animate__faster animate__repeat-1' src='./img/sozai/answer_" + path + ".png'>");
	$(boxId).append(maruBatsuImg);
}

/**
 * 正解／不正解のアニメーションを動かす
 * @param {string} idCorrect 正答しかたどうか
 * @param {number} time アニメーションの表示時間
 */
const showAnswerAnimation = (isCorrect,time=1500) => {
	const barId = "#answer_time";
	const ngCount = countWrongAnswer();

	if(isCorrect || ngCount >= 3){
		// 正解する、または3回誤答したらプログレスバーをストップ 
		$(barId).attr("data-progress_on","0");
	}
	// 正解ランクの判定 
	const answerRank = (() => {
		if(!isCorrect){ return "ng";}
		else if(ngCount == 0){
			if($(barId).val() > 70){ return "perfect"; }
			else { return "great"; }
		} else if(ngCount == 1){ return "nice"; }
		else { return "ok"; }
	})();

	// 正解ランクを一時的に記録 
	$(".set_tmp_data").attr("data-rank", answerRank);

	// アニメーションを表示する 
	const i = rankIndex.get(answerRank);
	$(`#answer_check_overlay_${i}`).css({'display': 'block','z-index': 99999999});
	setTimeout(()=>{$(`#answer_check_overlay_${i}`).css({'display': 'none','z-index': -1});}, time);
}

 /**
  *  回答画面のプログレスバーの進捗を管理する
  */
 const moveQuizBar = async () => {
	const barId = "#answer_time";
	if ($(barId).val() > 0 && $(barId).attr("data-progress_on") == "1") {
		$(barId).val($(barId).val() - 1);
		//await wait(100);
		await wait(30);
		moveQuizBar();
	}
	// 時間切れ 
	else if($(barId).val() <= 0){
		if(countWrongAnswer()==0){
			sendQuizRecord(false);
		}
		 // 不正解を表示 *
		showAnswerAnimation(false);

		showRestAnswers(); 
		
		afterQuizEvent();
	}
}

/** 
 *  選んでいない選択肢の正解／不正解を画面表示する。時間切れ、または3回誤答した場合に呼び出す。
 */
const showRestAnswers =() => {
	$(".answer_box").each(function(){
		$(this).addClass("answer_end");
		if($(this).attr('data-answer_number') == $("#answer_top").attr("data-answer_right")){
			const maru_img = $("<img class='answer_maru_batsu animate__animated animate__flip animate__faster animate__repeat-1' src='./img/sozai/answer_maru.png'>");
			$(this).append(maru_img);
		}
		else{
			const batsu_img = $("<img class='answer_maru_batsu animate__animated animate__flip animate__faster animate__repeat-1' src='./img/sozai/answer_batsu.png'>");
			$(this).append(batsu_img);
		}
	});
}

/** 
 * クイズ結果を表示するために数秒待ってからウインドウを閉じる
 */ 
const hideAnswerWindow = async () => {
	/* 問題ボタン・回答ボタンのイベントを削除する */
	$(".answer_box").off();
	$(".genre_box").off();

	await wait(2500);

	// ジャンルテキストとアイコンを消す 
	const path = "/img/jewel-s/processed/color_icon/touka.png";
	$(".genre_boxes .color_icon").attr("src",path);
	$(".genre_boxes span").text("");

	$("#question_moodal").modal("hide");
	return;	
}

/**
 * HPが0になった敵を画面からフェードアウトさせる。
 */
const disappearEnemy = async () => {
    for(enemy of enemies){
        if(!enemy.isAlive() && $(enemy.imgId).css("opacity")!=0){
            setParticle(enemy, DAMAGE_PARTICLE.DISAPPEAR,300);   
            $(enemy.imgId).addClass("rotate_animation");
            fadeoutElements(enemy.imgId, enemy.hpBarId);
        }
	}
	// 適当なタイミングでクラスを消す 
	const time = 1500;
    await new Promise(resolve => {
        setTimeout(() => {
            for(enemy of enemies){
                $(enemy.imgId).removeClass("rotate_animation");
            }
            resolve();
        }, time);       
    });                
	return;
}

/**
 * 敵か味方の画像上にパーティクルを表示する
 * @param {string} target 表示する対象のid　※img画像以外が指定された場合の処理は未実装
 * @param {string} effectName エフェクトの名前
 * @param {number} startFadeTime フェードアウトするまでのタイムラグ
 */
const setParticle = async (target, effectName, startFadeTime) =>{
	// canvasId: パーティクルを発生させる対象 class:CSSを適用するためのクラス名 
	const canvasId = `${target.side}_particle_${target.index}`;
	const canvas = $("<canvas>",{class:canvasId.slice(0, -2), id:canvasId});

	$(target.id).append(canvas);
	const stage = new createjs.Stage(canvasId);
	const particleSystem = new particlejs.ParticleSystem();
	stage.addChild(particleSystem.container);
	particleSystem.importFromJson(effectName);
	createjs.Ticker.framerate = 30;
	createjs.Ticker.timingMode = createjs.Ticker.RAF;
	createjs.Ticker.addEventListener("tick", ()=>{particleSystem.update();stage.update();});

	// 数秒後にパーティクルを消す 
	const fadeTime = 500;
	setTimeout("$("+canvasId+").fadeOut("+fadeTime+")",startFadeTime);
	setTimeout("$("+canvasId+").remove()",startFadeTime+fadeTime);  
	// パーティクルの表示回数が増えると重くなるので、stageをクリアする 
	await new Promise(resolve => {
		setTimeout(()=>{
			createjs.Ticker.removeEventListener("tick", stage);
			stage.removeAllChildren();
			stage.clear();
			resolve();
		}, startFadeTime+fadeTime);
	});

	return;
}



	


