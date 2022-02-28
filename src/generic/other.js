/* 汎用的な関数の置き場　暫定 */

/**
 * min以上、max未満の乱数（整数値）を得る
 * @param {number} min 最小値
 * @param {number} max 最大値 + 1
 * @return {number} 乱数
 */
export const getRd = (min, max) => {
    return Math.floor(Math.random() * (max - min) + min);
}
/**
 * 整数を受け取り、を0埋めした下3桁の文字列にして返す(キャラ画像のid取得に使う)
 * @param {number} number 整数
 * @return {string} 0埋めした整数の文字列
 */
export const to3Digit = (number) => {
    return ("000" + number).slice(-3);
}

/**
 * aをbで割った商を返す。余りは切り上げとする
 * @param {number} a 割られる数
 * @param {number} b 割る数
 * @return {number} 商(端数切り上げ)
 */
export const roundUp = (a, b) => {
    return Math.floor((a + b - 1) / b);
}

/**
 * 画像番号からキャラアイコンの相対パスを取得する
 * @param {string} number 3桁の整数文字列
 * @return {string} 画像の相対パス
 */
export const getIconPath = (number) => {
    return "/img/jewel-s/image/icon/f" + number + ".png";
}
/** img/sozai内の画像のパスを返す */
export const getPathInSozai = (imgName) => {
    return "/img/sozai/" + imgName + ".png";
}
