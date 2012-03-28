<?
$this->load->view('conta/conta');
?>
<div id="conteudoAdmin">
    <div class="formulario">
        <h2>Histórico de Lances Utilizados</h2>
        <br/><br/>
        <table class="tabela_arrematados">
            <thead>
                <td>Produto</td>
                <td>Finalizado</td>
                <td>Nº de Lances</td>
            </thead>
            
            <? foreach ($lance as $lance) { ?>
                <tr class="linha">
                    <td><?=$lance->produto?></td>
                    <td><?= date("d/m/Y H:i:s", strtotime($lance->dataFim)) ?></td>
                    <td><?=$lance->qtde?></td>
                </tr>
            <?}?>
        </table>
        <br/>
    </div>
</div>
</body>
</html>
