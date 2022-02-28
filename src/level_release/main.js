import * as fMyUnit from '../generic/myUnit/function.js';
import * as slMyUnit from '../generic/myUnit/selector.js';

import {getRd, to3Digit} from '../generic/number.js';

const MY_UNIT_NUMBER = 20;

$(()=>{
    fMyUnit.showMyUnit(MY_UNIT_NUMBER);
    testFunc();
});

//とりあえず素材選択してみた
const testFunc = () => {
    $(slMyUnit.getSelectElement(7)).css("display", "block");
}


