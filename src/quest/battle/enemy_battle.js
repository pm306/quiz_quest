/** 
 * 敵ターンの処理
 */
const enemyTurnEvent = async () => {
	await wait(500)
	.then( async () => {
		return emphasizeEnemyImage(); //TODO:rowの仕様を変えたらバグったので一時停止
	}).then( async () => {
		await attackEnemies();
		return;
	})
}

/** 攻撃する敵にエフェクトをかける */
const emphasizeEnemyImage = async () =>{
	
    for(enemy of enemies){
        if(enemy.isAlive()){
			$(enemy.imgId).addClass("img_emphasize");
        }
	}	

    const effectTime = 1000; 
    await new Promise(resolve => {
        setTimeout(() => {
            for(enemy of enemies){
				$(enemy.imgId).addClass("img_emphasize");
            }
            resolve();
        }, effectTime);         
    });

	return;
}

/**
 * 敵が攻撃する(仮)
 */
// # TODO: 本格的な実装は後で行う
const attackEnemies = async () => {
    for(enemy of enemies){
        if(!enemy.isAlive())continue;
		
		const damage = enemy.calcAttackDamage();
		const target = getRandomArbitrary(0,5);
        if(heros[target].isAlive()){
            heros[target].decreaseHp(damage, 15);
            setParticle(heros[target], DAMAGE_PARTICLE.THUNDER, 1000);
        }
    }
    await wait(2500);
    return;
}