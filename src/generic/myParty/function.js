import * as unitData from '../unitData.js';
import * as slMyParty from './selector.js';
import {getIconPath} from '../other.js';

const PARTY_NUMBER = 5;

//パーティの位置ごとのオブジェクトID。nullは空
const partyUnitObjectId = new Array(PARTY_NUMBER).fill(null);
const getObjectIdInPartyUnit = (index) => {
    return partyUnitObjectId[index];
}
const setObjectIdInPartyUnit = (index, objectId) => {
    partyUnitObjectId[index] = objectId;
}

/**
 * パーティ画面にキャラデータをセットする
 */
const setPartyData = () => {
    const partyUnits = unitData.getPartyInUnits(); //DB問い合わせの代わり

    for(let i=0; i<PARTY_NUMBER; i++){
        const unit = partyUnits[i];
        $(slMyParty.imgClass).eq(i).attr("src",getIconPath(unit.imgNumber));
        $(slMyParty.levelClass).eq(i).text(unit.level);
        $(slMyParty.attackClass).eq(i).text(unit.attack);
        $(slMyParty.hpClass).eq(i).text(unit.hp);
        partyUnitObjectId[i] = unit.objectId;
    }
 }
/**
 * パーティキャラのHTMLを生成する
 * 複数の画面で使うので、管理を一元化するのが目的
 */
const createPartyHTML = () => {
    const appendClass = ".party_boxes";
    const partyColumn = `
	<div class="col-2 party_box">
		<img class="party_img" src="/img/sozai/touka_icon.png">
		<div class="party_status">
			<div class="party_level"></div>
			<div class="party_attack"></div>
			<div class="party_hp"></div>
		</div>
	</div>
    `;
    for(let i=0; i<PARTY_NUMBER; i++){
        $(appendClass).append(partyColumn);
    }
}

export {PARTY_NUMBER,
        getObjectIdInPartyUnit, setObjectIdInPartyUnit,
        setPartyData, createPartyHTML}
