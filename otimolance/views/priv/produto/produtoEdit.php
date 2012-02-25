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
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <?= $alerta != "" ? '<div class="warning"> ' . $alerta . ' </div>' : "" ?>
        <h2>Editar cadastro de produtos</h2>
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

      <!-- Galeria de imagens -->
            
            <h2>Galeria de imagens</h2>
            <form id="upload" action="<?= base_url() ?>produtoController/uploadImagem/<?=$row->idProduto?>" method="post" enctype="multipart/form-data">
                
                Imagem principal: 
                <select id="isPrincipal" name="isPrincipal" style="width: 100px" class="select">
                    <option value="0"> Não</option>
                    <option value="1"> Sim</option>
                </select>
                <br/>
                <label>Arquivo: </label> 
                <input type="file" class="input" name="userfile" id="userfile" />
                <input class="button" type="submit" name="enviar" value="Enviar" />

            </form>
            <br/>
 
             <? 
             if($galeria != null) {
             foreach ($galeria as $img) { ?>
                    <div class="galeria_lista">
                        <img style="float: right; margin-top: -20px" src="<?= base_url() ?>img/fechar.png" onclick="location.href='<?= base_url() ?>produtoController/excluirImagem/<?= $img->idGaleria; ?>'"/></a>
                        <div class="galeria_img">
                            <img src="<?= base_url() ?>upload/produtos/<?=$img->caminho?>" width="250px" height="200px"/></a>
                        </div>
                    </div>
               <? }
             }?>
            <br/>  <br/>
            <!-- Fim galeria  -->
            
            <!-- Galeria de videos -->
            
            <h2>Galeria videos</h2>
            <form id="uploadVideo" action="<?= base_url() ?>produtoController/uploadVideo/<?=$row->idProduto?>" method="post">
                
                
                <br/>
                <label>Embed: </label> 
                <input type="text" class="input" name="video" id="video" />
                <input class="button" type="submit" name="enviar" value="Enviar" />

            </form>
            <br/>
 
             <? 
             if($galeriaVideo != null) {
             foreach ($galeriaVideo as $video) { ?>
                    <div class="galeria_lista">
                        <img style="float: right; margin-top: -20px" src="<?= base_url() ?>img/fechar.png" onclick="location.href='<?= base_url() ?>produtoController/excluirVideo/<?= $video->idGaleria; ?>'"/></a>
                        <div class="galeria_img">
                            <?=$video->embed;?>
                        </div>
                    </div>
               <? }
             }?>
            <br/>  
            <!-- Fim galeria  -->
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>