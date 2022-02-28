 /** 
  * 味方ターンの処理
  */
 const heroTurnEvent = async () => {	
 
	await emphasizeHeroIcon() 
	.then( async () => {
		return attackHeros();
	})
	.then( async () => {
		await wait(2000);
		return disappearEnemy();
	}).then( async () => {
		//選んだ問題のフラグを外す
		$(".genre_box").attr("data-is_select", "");
		return;
	});

	return;
}

/**
 * 問題ジャンルの色と同色の味方キャラにエフェクトをかける
 */
const emphasizeHeroIcon = async () =>{
    const genreColor = $(`#genre_box_${genreBoxNumber}`).attr("data-icon_color");

    for(hero of heros){
        if(hero.isAlive() && genreColor.indexOf(hero.color) != -1){
			$(hero.imgId).addClass("img_emphasize");
        }
    }

    const effectTime = 1000; 
    await new Promise(resolve => {
        setTimeout(() => {
            for(hero of heros){
				$(hero.imgId).removeClass("img_emphasize");
            }
            resolve();
        }, effectTime);         
    });

	return;
}

/**
 * 味方が攻撃する(仮)
 */
// # TODO: 本格的な実装は後で行う
const attackHeros = async () =>{

    const genreColor = $(`#genre_box_${genreBoxNumber}`).attr("data-icon_color");

    const answerLank = $(".set_tmp_data").attr("data-rank");
    /** 正解ランクによるダメージ倍率の補正 */
    const magnification = new Map([["perfect",100], ["great",80], ["nice",60], ["ok",40]]);

    await new Promise(resolve => {
        for(hero of heros){
			if(!hero.isAlive()) continue;
			const damage = hero.calcAttackDamage(genreColor, magnification.get(answerLank));
            for(enemy of enemies){
                if(enemy.isAlive()){
                    enemy.decreaseHp(damage,8);
                    setParticle(enemy, effectPattern.get(hero.color),1000);                       
                    break;
                }
			}		
        }
        resolve();
    });
    return;
}




