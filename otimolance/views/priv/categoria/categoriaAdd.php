<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/otimolance/">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>categoriaController/">Listagem de clientes</a> &raquo; Novo cliente</span>
    </div>
    <div class="formulario">
        <h2>Novo cadastro de categoria</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="salvarNovaCategoria">
                <div class="item">
                    <label>Nome</label><br />
                    <input type="text" name="txtNome" id="txtNome" value="" class="input"/>
                </div>

                <div class="acao">
                    <input type="button" value="Cancelar" class="button" />
                    <input type="submit" class="button" name="btSalvarCategoria" value="Salvar Categoria" />
                </div>

        </form>

    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>