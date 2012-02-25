<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>css/conteudo.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>css/jquery.datepick.css" media="screen" />
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/funcoes.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery-ui-1-8.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskMoney.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/dhtmlxcommon.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/ajax.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/js.js"></script>
        <script>
            function atualizaRelogioTopo(){
                
                var hoje = new Date();
                var hora = hoje.getHours();
                var minuto = hoje.getMinutes();
                var segundos = hoje.getSeconds();
                
                if(hora < 10){hora = "0" + hora}
                if(minuto < 10){minuto = "0" + minuto}
                if(segundos < 10){segundos = "0" + segundos}
                
                document.getElementById("relogioTopo").innerHTML = hora + ":" +minuto +":"+segundos;
                setTimeout(atualizaRelogioTopo, 1000);
            }
            
            $(document).ready(function(){
                //atualizarPainel();
                
                var t561;

                function cronometro561(){
                    var retorno = "";
                    var time = document.getElementById('hcronometro'+2).value; 
                    
                    if(time != '0'){
                        retorno = time -1;
                        document.getElementById('hcronometro'+2).value = retorno;
                        document.getElementById('cronometro'+2).innerHTML = retorno;
                        t561 = setTimeout(cronometro561,1000);
                    }
                    else{
                        clearTimeout(t561);
                        alert('encerrou');
                    }

                }

                // CANCELA O CRONOMETRO
                function stopCronometro561(){
                    clearTimeout(t561);
                }

	
                var cro561;
                function verificaCronometro561(){
                    cronometroVer = document.getElementById("crono561").value;
		
                    // EXECUTA DE SEGUNDO EM SEGUNDO
                    cro561 = setTimeout("verificaCronometro561();",1000);

                    if(cronometroVer == "S"){
                        cronometro561();
                        stopVerificaCronometro561();
                    }
                }
	
                // CANCELA O CRONOMETRO
                function stopVerificaCronometro561(){
                    clearTimeout(cro561);
                }

               // verificaCronometro561();

                
                
            });
            
        </script>

    </head>
    <body onload="//atualizaRelogioTopo();">
        <div id="conteudo">

            <p id="relogioTopo"></p>
            <? if ($this->session->userdata("login") != "") { ?>
                <div class="titulo">
                    <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
                    <li><a href="<?= BASE_URL(); ?>minha-conta"><span>Minha conta</span></a></li>
                    <li><a href="<?= BASE_URL(); ?>clientes/sair"><span>Sair</span></a></li>
                </div>
            <? } else { ?>
                <div class="formulario">
                    <li><a href="<?= base_url(); ?>contaController/cadastroClienteSite"><span>Cadastre-se</span></a></li>
                    <form action="<?= base_url() ?>clientes/login" method="post">

                        <input type="text" name="login" id="login" class="inputSmall" value=""/>
                        <input type="password" name="senha" id="senha" class="inputSmall" value=""/>
                        <input type="submit" value="Enviar" class="button"/>

                    </form>  
                </div>
            <? } ?>
