<?
$this->load->view('priv/_inc/superior');
?>
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?//= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de Pedidos</span>
    </div>

    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <?= $alerta != "" ? '<div class="warning"> ' . $alerta . ' </div>' : "" ?>
        <h2>Listagem de Pedidos</h2>
        <input type="button" class="button" type="button" name="btNovoProduto" onclick="location.href='<?= base_url() ?>produtoController/novoProdutoAction'" value="Novo Produto" />
        <p><? //echo $this->session->flashdata('sucesso'); ?></p>

        <table class="tabela">
            <thead>
                <td>Código</td>
                <td>Produto</td>
                <td>Valor</td>
                <td>Frete</td>
                <td>Situação</td>
                <td>Ações</td>
            </thead>
            
            <? foreach ($pedidos as $pedido) { ?>
                <tr class="linha">
                    <td><?=$pedido->idPedido?></td>
                    <td><?=$pedido->nome?></td>
                    <td><?=$pedido->valor?></td>
                    <td><?=$pedido->frete?></td>
                    <td><?=$pedido->status?></td>
                    <td>
                        <a href="<?= base_url() ?>cpedidos/editarPedidoAction/<?= $pedido->idPedido ?>">Editar</a>
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
