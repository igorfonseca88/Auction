<?php

$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/otimolance/">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>contaController/">Novo Usuário</a> &raquo; Cadastrar novo usuário.</span>
    </div>

    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>
