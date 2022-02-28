import * as slMyParty from '../generic/myParty/selector.js';
import * as fMyParty from '../generic/myParty/function.js';
import * as slMyUnit from '../generic/myUnit/selector.js';
import * as fMyUnit from '../generic/myUnit/function.js';

import {myUnitDataBase} from '../generic/unitData.js';
import {getIconPath, getPathInSozai} from '../generic/other.js';

$(()=>{
    fMyParty.createPartyHTML();
    fMyParty.setPartyData();

    fMyUnit.createMyUnitHTML();
    fMyUnit.showMyUnit();

    setClickEvent();
});

/**
 * クリックイベントを設置する
 */
const setClickEvent = () => {

   $(slMyParty.imgClass).on('click', function() {
        onClickPartyUnit($(slMyParty.imgClass).index(this));
    });

    $('.confirm_button').on("click", () => {
        if(getEmptyIndexInParty() === -1){
            location.href = './unit.php';
        }
    });

    $(slMyUnit.myUnitImgClass).on('click', function() {
        onClickMyUnit($(slMyUnit.myUnitImgClass).index(this));
    });
}

/**
 * パーティキャラ画像のクリックイベント
 * 該当キャラをパーティから外す
 * @param {number} index クリックしたキャラのインデックス
 */
const onClickPartyUnit = (index) => {
    //表示を空にする
    updatePartyStatus(index);

    //手持ちキャラのパーティフラグ画像を外す
    const objectId = fMyParty.getObjectIdInPartyUnit(index);
    const myUnitIndex = fMyUnit.getIndexInMyUnits(objectId);
    fMyUnit.hideParyInImg(myUnitIndex);

    //識別キーを初期化する
    fMyParty.setObjectIdInPartyUnit(index, null);
}

/**
 * 手持ちキャラのクリックイベント
 * パーティに空きがあれば加入させる
 * @param {number} index クリックしたキャラのインデックス
 */
const onClickMyUnit = (index) => {
    const emptyIndex = getEmptyIndexInParty();
    if(emptyIndex == -1)return; //空きがない

    const objectId = fMyUnit.getObjectIdInMyUnits(index);
    //空きスペースの識別キーを更新する
    fMyParty.setObjectIdInPartyUnit(emptyIndex, objectId);
    //表示に必要なキャラデータを引っ張ってくる
    const myUnit = myUnitDataBase[objectId];

    updatePartyStatus(emptyIndex, myUnit);
    //パーティフラグ画像を表示する
    fMyUnit.showPartyInImg(index);
}

/**
 * 
 */
const getEmptyIndexInParty = () => {
    for(let i=0; i<fMyParty.PARTY_NUMBER; i++){
        if (fMyParty.getObjectIdInPartyUnit(i) === null){
            return i;
        }
    }
    return -1;
}

/**
 * パーティキャラの表示情報を更新する
 * 第二引数を指定しなかった場合、その位置を空き状態にする
 * @param {number} index 更新する位置
 * @param {object} myUint 更新するキャラのデータ
*/
const updatePartyStatus = (index, myUnit=null) => {
    let imgNumber, level, attack, hp, imgUrl;
    if(myUnit !== null){
        [imgNumber,level, attack, hp] =
        [myUnit.imgNumber,myUnit.level, myUnit.attack, myUnit.hp];
        imgUrl = getIconPath(imgNumber);
    }
    else{
        [imgNumber,level, attack, hp] =
        [null, "-","-","-"];
        imgUrl = getPathInSozai("touka_icon");
    }
    $(slMyParty.imgClass).eq(index).attr("src", imgUrl);
    $(slMyParty.levelClass).eq(index).text(level);
    $(slMyParty.attackClass).eq(index).text(attack);
    $(slMyParty.hpClass).eq(index).text(hp);
}
