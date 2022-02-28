import * as fMyParty from '../generic/myParty/function.js';

$(()=>{
    fMyParty.createPartyHTML();

    fMyParty.setPartyData();

    setClickEvent();
});

/**
 * ボタンにクリックイベントを設置する TODO:実装
 */
const setClickEvent = () => {
    $('#organization').on("click", () => {
        location.href = './party.php';
    });

    $('#optimal_organization').on("click", () => {
        console.log("おまかせ編成"); //仮
    });

    $('#levelup').on("click", () => {
        location.href = './level_up.php';
    });

    $('#release_limit').on("click", () => {
        location.href = './level_release.php';
    });
}


