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
    if(retorno == '2'){
        alert('Saldo insuficiente para lance.');
    }
    
    params = "leilao="+idLeilao;
    retorno = dhtmlxAjax.postSync("/otimolance/clance/buscarUltimoLance/",params);
    retorno = retorno.xmlDoc.responseText;
    retorno = retorno.split("@");
      
    //document.getElementById('hcronometro'+idLeilao).value = retorno[2];         
    //document.getElementById('cronometro'+idLeilao).innerHTML = retorno[2];         
    
}

function carregaLances(id){
    $.post("/otimolance/clance/retLances", {"id": id},
        function(data){
            $("#usu_lances").html(data.lances);

        }, "json");
}

function roundNumber(rnum, rlength) { // Arguments: number to round, number of decimal places  
    var newnumber = Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);  
    return newnumber;
}

