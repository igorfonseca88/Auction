<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>css/estilo.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>css/jquery.datepick.css" media="screen" />
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/funcoes.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery-ui-1-8.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskMoney.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/dhtmlxcommon.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/js.js"></script>
        
        <script>
            $(function() {
                $("#txtCpf").mask("999.999.999-99"); 
            });
        </script>  
    </head>
    <body>
        
        
     <!--Barra fixa superior-->
	<div id="autenticacao">
		<div id="relogioTopo"></div>
		
        <? if ($this->session->userdata("login") != "") { ?>
                <script>
                carregaLances(<?=$this->session->userdata("idConta")?>);
            </script>
              <ul>  
                  <li>Olá <?= $this->session->userdata("login") ?> !</li>
			<li>Você tem <span id="usu_lances"></span></li>
			<li><a href="<?= base_url(); ?>minha-conta"><span>Indique amigos e ganhe +5 lances!</span></a></li>
			<li><a href="<?= base_url(); ?>minha-conta"><span>Perfil</span></a></li>
			<li><a href="<?= base_url(); ?>clientes/sair"><span>Sair</span></a></li>		
		</ul>
	
        <? } else { ?>
        <!-- fecha div autenticacao -->
         
            <ul>  
                  <li><a href="<?= base_url(); ?>contaController/cadastroClienteSite"><span>Cadastre-se</span></a></li>
                    <li><a href="<?= base_url(); ?>contaController/recuperarSenha"><span>Esqueceu a senha?</span></a></li>
                    <form action="<?= base_url() ?>clientes/login" method="post">
                        <input type="text" style="border: 1px solid;" name="login" id="login" class="inputSmall" value=""/>
                        <input type="password" style="border: 1px solid;" name="senha" id="senha" class="inputSmall" value=""/>
                        <input type="submit" value="Enviar" class="button"/>
                    </form>  
            </ul>
            
        <? } ?>
    </div>
        <!--Topo-->ss
	<div id="topo">
		<a class="logo" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>img/logo1.jpg" alt="" title="" /></a>
		<ul class="botoes">
			<li><a href="<?php echo BASE_URL(); ?>compraController/comprarLances/">Comprar lances</a></li>
			<li><a href="">Como funciona</a></li>
			<li><a href="">Central de atendimento</a></li>
			<li><a href="">Ambiente 100% seguro</a></li>
		</ul>
		<div class="interacao">
			<form class="busca">
				<input type="text" class="inputtext" value="Pesquise o produto que você deseja" onFocus="if(this.value == 'Pesquise o produto que você deseja') {this.value = '';}" onBlur="if(this.value=='') {this.value = 'Pesquise o produto que você deseja';}" />
				<input type="submit" class="inputsubmit" value="Ok" />
			</form>
			<form class="indiqueProduto">
				<input type="text" class="inputtext" value="Indique um produto para leilão" onFocus="if(this.value == 'Indique um produto para leilão') {this.value = '';}" onBlur="if(this.value=='') {this.value = 'Indique um produto para leilão';}" />
				<input type="submit" class="inputsubmit" value="Ok" />
			</form>
		</div>
	</div>

    