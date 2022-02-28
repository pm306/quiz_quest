 <?php require_once("../config.php"); ?> 

let base_url = "<?php print($baseUrl); ?>";

//
//phpのvar_dump的な
//
function vardump(arr,lv,key) {
    let dumptxt = "",
        lv_idt = "",
        type = Object.prototype.toString.call(arr).slice(8, -1);
    if(!lv) lv = 0;
    for(let i=0;i<lv;i++) lv_idt += "    ";
    if(key) dumptxt += lv_idt + "[" + key + "] => ";
    
    if(arr == null || arr == undefined){
        dumptxt += arr + '\n';
    } else if(type == "Array" || type == "Object"){
        dumptxt += type + "...{\n";
        for(let item in arr) dumptxt += vardump(arr[item],lv+1,item);
        dumptxt += lv_idt + "}\n";
    } else if(type == "String"){
        dumptxt += '"' + arr + '" ('+ type +')\n';
    }  else if(type == "Number"){
        dumptxt += arr + " (" + type + ")\n";
    } else {
        dumptxt += arr + " (" + type + ")\n";
    }
    return dumptxt;
}

function postJsonSynk(url,data,callback){
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        async : false,   // ← asyncをfalseに設定する
        success: callback,
    });
}