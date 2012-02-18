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
                //iniciaCronometro('');
                atualizarPainel();
            });
            
        </script>

    </head>
    <body onload="atualizaRelogioTopo();">
        <div id="conteudo">

            <p id="relogioTopo"></p>
            <? 
            if ($this->session->userdata("login") != "") { ?>
                <div class="titulo">
                    <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
                    <li><a href="<?= BASE_URL(); ?>minha-conta"><span>Minha conta</span></a></li>
                    <li><a href="<?= BASE_URL(); ?>clientes/sair"><span>Sair</span></a></li>
                </div>
            <? } else { ?>
            <div class="formulario">
                <form action="<?= base_url() ?>clientes/login" method="post">

                    <input type="text" name="login" id="login" class="inputSmall" value=""/>
                    <input type="password" name="senha" id="senha" class="inputSmall" value=""/>
                    <input type="submit" value="Enviar" class="button"/>

                </form>  
            </div>
            <? } ?>