<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= BASE_URL(); ?>/area-restrita">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>cpedidos/">Listagem de pedidos</a> &raquo; Editar pedido</span>
    </div>

    <div class="formulario">
        <h2>Pedido</h2>
        <?= $sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>

        <? foreach ($pedido as $row) { ?>
            <form method="post" action="<?= BASE_URL(); ?>cpedidos/editarPedido/<?= $row->idPedido ?>">
                <div class="acao">
                    <input type="reset" value="Cancelar" class="button" />
                    <input type="submit" class="button" name="btSalvarPedido" value="Salvar pedido" />
                </div>	
                <div class="itemEsquerda">

                    <div class="item">
                        <label>Código</label><br />
                        <input type="text" name="idPedido" id="idPedido" value="<?= $row->idPedido ?>" readonly="readonly" class="inputSmall"/>
                    </div>

                    <div class="item">
                        <label>Data pedido</label><br />
                        <input type="text" name="dataPedido" id="dataPedido" value="<?= date('d/m/Y', strtotime($row->dataCriacao)) ?>" class="inputSmall"/>
                    </div>

                </div>

                <div class="itemDireita">
                    <label>Situação</label><br />
                    <select name='status' id='status' class="selectSmall">
                        <option value=""> Selecione </option>
                        <option value="Em Andamento" <?= ($row->status == "Em Andamento") ? "selected" : "" ?>> Em Andamento</option>
                        <option value="Aguardando Pagamento" <?= ($row->status == "Aguardando Pagamento") ? "selected" : "" ?>> Aguardando Pagamento</option>
                        <option value="Finalizado" <?= ($row->status == "Finalizado") ? "selected" : "" ?>> Finalizado</option>
                        <option value="Entregue" <?= ($row->status == "Entregue") ? "selected" : "" ?>> Entregue</option>
                    </select>
                </div>

        </div>
    </form>
    <br/>
    


    <form method="post" action="">

       


        <table class="tabela">
            <thead>
            <td>Código</td>
            <td>Produto</td>
            <td>Valor</td>
            <td>Frete</td>
            </thead>

            <? foreach ($itensPedido as $item) { ?>
                <tr class="linha">
                    <td><?= $item->idPedido ?></td>
                    <td><?= $item->nome ?></td>
                    <td><?= $item->valor ?></td>
                    <td><?= $item->frete ?></td>
                    
                </tr>
            <? } ?>
        </table>
        <br/>
    </form>

<? } ?>
</div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>