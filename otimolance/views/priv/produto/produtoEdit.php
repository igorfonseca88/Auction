<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= BASE_URL(); ?>/area-restrita">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>produtoController">Listagem de Produtos</a> &raquo; Editar cadastro de produtos</span>
    </div>

    <div class="formulario">
        <h2>Editar cadastro de produtos</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="<?= BASE_URL(); ?>produtoController/editarProduto">

            <? foreach ($produto as $row) { ?>
                <input type="hidden" name="idProdutoh" id="idProdutoh" value="<?= $row->idProduto?>"/>
                <div class="item">
                    <label>Nome</label><br />
                    <input type="text" name="txtNome" id="txtNome" value="<?= $row->nome?>" class="input"/>
                </div>

                <div class="item">
                    <label>Descrição</label><br />
                    <textarea class="textarea" name="txtDescricao" id="txtDescricao" cols="60" rows="10"><?= $row->descricao ?></textarea>
                </div>

                <div class="item">
                   <label>Preço</label><br />
                   R$ <input type="text" name="txtPreco" id="txtPreco" value="<?= $row->preco?>" class="input"/>
                </div>

                <div class="item">
                    <label>Categoria</label><br />
                    <select name='idCategoria' id='idCategoria' class="select">
                        <option value=""> Selecione </option>
                        <?
                        if (count($categorias)) {
                            foreach ($categorias as $key) {
                                if ($row->idCategoria == $key->idCategoria)
                                    echo "<option selected value='" . $key->idCategoria . "'>" . $key->nome . "</option>";
                                else
                                    echo "<option value='" . $key->idCategoria . "'>" . $key->nome . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="acao">
                    <input type="button" value="Cancelar" class="button" />
                    <input type="submit" class="button" name="btSalvarProduto" value="Salvar Produto" />
                </div>		
                
            <? } ?>
        </form>

            <h2>Imagens Produto</h2>
            <form id="upload" action="<?= base_url() ?>produtoController/uploadImagem" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idProdutoUpload" id="idProdutoUpload" value="<?= $idProduto?>" />

                <label>Arquivo: </label> 
                <input type="file" class="input" name="userfile" id="userfile" />
                <input type="submit" class="button" name="enviar" value="Enviar" />

            </form>
            <br/>


            <div id="frameAnexos">
                <p>Imagens Produto em anexo</p>
                <ul id="anexos">

                    <? if (isset($row->imagemProduto)) { ?>
                        <li lang="<?php echo $row->imagemProduto ?>">
                            <?php echo $row->imagemProduto ?> <a href="<?= base_url() ?>upload/<?= $row->cupom ?>" target="_blank"><img src="<?= base_url() ?>img/file.png"/></a> 
                            <a href="<?= base_url() ?>produtoController/removerImagem/<?= $idProduto ?>"><img src="<?= base_url() ?>img/remove.png" alt="Remover" class="remover"/></a>
                        </li>
                    <? } ?>
                </ul>
            </div>
        <br/>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>