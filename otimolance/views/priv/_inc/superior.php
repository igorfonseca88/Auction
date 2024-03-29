<?
// se um usu�rio do tipo administrador estiver na sess�o n�o deixa logar aqui
if ($this->Conta_model->logged() == TRUE && $this->Conta_model->validaTipoUsuario(Conta_model::TU_CLIENTE)) {
    redirect('home');
} else if ($this->Conta_model->logged() == FALSE) {
    redirect('principal/redirecionaLogin', 'refresh');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sistema de Gerencimento de Leilões 1.0 - MyNewBiz</title>

        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>css/conteudo.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>css/jquery.datepick.css" media="screen" />
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/funcoes.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery-ui-1-8.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskMoney.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/dhtmlxcommon.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>core/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL(); ?>core/ckeditor/config.js"></script>
        <script src="<?php echo BASE_URL(); ?>core/ckeditor/_samples/sample.js" type="text/javascript"></script>

        <script>
            $(function() {
                 $( ".date" ).datepicker({
                    dateFormat: 'dd/mm/yy', 
                    changeMonth: true, 
                    changeYear: true
                });
                
                $(".maskMoney").maskMoney({
                    showSymbol:true, 
                    symbol:"", 
                    decimal:",", 
                    thousands:"."
                });
                
                
                $( "#dataInicio" ).datepicker({
                    dateFormat: 'dd/mm/yy', 
                    changeMonth: true, 
                    changeYear: true
                });
                
                $("#valorLeilao").maskMoney({
                    showSymbol:true, 
                    symbol:"", 
                    decimal:",", 
                    thousands:"."
                });
                
                $("#horaInicio").mask("99:99:99"); 
                $("#txtCpf").mask("999.999.999-99"); 
            });
        </script>    

    </head>

    <body onload="">

        <div id="menuesquerdo">
            
            <img src="<?=base_url();?>img/logo1.jpg" class="logo" />
            <h1> Gerenciador de leilões</h1>
            
            <ul>
                <li class="titulo"><a><span>Meu Admin</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>area-restrita"><span>Principal</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>login/login/logoff"><span>Sair</span></a></li>
            </ul>
            <ul>
                <li class="titulo"><a><span>Cadastros</span></a></li>
                <li><a href=""><span>Empresa</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>contaController?idTipoUsuario=1"><span>Usuários do sistema</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>contaController/contaClientes?idTipoUsuario=2"><span>Contas dos clientes</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>categoriaController/"><span>Categorias</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>produtoController/"><span>Produtos</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>cparametro/"><span>Parâmetros do sistema</span></a></li>
            </ul>
            
            <ul>
                <li class="titulo"><a><span>Leilões</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>leilaoController/"><span>Painel de leilões</span></a></li>
                
            </ul>
            
            <ul>
                <li class="titulo"><a><span>Pedidos</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>cpedidos/pesquisarAction"><span>Pedidos</span></a></li>
            
                 <li><a href="<?php echo BASE_URL(); ?>notificacaoController/transacoes"><span>Extrato de Transações</span></a></li>
            </ul>
        </div>






        