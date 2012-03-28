<?
$this->load->view('conta/conta');
?>
<div id="conteudoAdmin">
    <div class="formulario">
        <h2>Extrato de Lances</h2>
        <br/><br/>
        <table class="tabela_arrematados">
            <thead>
                <td>Data</td>
                <td>Lances Adquiridos</td>
                <td>Tipo</td>
            </thead>
            
            <? foreach ($extrato as $extrato) { ?>
                <tr class="linha">
                    <td><?= date("d/m/Y H:i:s", strtotime($extrato->dataCadastro)) ?></td>
                    <td><?=$extrato->qtdeLances?></td>
                    <td><?=$extrato->tipo?></td>
                </tr>
            <?}?>
        </table>
        <br/>
    </div>
</div>
</body>
</html>
