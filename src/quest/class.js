/* クラスまとめたファイル */

/**
 * 味方と敵に継承するための抽象クラス
 * @abstract 
 * @constructor
 * @param {number} index 左から何番目のキャラか
 * @param {number} hp 最大HP = 初期HP
 * @param {number} attack 攻撃力
 * @param {string} sidename 味方なら"hero", 敵なら"enemy"
 */
class QuestUnit{
    constructor(index, hp, attack, sidename){
        /* インデックス(左から何番目か) */
        this.index = index;
        /** 最大HP */
        this.maxHp = hp; 
        /** 現在のHP */
        this.curHp = hp;
        /** 攻撃力 */
        this.attack = attack;
        /* 味方か敵か */
        this.side = sidename;
        /** ボックスタグのid */
        this.id = `#${sidename}_box_${index}`;
        /** キャラアイコンのid */
        this.imgId = `#${sidename}_img_${index}`;
        /** HPバーのid */
        this.hpBarId = `#${sidename}_hp_${index}`;
        //console.log(JSON.stringify(this));
    }
    /**
     * 攻撃時の与ダメージを計算する
     */
    calcAttackDamage(genreColor, answerLank){
        let damage = this.attack;
        // 正解ランクによってダメージ倍率が変わる 
        damage *= answerLank / 100;
        // 色があっていればダメージボーナス 
        const bonus = 150 / 100;
        if(genreColor.indexOf(this.color) != -1){
            damage *= bonus;
        }
        return Math.floor(damage);    
    }

    /**
     * 現在HPを減らして、HPバーに反映する
     * @param {number} damage 受けるダメージ
     * @param {number} interval HPバーが減る間隔
     */
    async decreaseHp(damage,interval){  
        /* HPを減らす */
        this.curHp = Math.max(this.curHp - damage, 0);

        // 残ったHPの割合を求める。端数切り上げ 
        const afterHpPercentage = Math.floor((this.curHp*100 + this.maxHp - 1) / this.maxHp);
        // バーを一定間隔で1ずつ減らす 
        for(let i= $(this.hpBarId).val(); i>afterHpPercentage; i--){
            await new Promise(resolve => {
                setTimeout(() => {
                    $(this.hpBarId).val($(this.hpBarId).val() - 1);
                    resolve();
                }, interval);
            });
        }
        return;
    }

    /**
     * 自身が生きているかどうかを返す
     * @return {boolean} true:生存 false:死亡
     */
    isAlive() { return this.curHp > 0 ? true : false; }
}

/**
 * 味方キャラクターを表すクラス
 * @constructor
 * @extends QuestUnit
 * @param {string} color 属性色
 */
class Hero extends QuestUnit{
    constructor(index, hp, attack, color, sidename="hero"){
        super(index, hp, attack, sidename);
        /** 属性色 */
        this.color = color;
    }

    async decreaseHp(damage, interval){
        await super.decreaseHp(damage,interval);
        // 死んだらアイコンを暗くする 
        if(!this.isAlive()){
            //console.log(this.curHp);
            setTimeout(() => {
                $(this.id).addClass("darken");
            }, timeout+300);            
        }
    }
}

/**
 * 敵キャラクターを表すクラス
 * @constructor
 * @extends QuestUnit
 */
class Enemy extends QuestUnit{
    constructor(index,hp=100,attack=30, sidename="enemy"){
        super(index, hp, attack, sidename);
        // HPバーの初期化 
        $(this.hpBarId).val(100);
    }
    
    calcAttackDamage(){
        return this.attack;
    }
}