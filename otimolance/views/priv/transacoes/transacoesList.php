<?
$this->load->view('priv/_inc/superior');
require_once "otimolance/models/Util.php";
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
        
        <form method="post" action="<?= base_url() ?>notificacaoController/processarEscolha">
            <input type="hidden" value="" id="optHidden" name="optHidden"/>
            <input type="hidden" value="" id="checkboxesChecked" name="checkboxesChecked"/>
            <div class="item">
                <div class="item">
                    <label>Data Início</label><br />
                    <input type="text" name="dataInicio" id="dataInicio" value="" class="date"/>
                </div>
            </div>

            <div class="item">
                <div class="item">
                    <label>Data Fim</label><br />
                    <input type="text" name="dataFim" id="dataFim" value="" class="date"/>
                </div>
            </div>

            <div class="acao">
                <input type="submit" class="button" name="btPesquisar" value="Pesquisar" onclick="document.getElementById('optHidden').value = 'pesquisar'"/>
                <input type="submit" class="button" name="btProcessar" value="Processar" onclick="document.getElementById('optHidden').value = 'processar'; verificarCheckbox();"/>
            </div>
            
             <? if (!is_null($transactions)) { ?>
        <h2>Listagem de Transações</h2>
        <table class="tabela">
            <thead>
            <td><input type="checkbox" name="selectAll" id="selectAll" onclick="selecionarTodos()"/> </td>
                <td>Código</td>
                <td>Status</td>
                <td>Código do Pedido</td>
                <td>Valor Bruto</td>
            </thead>
                      
            <? foreach($transactions as $key => $transactionSummary) { ?>
                <tr class="linha">
                    <td><input type="checkbox" class="checkbox" value="<?=$transactionSummary->getReference()?>"/> </td>
                    <td><?=$transactionSummary->getCode()?></td>
                    <td><?=Util::retornarStatusPTBRPorCodigo($transactionSummary->getStatus()->getValue())?></td>
                    <td><?=$transactionSummary->getReference()?></td>
                    <td><?=$transactionSummary->getGrossAmount()?></td>
                </tr>
              <?}?>
         </table>
        <? } ?>
        </form>  
       
        <br/>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>
