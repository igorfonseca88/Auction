var DELIMITADOR_STRING = "@";

   
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

function showHideFinalizarConta(){
 if($("#checkAceitarTermo").is(":checked")){
     $("#btFinalizar").attr("disabled", false);
 }
 else{
     $("#btFinalizar").attr("disabled", true);
 }
}

function calcularSubTotal(idItemPedido){
    var quantidade = $("#txtQuantidade"+idItemPedido).find('option').filter(':selected').text();
    var preco = $("#txtPreco"+idItemPedido).text();
    var subTotal = quantidade * preco;
    $("#txtSubTotal"+idItemPedido).text(subTotal);
}

 function verificarCheckbox() {
     selecionados = new Array();
        $(".checkbox").filter(':checked').each(function(){
            selecionados.push($(this).val());
            });
            
        $("#checkboxesChecked").val(selecionados);
 }
 
  function selecionarTodos() {
       if($("#selectAll").is(":checked")){
            $(".checkbox").attr("checked", true);
       }else{
           $(".checkbox").attr("checked", false);
       }
 }


function getEndereco() {
    // Se o campo CEP n�o estiver vazio
    if($.trim($("#txtCep").val()) != ""){
    /* 
    Para conectar no servi�o e executar o json, precisamos usar a fun��o
    getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
    dataTypes n�o possibilitam esta intera��o entre dom�nios diferentes
    Estou chamando a url do servi�o passando o par�metro "formato=javascript" e o CEP digitado no formul�rio
    http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#txtCep").val()
    */
    $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#txtCep").val(), function(){
    if(resultadoCEP["resultado"] && resultadoCEP["bairro"] != ""){
        $("#txtLogradouro").val(unescape(resultadoCEP["tipo_logradouro"])+": "+unescape(resultadoCEP["logradouro"]));
        $("#txtBairro").val(unescape(resultadoCEP["bairro"]));
        $("#txtCidade").val(unescape(resultadoCEP["cidade"]));
        $("#txtEstado").val(unescape(resultadoCEP["uf"]));
        $("#txtNumero").focus();
        ScriptDiv.innerHTML = '';
    }else{
            ScriptDiv.innerHTML = 'CEP não encontrado.';
            return false;
        }
    });                             
    }
}
