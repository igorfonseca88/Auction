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
        
        
        <form method="post" action="<?= base_url() ?>cpedidos/pesquisarAction">
            <div class="item">
                <label>Situação</label><br />
                <select name='situacao' id='situacao' class="select">
                    <option value=""> Selecione </option>
                    <option value="Aguardando Pagamento" <?= $_POST["situacao"] == "Aguardando Pagamento" ? "selected" : "" ?>> Aguardando Pagamento</option>
                    <option value="Em Andamento" <?= $_POST["situacao"] == "Em Andamento" ? "selected" : "" ?>> Em Andamento</option>
                </select>
            </div>

            <div class="acao">
                <input type="submit" class="button" name="btPesquisar" value="Pesquisar" />
            </div>
        </form>   
        
        
        <h2>Listagem de Pedidos</h2>
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
         <div>
        <?=$paginacao;?>
    </div>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>
