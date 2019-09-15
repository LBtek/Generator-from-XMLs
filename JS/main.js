var form = document.querySelector("#form");
var btGerar = document.querySelector("#btGerar");

var div01 = document.querySelector("#count01");
var div02 = document.querySelector("#count02");
var div03 = document.querySelector("#count03");
var div04 = document.querySelector("#count04");
var div05 = document.querySelector("#count05");
var div06 = document.querySelector("#count06");
var div07 = document.querySelector("#count07");

var area01 = document.querySelector("#area01");
var area02 = document.querySelector("#area02");
var area03 = document.querySelector("#area03");
var area04 = document.querySelector("#area04");
var area05 = document.querySelector("#area05");
var area06 = document.querySelector("#area06");
var area07 = document.querySelector("#area07");

contador01();
contador02();
contador03();
contador04();
contador05();
contador06();
contador07();

area01.addEventListener('keyup', contador01);
area02.addEventListener('keyup', contador02);
area03.addEventListener('keyup', contador03);
area04.addEventListener('keyup', contador04);
area05.addEventListener('keyup', contador05);
area06.addEventListener('keyup', contador06);
area07.addEventListener('keyup', contador07);

function contador01(){ 
    var Linhas = area01.value.split("\n");
    div01.innerHTML = Linhas.length;
}

function contador02(){ 
    var Linhas = area02.value.split("\n");
    div02.innerHTML = Linhas.length;
}

function contador03(){ 
    var Linhas = area03.value.split("\n");
    div03.innerHTML = Linhas.length;
}
var array04 = [];
function contador04(){ 
    var Linhas = area04.value.split("\n");
    div04.innerHTML = Linhas.length;
    array04 = Linhas;
}
var array05 = [];
function contador05(){ 
    var Linhas = area05.value.split("\n");
    div05.innerHTML = Linhas.length;
    array05 = Linhas;
}

function contador06(){ 
    var Linhas = area06.value.split("\n");
    div06.innerHTML = Linhas.length;
}

function contador07(){ 
    var Linhas = area07.value.split("\n");
    div07.innerHTML = Linhas.length;
}

var msg = "Número Final diferente do Número Inicial!" + '\n\n' + "Não foram gerados os XML's das Notas:" + '\n\n' + "Número Inicial - Número Final";
var msgFinish = msg;

btGerar.onclick = function(){
    for (key in array04) {
        if(array04[key] != array05[key]) {
            msgFinish = msgFinish + '\n' + array04[key] + " - " + array05[key];
        }
    }
    if(msg != msgFinish) {
        alert(msgFinish);
        msgFinish = msg;
    }

    var count = setInterval(() => {
        var tmp = document.cookie;
        console.log(tmp);

        if (tmp == 'CookieTeste=teste') {
            clearInterval(count);
            window.location.reload();
        }
    }, 500);
}