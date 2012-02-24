<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= BASE_URL(); ?>/area-restrita">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>categoriaController">Listagem de Categorias</a> &raquo; Editar cadastro de categoria</span>
    </div>

    <div class="formulario">
        <h2>Editar cadastro de categoria</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="<?= BASE_URL(); ?>categoriaController/editarCategoria">

            <? foreach ($categoria as $row) { ?>
            <input type="hidden" name="idCategoriah" id="idCategoriah" value="<?= $row->idCategoria?>"/>
                <div class="item">
                   <label>Nome</label><br />
                   <input type="text" name="txtNome" id="txtNome" value="<?= $row->nome ?>" class="input"/>
                </div>

                <br/>
                        
                <div class="acao">
                   <input type="reset" value="Cancelar" class="button"/>
                   <input type="submit" class="button" name="btSalvarCategoria" value="Salvar categoria"/>
                </div>	
            <? } ?>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>