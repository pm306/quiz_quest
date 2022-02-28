import * as slMyUnit from './selector.js';
import {roundUp} from '../other.js';

import {myUnitDataBase, sortedMyUnitId, myUnitNumber} from '../unitData.js';

const MY_UNIT_NUMBER = myUnitNumber; //手持ちキャラ数　読み込むたびに変わる
const ELEMENT_NUMBER = 10; //素材欄の数 基本的には固定

//変数や配列など、変更可能性のあるデータは直接exportせず、関数を噛ませて操作する。
//後から機能を拡張しやすくするため

//素材欄の位置ごとにキャラの識別キーを格納する。nullは空であることを示す
const elementObjectId = new Array(ELEMENT_NUMBER).fill(null);
const setObjectIdInElements = (id, objectId) => {
    elementObjectId[id] = objectId;
}
const getObjectIdInElements = (id) => {
    return elementObjectId[id];
}
const clearObjectIdInElements = () => {
    elementObjectId.fill(null);
}
/**
 * 素材欄から特定の識別キーを1つ消去する
 * @param {number} deleteObjectId 消したい識別キー
 * @return {number} 消した画像のインデックス 消す対象がなければ-1を返す  */
const deleteObjectIdInElements = (deleteObjectId) => {
    for(let i=0; i<ELEMENT_NUMBER; i++){
        if(elementObjectId[i] === deleteObjectId){
            elementObjectId[i] = null;
            return i;
        }
    }
    return -1;
}
//手持ちキャラの位置ごとに識別キーを格納する。nullは空であることを示す
const myUnitObjectId = new Array(MY_UNIT_NUMBER).fill(null);
const setObjectIdInMyUnits = (id, objectId) => {
    myUnitObjectId[id] = objectId;
}
const getObjectIdInMyUnits = (id) => {
    return myUnitObjectId[id];
}
//識別キーからインデックスを検索する
const getIndexInMyUnits = (objectId) => {
    return myUnitObjectId.indexOf(objectId);
}

//強化(レベルアップ、上限解放)するキャラの識別キー。未選択時はnull
let trainUnitObjectId = null;
let trainUnitIndex = null;
const setObjectIdAtTrainUnit = (objectId) => {
    trainUnitObjectId = objectId;
}
const getObjectIdAtTrainUnit = () => {
    return trainUnitObjectId;
}
const setIndexAtTrainUnit = (id) => {
    trainUnitIndex = id;
}
const getIndexAtTrainUnit = () => {
    return trainUnitIndex;
}

//パーティ画像の表示/非表示
const showPartyInImg = (id) => {
    $(slMyUnit.partyFlagImgClass).eq(id).css("display", "block");
}
const hideParyInImg = (id) => {
    $(slMyUnit.partyFlagImgClass).eq(id).css("display", "none");
}

/**
 * 動的に手持ちキャラのHTMLを生成する
 * 12のカラムを、5キャラ*2カラム + 左右の空白1カラムずつ に分割する
 */
const createMyUnitHTML = () => {
    const row = roundUp(MY_UNIT_NUMBER, 5);//行数 手持ちキャラ数を5で割ったもの(端数切り上げ)

    const appendClass = ".my_units";
    const offset = `<div class="offset-1"></div>`;
    const myUnitColumn = `
    <div class="col-2 my_unit">
        <img class="my_unit_img" src="/img/sozai/touka_icon.png">
        <img class="party_in_img" src="/img/sozai/party_in.png">
        <img class="element_flag_img" src="/img/sozai/select_element.png">
        <span class="my_unit_level"></span>
    </div>
    `;
    for(let i=0; i<row; i++){
        $(appendClass).append(offset);
        for(let j=0; j<5; j++){
            $(appendClass).append(myUnitColumn);
        }
        $(appendClass).append(offset);
    }
}

/**
 * 手持ちキャラクターを表示する
 */
const showMyUnit = () => {
    //キャラデータの読み込み
    for(let i=0; i<MY_UNIT_NUMBER; i++){
        //ソート済みの配列から識別キーを取得して記録
        const objectId = sortedMyUnitId[i];
        myUnitObjectId[i] = objectId;

        const myUnit = myUnitDataBase[objectId];
        const src = "/img/jewel-s/image/icon/f" + myUnit.imgNumber + ".png";

        $(slMyUnit.myUnitImgClass).eq(i).attr("src", src);
        $(slMyUnit.myUnitLevelClass).eq(i).text(`Lv${myUnit.level}`);

        //パーティに入っているキャラだったらpartyの文字を表示する。
        //null(パーティに入っていない)の場合は何もしない
        if(myUnitDataBase[objectId].partyIndex !== null){
            showPartyInImg(i);
        }
    }
}

export {
        MY_UNIT_NUMBER, ELEMENT_NUMBER,
        createMyUnitHTML,
        showMyUnit, showPartyInImg, hideParyInImg,
        setObjectIdInElements, getObjectIdInElements, clearObjectIdInElements,deleteObjectIdInElements,
        setObjectIdInMyUnits, getObjectIdInMyUnits,getIndexInMyUnits,
        setObjectIdAtTrainUnit, getObjectIdAtTrainUnit,
        setIndexAtTrainUnit, getIndexAtTrainUnit,
        myUnitDataBase,
        }
