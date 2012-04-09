<?
// se um usu�rio do tipo administrador estiver na sess�o n�o deixa logar aqui
if ($this->Conta_model->logged() == FALSE || !$this->Conta_model->validaTipoUsuario(Conta_model::TU_CLIENTE)) {
    redirect('clientes/autenticar', 'refresh');
} else if ($this->Conta_model->logged() == FALSE) {
    redirect('clientes/autenticar', 'refresh');
}
$this->load->view('_padrao/topo');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>css/conteudo.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL(); ?>css/jquery.datepick.css" media="screen" />
    <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/funcoes.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery-ui-1-8.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskMoney.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/dhtmlxcommon.js"></script>
    
    <script>
        $(function() {
            $( "#txtDataNascimento" ).datepicker({
                dateFormat: 'dd/mm/yy', 
                changeMonth: true, 
                changeYear: true
            });

            $("#txtCep").mask("99999-999"); 
            $("#txtTelefone").mask("(99)9999-9999"); 
            $("#txtCelular").mask("(99)9999-9999"); 
        });
    </script>   
</head>
<body>
    <div id="menuesquerdo">
        <h1> Gerenciador de leilões</h1>
        <ul>
            <li class="titulo"><a><span>Meu Admin</span></a></li>
            <li><a href="<?php echo BASE_URL(); ?>login/login/logoff"><span>Sair</span></a></li>
        </ul>
        <ul>
            <li class="titulo"><a><span>Meus Dados</span></a></li>
            <li><a href="<?php echo BASE_URL(); ?>contaController/alterarDados"><span>Alterar Dados</span></a></li>
            <li><a href="<?php echo BASE_URL(); ?>contaController/alterarSenha"><span>Alterar Senha</span></a></li>
            <li><a href="<?php echo BASE_URL(); ?>compraController/comprarLances"><span>Comprar Lances</span></a></li>
        </ul>
        <ul>
            <li class="titulo"><a><span>Lances</span></a></li>
            <li><a href="<?php echo BASE_URL(); ?>contaController/historicoLances"><span>Histórico de Lances Utilizados</span></a></li>
            <!--<li><a href="<?//php echo BASE_URL(); ?>contaController/extratoLances"><span>Extrato de Lances</span></a></li>-->
        </ul>
        <ul>
            <li class="titulo"><a><span>Leilões</span></a></li>
            <li><a href="<?php echo BASE_URL(); ?>leilaoController/leiloesArrematados/<? echo $this->session->userdata("idConta")?>"><span>Leilões Arrematados</span></a></li>
        </ul>
    </div>
</body>
</html>



        