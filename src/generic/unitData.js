import {getRd, to3Digit} from './other.js';

const MY_UNIT_NUMBER = 54;

//手持ちキャラの疑似データ

class myUnitData{
    constructor(objectId, imgNumber, level, attack, hp, partyIndex=null){
        this.objectId = objectId; //識別キー
        this.imgNumber = imgNumber; //画像番号(3桁)
        this.level = level;
        this.maxLevel = 80;
        this.attack = attack;
        this.hp = hp;
        this.partyIndex = partyIndex; //パーティ加入時はインデックスを、非加入時はnullを格納
    }
}

const myUnitDataBase = new Map([]);
//ソートされた手持ちキャラ(のオブジェクトID)
const sortedMyUnitId = new Array();
//キャラデータを疑似的に作成＆ソートする
for(let i=0; i<MY_UNIT_NUMBER; i++){
    const myUnit = new myUnitData(i*7,to3Digit(getRd(1,370)),60-i, getRd(500,2500), getRd(500, 2500));
    myUnitDataBase[myUnit.objectId] = myUnit;
    if(i<5)myUnitDataBase[myUnit.objectId].partyIndex = i; //先頭5人をパーティに入れる
    sortedMyUnitId.push(myUnit.objectId);
}

//パーティに入っているキャラデータを返す(条件付き検索もどき)
const getPartyInUnits = () => {
    const unitList = new Array(5);
    for(let i=0; i<MY_UNIT_NUMBER; i++){
        const myUnit = myUnitDataBase[sortedMyUnitId[i]];
        if(myUnit.partyIndex !== null){
            unitList[myUnit.partyIndex] = myUnit;
        }
    }
    return unitList;
}

export {myUnitDataBase, sortedMyUnitId,MY_UNIT_NUMBER as myUnitNumber,
        getPartyInUnits}
