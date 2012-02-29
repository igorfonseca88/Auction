function atualizarPainel(){
    var painel = document.getElementsByName("painel");
    var tam = painel.length;
    for(i=0; i< tam; i++){
        
        var params = "leilao="+painel[i].value;
        var retorno = dhtmlxAjax.postSync("/otimolance/clance/buscarUltimoLance/",params);
        retorno = retorno.xmlDoc.responseText;
        retorno = retorno.split("@");
      
        document.getElementById('valorLance'+painel[i].value).innerHTML = roundNumber(retorno[1],3);
        document.getElementById('usuLance'+painel[i].value).innerHTML = retorno[0];            
        
    }
   
    setTimeout(atualizarPainel, 50);
}

function lance(idLeilao, conta){
    var params = "leilao="+idLeilao+"&id="+conta;
    var retorno = dhtmlxAjax.postSync("/otimolance/clance/darLance/",params);
    
    retorno = retorno.xmlDoc.responseText;
    retorno = retorno.split("@");
    if(retorno[0] == 'SALDO_INSUFICIENTE'){
        alert('Saldo insuficiente para lance.');
    }
    if(retorno[0] == 'LEILAO_INATIVO'){
        alert('Leilão finalizado.');
    }
    else if(retorno[0] == 'SUCESSO'){
        document.getElementById('usu_lances').innerHTML = retorno[1];         
    }
}

function carregaLances(id){
    $.post("/otimolance/clance/retLances", {"id": id},
        function(data){
            if(data != "")
                $("#usu_lances").html(data.saldo);
        }, "json");
}

function roundNumber(rnum, rlength) { // Arguments: number to round, number of decimal places  
    var newnumber = Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);  
    return newnumber;
}

