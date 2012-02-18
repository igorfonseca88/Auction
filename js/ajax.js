function autenticar(usuario, senha){
    var params = "usuario="+usuario+"&senha="+senha;
    dhtmlxAjax.post("conta/login/login/autenticar/",params,responseFunction);

}

function responseFunction(loader){

    if(loader.xmlDoc.responseText){
        alert(loader.xmlDoc.responseText);
    }
}

function lance(idLeilao, conta){
    
    var params = "leilao="+idLeilao+"&id="+conta;
    var retorno = dhtmlxAjax.postSync("/otimolance/clance/darLance/",params);
    
    retorno = retorno.xmlDoc.responseText;
    retorno = retorno.split("@");
    
    document.getElementById('valorLance'+idLeilao).innerHTML = roundNumber(retorno[1],3);
    document.getElementById('usuLance'+idLeilao).innerHTML = retorno[0];
    
}

function roundNumber(rnum, rlength) { // Arguments: number to round, number of decimal places  
    var newnumber = Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);  
    return newnumber;
}