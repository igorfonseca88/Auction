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
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/js.js"></script>
        

    </head>
    <body>
        <div id="conteudo">

            <p id="relogioTopo"></p>
            <? if ($this->session->userdata("login") != "") { ?>
            <script>
                carregaLances(<?=$this->session->userdata("idConta")?>);
            </script>
                <div class="titulo">
                    <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
                    <li><a href="<?= BASE_URL(); ?>minha-conta"><span>Minha conta</span></a></li>
                    <li><a href="<?= BASE_URL(); ?>clientes/sair"><span>Sair</span></a></li>
                    <li>Seus lances :<span id="usu_lances"></span></li>
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
