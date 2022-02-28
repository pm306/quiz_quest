import * as fMyUnit from '../generic/myUnit/function.js';
import * as slMyUnit from '../generic/myUnit/selector.js';
import {getRd, getIconPath,getPathInSozai} from '../generic/other.js';


$(()=>{
    fMyUnit.createMyUnitHTML();

    fMyUnit.showMyUnit();

    setClickEvent();
});

/**
 * クリックイベントを設置する
 */
const setClickEvent = () => {
    onClickLevelUpBox();

    onClickLevelUpButton();

    onClickMyUnit();

    onClickElementFlagImg();
}

const levelUpUnitClass = ".level_up_unit"; //強化キャラ全体
const levelUpImgClass = ".level_up_icon img"; //強化キャラの画像
const elementImgClass = ".element_img"; //素材にするキャラの画像

const selectedModeImgName = "selected_levelup_icon";
const initialUnitImgName = "empty_levelup_icon";

const status_div = ".status_value div";

/**
 * 左上のでかい四角のクリックイベント
 * 左上のアイコンを押すと選択状態になり、強化したいキャラを選べるようになる。もう一度押すと元に戻る
 * 強化キャラが選ばれている状態で押すと空になる
 */
const onClickLevelUpBox = () => {
    $(levelUpImgClass).on('click', () => {
        //　既にキャラがセットされている -> 状態を初期化する
        if(isSetFlag()){
            clearStatus();
        }
        // セットされていない -> 選択状態と非選択状態を切り替える
        else{
            if(isSelectFlag())turnOffSelectFlag();
            else turnOnSelectFlag();
        }
    });
}

/**
 * 強化ボタンのクリックイベント（仮: 初期化するだけ）
 */
const onClickLevelUpButton = () => {
    $(".level_up_button").on('click', () => {
        clearStatus();
    });
}

/**
 * 手持ちキャラクターのクリックイベント
 *・強化キャラに選択する
 *・素材に選択する
 * の2パターンある
 *
 * 画像そのものをクリックする場合と、上にかぶさっているpartyin画像をクリックする場合がある。
 * 後者の場合は素材に選べない。
 */
const onClickMyUnit = () => {
    $(`${slMyUnit.myUnitImgClass}, ${slMyUnit.partyFlagImgClass}`).on('click',function () {
        const imgTag = (() => {
            //パーティ画像がクリックされた場合、操作対象のタグをキャラ画像に置き換える
            if($(this).hasClass(slMyUnit.partyFlagImgClass.slice(1))){
                return $(this).siblings(slMyUnit.myUnitImgClass); //兄弟要素からキャラ画像のタグを引っ張って来る
            //キャラ画像がクリックされた場合はそのまま
            }else{
                return this;
            }
        })();

        //クリックしたキャラの識別キーを取得
        const index = $(slMyUnit.myUnitImgClass).index(imgTag);
        const thisObjectId = fMyUnit.getObjectIdInMyUnits(index);

        //強化対象のキャラなら何もしない
        if(thisObjectId === fMyUnit.getObjectIdAtTrainUnit()){
            return;
        }　

        //強化対象が選択済で、パーティに入っていない(クリックされた画像がキャラ画像である)なら素材にする。
        if(isSetFlag()){
            if(this === imgTag) setElementMyUnit(index, thisObjectId);
        }
        //強化対象が未選択で、選択状態ならそのキャラを強化キャラとする
        else if(!isSetFlag() && isSelectFlag()){
            setLevelUpUnit(index, thisObjectId);
        }
        //強化対象が未選択で、非選択状態なら何もしない TODO:長押ししてロックを掛ける機能を実装する予定
    });
}

/**
 * 素材選択画像のクリックイベント
 * 素材選択中に押され、選択を解除する。
 */
const onClickElementFlagImg = () => {
    $(slMyUnit.elementFlagImgClass).on("click", function() {
        //素材選択画像を見えなくする
        $(this).css("display", "none");

        const clickId = $(slMyUnit.elementFlagImgClass).index(this);
        const objectId = fMyUnit.getObjectIdInMyUnits(clickId);
        //識別キーを消して、消した位置を取得
        const deleteId = fMyUnit.deleteObjectIdInElements(objectId);
        //消した位置の画像を初期化する
        $(elementImgClass).eq(deleteId).attr("src", getPathInSozai(initialUnitImgName));
    });
}

/**
 * 強化キャラの選択状態をオン/オフにする
 */
const turnOnSelectFlag = () => {
    $(levelUpUnitClass).attr("data-isSelect", "true");
    $(levelUpImgClass).attr("src", getPathInSozai(selectedModeImgName));
}
const turnOffSelectFlag = () => {
    $(levelUpUnitClass).attr("data-isSelect", "false");
    $(levelUpImgClass).attr("src", getPathInSozai(initialUnitImgName));
}

/**
 * 強化キャラのセットフラグをオン/オフにする
 */
const turnOnSetFlag = () => {
    $(levelUpUnitClass).attr("data-isSet", "true");
    $(levelUpImgClass).attr("src", getPathInSozai(selectedModeImgName));
}
const turnOffSetFlag = () => {
    $(levelUpUnitClass).attr("data-isSet", "false");
    $(levelUpImgClass).attr("src", getPathInSozai(initialUnitImgName));
}

/**
 * 強化アイコンの選択状態を取得
 * @return {boolean} 選択状態の真偽値
 */
const isSelectFlag = () => {
    if( $(levelUpUnitClass).attr("data-isSelect") ==="true") return true;
    else return false;
}
/**
 * 強化アイコンにキャラがセットされているかを取得
 * @return {boolean} セットされているかどうかの真偽値
 */
const isSetFlag = () => {
    if ($(levelUpUnitClass).attr("data-isSet") === "true") return true;
    else return false;
}

/**
 *  強化するキャラを決定する
 * @param {number} id HTMLタグで何番目か
 * @param {?} objectId 強化するキャラの識別キー
 */
const setLevelUpUnit = (id, objectId) => {
    turnOnSetFlag();

    //識別キーとインデックスの更新
    fMyUnit.setObjectIdAtTrainUnit(objectId);
    fMyUnit.setIndexAtTrainUnit(id);

    //選択キャラのアイコンを暗くする
    $(slMyUnit.myUnitImgClass).eq(id).css("filter", "brightness(50%)");

    //キャラデータを取得する
    const levelUpUnit = fMyUnit.myUnitDataBase[objectId];

    //左上に画像を表示する
    const url = getIconPath(levelUpUnit.imgNumber);
    $(levelUpImgClass).attr("src", url);

    //ステータスを表示する
    updateTrainUnitStatus(levelUpUnit);
}

/**
 * 強化対象キャラのステータスを更新する
 * @param {object} trainUnit 強化対象のキャラデータ nullなら初期化する
 */
const updateTrainUnitStatus = (trainUnit=null) => {
    let maxLevel, level, experience_val, attack, hp;
    if(trainUnit !== null){
        [maxLevel, level, experience_val, attack, hp] =
        [trainUnit.maxLevel, trainUnit.level, getRd(10,90),
         trainUnit.attack, trainUnit.hp];
    }else{
        [maxLevel, level, experience_val, attack, hp] =
        ["-", "-", 0, "-", "-"];
    }
    $(status_div).eq(0).text(maxLevel);
    $(status_div).eq(1).text(level);
    $(`${status_div} progress`).attr("value", experience_val);
    $(status_div).eq(3).text(attack);
    $(status_div).eq(4).text(hp);
}


/**
 * 素材にする
 */
const setElementMyUnit = (id, objectId) => {
    //空きスペース調査
    const emptySpaceId = (() => {
        for(let i=0; i<fMyUnit.ELEMENT_NUMBER; i++){
            if(fMyUnit.getObjectIdInElements(i) === null){
                return i;
            }
        }
        return -1;
    })();
    //空きスペースがなければ何もしない
    if(emptySpaceId === -1)return;

    //素材欄に画像を表示する
    //対象キャラのデータを取得
    const elementUnit = fMyUnit.myUnitDataBase[objectId];
    //画像URLを更新する
    $(elementImgClass).eq(emptySpaceId).attr("src", getIconPath(elementUnit.imgNumber));
    //識別キーを更新する
    fMyUnit.setObjectIdInElements(emptySpaceId, objectId);

    //素材選択画像を表示する
    $(slMyUnit.elementFlagImgClass).eq(id).css("display", "block");
}

/**
 * 状態をリセットする
 */
const clearStatus = () => {
    turnOffSelectFlag();
    turnOffSetFlag();

    //暗くしたアイコンを元に戻す
    $(slMyUnit.myUnitImgClass).eq(fMyUnit.getIndexAtTrainUnit()).css("filter", "brightness(100%)");

    //強化キャラの情報を初期化する
    fMyUnit.setObjectIdAtTrainUnit(null);
    fMyUnit.setIndexAtTrainUnit(null);

    //素材の初期化（仮）
    resetElements();

    //ステータス表示をリセットする
    updateTrainUnitStatus();
}

/**
 * 素材の識別キー、画像、選択画像をリセットする
 */
const resetElements = () => {
    //識別キーを初期化する
    fMyUnit.clearObjectIdInElements();

    //素材画像を初期化する
    $(elementImgClass).each( function() {
        $(this).attr("src", getPathInSozai(initialUnitImgName));
        $(this).attr("data-isEmpty", "true");
    });

    //素材選択画像を非表示にする
    $(slMyUnit.elementFlagImgClass).each( function(){
        $(this).css("display", "none");
    });
}








