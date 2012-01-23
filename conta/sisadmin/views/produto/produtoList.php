<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?//= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de Produtos</span>
    </div>

    <div class="formulario">
        <h2>Listagem de Produtos</h2>
        <input type="button" class="button" type="button" name="btNovoProduto" onclick="location.href='<?= base_url() ?>produtoController/novoProdutoAction'" value="Novo Produto" />
        <p><? //echo $this->session->flashdata('sucesso'); ?></p>

       
            <? foreach ($produtos as $produto) { ?>
            
            <div class="galeria_lista">
                <p>Nome <?=$produto->nome?></p>
                <div class="galeria_img">
                    <a href="<?= base_url() ?>produtoController/editarProdutoAction/<?=$produto->nome?>"><img width="150px" height="180px" src="<?= base_url() ?>conta/upload/produtos/velutex.jpg"/></a> 
                </div>
            </div>
             
              <?}?>
        
        
        
        <br/>
    </div>
</div>
<?
$this->load->view('_inc/inferior');
?>
