<?
// se um usu�rio do tipo administrador estiver na sess�o n�o deixa logar aqui
if ($this->Conta_model->logged() == TRUE && $this->Conta_model->validaTipoUsuario(Conta_model::TU_CLIENTE)) {
    redirect('home');
}
else if($this->Conta_model->logged() == FALSE){
   redirect('principal/redirecionaLogin', 'refresh');
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sistema de Gerencimento de Conte&uacute;do 1.0 - MyNewBiz</title>

        <link rel="stylesheet" type="text/css" href="/otimolance/css/conteudo.css" media="screen" />
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/funcoes.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery-ui-1-8.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskMoney.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/dhtmlxcommon.js"></script>
        
        
        <script>
            $(function() {
    $( "#txtDataIni" ).datepicker({
        dateFormat: 'dd/mm/yy', 
        changeMonth: true, 
        changeYear: true
    });
    $( "#txtDataFim" ).datepicker({
        dateFormat: 'dd/mm/yy', 
        changeMonth: true, 
        changeYear: true
    });
    $("#txtValorTotal").maskMoney({
        showSymbol:true, 
        symbol:"", 
        decimal:",", 
        thousands:"."
    });
    $("#txtTelefone").mask("(99) 9999-9999"); 
    $("#txtCEP").mask("99999-999"); 
});
        </script>    
        
    </head>

    <body onload="">

		<div id="topo">
			<img src="/otimolance/_imagens/logo_revistafalaserio.png" class="logo" />
			<h1>&rsaquo; Painel administrativo</h1>
		</div>


		<div id="menuesquerdo">
		  <ul>
			 <li class="titulo"><a><span>Meu Admin</span></a></li>
			 <li><a href="<?php echo BASE_URL(); ?>"><span>Principal</span></a></li>
			 <!--<li><a href=""><span>Alterar minha senha</span></a></li>-->
			 <li><a href="<?php echo BASE_URL(); ?>login/login/logoff"><span>Sair</span></a></li>
		  </ul>
		  <ul>
			 <li class="titulo"><a><span>Áreas</span></a></li>
			 <li><a href=""><span>Empresa</span></a></li>
                         <li><a href=""><span>Usuários</span></a></li>
                         <li><a href=""><span>Categorias</span></a></li>
			 <li><a href="<?php echo BASE_URL(); ?>produtoController/"><span>Produtos</span></a></li>
			 <li><a href="<?php echo BASE_URL(); ?>leilaoController/"><span>Painel de leilões</span></a></li>
			 <li><a href=""><span>Financeiro</span></a></li>
		  </ul>
		</div>

        
				


        