var DELIMITADOR_STRING = "@";

$(function($) {
    // Quando enviado o formulário
    $("#upload").submit(function() {
        // Passando por cada anexo
        $("#anexos").find("li").each(function() {
            // Recuperando nome do arquivo
            var arquivo = $(this).attr('lang');
            // Criando campo oculto com o nome do arquivo
            $("#upload").prepend('<input type="hidden" name="anexos[]" value="' + arquivo + '" \/>');
        }); 
    });
});
    
function num2str(campo)
{
    vr = campo.value;
    vr = vr.replace( "/", "" );
    vr = vr.replace( ",", "" );
    vr = vr.replace( ".", "" );
    vr = vr.replace( ".", "" );
    vr = vr.replace( ".", "" );
    vr = vr.replace( ".", "" );

    if (vr.length > 0)
    {
        vr = parseInt(vr,10);
    }
	
    vr = '' + vr
    tam = vr.length;

    if ( tam <= 2 )
    {
        if (tam == 1)
        { 
            campo.value = "0,0" + vr ; 
        }
        else if (tam == 2)
        { 
            campo.value = "0," + vr ; 
        }
        else
        {
            campo.value = "" ; 
        }
    }
    if ((tam > 2) && (tam <= 5))
    {
        campo.value = vr.substr(0, tam - 2) + ',' + vr.substr(tam - 2, tam); 
    }
    if ((tam >= 6) && (tam <= 8))
    {
        campo.value = vr.substr(0, tam - 5) + '.' + vr.substr(tam - 5, 3) + ',' + vr.substr(tam - 2, tam); 
    }
    if ((tam >= 9) && (tam <= 11))
    {
        campo.value = vr.substr(0, tam - 8 ) + '.' + vr.substr(tam - 8, 3) + '.' + vr.substr(tam - 5, 3 ) + ',' + vr.substr(tam - 2, tam) ; 
    }
    if ((tam >= 12) && (tam <= 14))
    {
        campo.value = vr.substr(0, tam - 11) + '.' + vr.substr(tam - 11, 3 ) + '.' + vr.substr(tam - 8, 3) + '.' + vr.substr(tam - 5, 3) + ',' + vr.substr(tam - 2, tam) ; 
    }
    if ((tam >= 15) && (tam <= 17))
    {
        campo.value = vr.substr( 0, tam - 14 ) + '.' + vr.substr( tam - 14, 3 ) + '.' + vr.substr(tam - 11, 3) + '.' + vr.substr(tam - 8, 3) + '.' + vr.substr(tam - 5, 3) + ',' + vr.substr(tam - 2, tam) ;
    }
    return campo.value;
}



function abrePopoup()
{
    var id = "#dialog";//$(this).attr('href');

    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    $('#mask').css({
        'width':maskWidth,
        'height':maskHeight
    });

    $('#mask').fadeIn(100);
    $('#mask').fadeTo("fast",0.8);

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
    $(id).css('top',  winH/2-$(id).height()/2);
    $(id).css('left', winW/2-$(id).width()/2);

    $(id).fadeIn(100);
}
$(document).ready(function() {
    $('.window .close').click(function (e) {
        e.preventDefault();
        fechaPopup();
    });

    $('#mask').click(function () {
        fechaPopup();
    });

});

        
function fechaPopup()
{
    $('#mask').hide();
    $('.window').hide();
}


function carregaDadosProduto(produto){
    if(produto != ""){
        var params = "idProduto="+produto;
        dhtmlxAjax.post("/otimolance/produtoController/buscarDadosProdutoAjax/",params,responseDadosProdutoAjax);
    }
}

function responseDadosProdutoAjax (loader){
    var resposta = "";
    if(loader.xmlDoc.responseText){
        retorno = loader.xmlDoc.responseText;
        resposta = retorno.split(DELIMITADOR_STRING);
        document.getElementById("valorProduto").value= resposta[0];
    }
}

function showHideCategoria(){
 var valor = $("#tipoLance").is(":checked");
 $("#idCategoria").attr("disabled", valor);
}

function calcularSubTotal(idProduto){
    var quantidade = $("#txtQuantidade"+idProduto).find('option').filter(':selected').text();
    var preco = $("#txtPreco"+idProduto).text();
    var subTotal = quantidade * preco;
    $("#txtSubTotal"+idProduto).text(subTotal);
}