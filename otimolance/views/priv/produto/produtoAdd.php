<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/otimolance/">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>produtoController/">Listagem de produtos</a> &raquo; Novo Produto</span>
    </div>
    <div class="formulario">
        <h2>Novo cadastro de produto</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="salvarNovoProduto">
            <div class="item">
                <label>Nome</label><br />
                <input type="text" name="txtNome" id="txtNome" value="" class="input"/>
            </div>

            <div class="item">
                <label>Descrição</label><br />
                <textarea class="textarea" id="txtDescricao" cols="60" rows="10" name="txtDescricao"></textarea>
            </div>

            <div class="item">
                <label>Preço</label><br />
                R$ <input type="text" name="txtPreco" id="txtPreco" value="" class="input"/>
            </div>
            <div class="item">
                <label>Desconto</label><br />
                R$ <input type="text" name="txtDesconto" id="txtDesconto" value="" class="input"/>
            </div>
            <div class="item">
                <label>Quantidade</label><br />
                <input type="text" name="txtQauntidade" id="txtQuantidade" value="" class="input"/>
            </div>
            <div>
                <input type="checkbox" name="tipoLance[]" id="tipoLance" onchange="showHideCategoria()"> 
                <label>Produto do tipo lance</label>
            </div>
            <br>
             <div class="item">
                <label>Categoria do Produto</label><br />
                <select name='idCategoria' id='idCategoria' class="select">
                    <option value=""> Selecione </option>
                    <?
                    if (count($categorias)) {
                        foreach ($categorias as $key) {
                            echo "<option value='" . $key->idCategoria. "'>" . $key->nome. "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="acao">
                <input type="button" value="Cancelar" class="button" />
                <input type="submit" class="button" name="btSalvarProduto" value="Salvar Produto" />
            </div>

        </form>

    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>