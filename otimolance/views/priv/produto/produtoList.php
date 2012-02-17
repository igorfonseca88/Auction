<?
$this->load->view('priv/_inc/superior');
?>
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?//= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de Produtos</span>
    </div>

    <div class="formulario">
        <h2>Listagem de Produtos</h2>
        <input type="button" class="button" type="button" name="btNovoProduto" onclick="location.href='<?= base_url() ?>produtoController/novoProdutoAction'" value="Novo Produto" />
        <p><? //echo $this->session->flashdata('sucesso'); ?></p>

        <table class="tabela">
            <thead>
                <td>Código</td>
                <td>Nome</td>
                <td>Ações</td>
            </thead>
            
            <? foreach ($produtos as $produto) { ?>
                <tr class="linha">
                    <td><?=$produto->idProduto?></td>
                    <td><?=$produto->nome?></td>
                    <td>
                        <a href="<?= base_url() ?>conta/produtoController/editarProdutoAction/<?= $produto->idProduto ?>">Editar</a>
                    </td>
                </tr>
              <?}?>
         </table>
        <br/>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>
