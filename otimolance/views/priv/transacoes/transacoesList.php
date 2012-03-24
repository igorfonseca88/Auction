<?
$this->load->view('priv/_inc/superior');
?>
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= base_url() ?>">Principal</a> &raquo; Listagem de Transações</span>
    </div>

    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <?= $alerta != "" ? '<div class="warning"> ' . $alerta . ' </div>' : "" ?>
        
        <form method="post" action="<?= base_url() ?>notificacaoController/pesquisarAction">
            <div class="item">
                <div class="item">
                    <label>Data Início</label><br />
                    <input type="text" name="dataInicio" id="dataInicio" value="" class="inputSmall"/>
                </div>
            </div>

            <div class="item">
                <div class="item">
                    <label>Data Fim</label><br />
                    <input type="text" name="dataInicio" id="dataFim" value="" class="inputSmall"/>
                </div>
            </div>

            <div class="acao">
                <input type="submit" class="button" name="btPesquisar" value="Pesquisar" />
            </div>
        </form>  
        <? if (!is_null($transactions)) { ?>
        <h2>Listagem de Transações</h2>
        <table class="tabela">
            <thead>
                <td>Código</td>
                <td>Status</td>
                <td>Código do Pedido</td>
                <td>Valor Bruto</td>
            </thead>
                      
            <? foreach($transactions as $key => $transactionSummary) { ?>
                <tr class="linha">
                    <td><?=$transactionSummary->getCode()?></td>
                    <td><?=$transactionSummary->getStatus()->getTypeFromValue()?></td>
                    <td><?=$transactionSummary->getReference()?></td>
                    <td><?=$transactionSummary->getGrossAmount()?></td>
                </tr>
              <?}?>
         </table>
        <? } ?>
        <br/>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>
