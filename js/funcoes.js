    function visivelLogin() {
        var x;
        var y;
        var div = document.getElementById('login');
        if (div.style.display == "block") {
           
            // div.style.display = "none";
            fazer(div, 0.001, 100, 0);
        }else{

           // div.style.display = "block";
           fazer(div, 0.001, 0, 100);
        }
    }

    //Pagina particular/meuTAxi

    //para mostar e ocultar elementos
    function mostrar(id, tempo) {
        elemento = document.getElementById(id);
        fazer(elemento, tempo, 0, 100);
    }

      function ocultar(id, tempo) {
            elemento = document.getElementById(id);
            fazer(elemento, tempo, 100, 0);
    }

    function fazer(elemento, tempo, inicio, fim) {
        //verificar se estamos fazendo o fadeIn ou fadeOut
        if (inicio == 0) {
            opacidade = 2;
            elemento.style.display = "block";
        } else {
            opacidade = -2;
        }

        verificar = inicio;

        intervalo = setInterval(function () { 
            if (verificar == fim) {
                if (fim == 0) {
                      elemento.style.display = "none";
                }
                clearInterval(intervalo);              
            }else{
                verificar += opacidade;
                elemento.style.opacity = verificar/100;
                //elemento.style.filter = "alpha(opacity = "+verificar+")";
            }
            
         }, tempo*1000);
    }



// ativar botao no perfil da conta cliente
function des(){
    document.getElementById("inp").disabled  = true;
}

function edit(){
    var troca1 = document.getElementById("save");
    var troca2 = document.getElementById("alt");
    var abilita = document.getElementById("inp");
    if(troca1.style.display = "none"){        
        troca1.style.display = "block";
        troca2.style.display = "none";
        abilita.style.disabled  = false;
    } 
}
