<?
// se um usu�rio do tipo administrador estiver na sess�o n�o deixa logar aqui
if ($this->Conta_model->logged() == FALSE || !$this->Conta_model->validaTipoUsuario(Conta_model::TU_CLIENTE)) {
    redirect('home');
} else if ($this->Conta_model->logged() == FALSE) {
    redirect('principal/redirecionaLogin', 'refresh');
}

$this->load->view('_padrao/topo');
?>

        <div id="topo">
            <img src="<?php echo BASE_URL(); ?>_imagens/logo_revistafalaserio.png" class="logo" />
            <h1>&rsaquo; Painel administrativo</h1>
        </div>


        <div id="menuesquerdo">
            <ul>
                <li class="titulo"><a><span>Meu Admin</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>login/login/logoff"><span>Sair</span></a></li>
            </ul>
            <ul>
                <li class="titulo"><a><span>Áreas</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>produtoController/"><span>Produtos</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>leilaoController/"><span>Painel de leilões</span></a></li>
                <li><a href="<?php echo BASE_URL(); ?>cparametro/"><span>Parâmetros do sistema</span></a></li>
                <li><a href=""><span>Financeiro</span></a></li>
            </ul>
        </div>






        