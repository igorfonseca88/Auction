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
    <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL(); ?>js/funcoes.js"></script>
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
            <li><a href="<?php echo BASE_URL(); ?>notificacaoController/transacoesPorIntervaloDatas"><span>TESTE Retorno</span></a></li>
            <li><a href="<?php echo BASE_URL(); ?>leilaoController/leiloesArrematados/<? echo $this->session->userdata("idConta")?>"><span>Leilões Arrematados</span></a></li>
        </ul>
    </div>
</body>
</html>



        