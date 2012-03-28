<?
$this->load->view('conta/conta');
?>
<div id="conteudoAdmin">
    <div class="formulario">
        <h2> Leilões arrematados </h2>
        <br/><br/><br/><br/>
        <table class="tabela_arrematados">
            
            <tr>
                <td>Produto</td>
                <td>Data</td>
                <td>Valor</td>
                <td>Situação</td>
            </tr>
                
            
            <? foreach ($arrematados as $leilao) {  ?>
                <tr class="linha">
                    <td>
                        <?=$leilao->nome?><br /><br />
                        <? if ($leilao->caminho != "") { ?>
                            <img width="50px" height="80px" src="<?= base_url() ?>upload/produtos/<?= $leilao->caminho ?>"/>
                        <? } else { ?>
                            <img width="50px" height="80px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                        <? } ?>
                    </td>
                    <td><?= date("d/m/Y H:i:s", strtotime($leilao->dataPedido)) ?> </td>
                    <td><?= 'R$ ' . number_format($leilao->valorArremate + $leilao->frete, 2, ',', '.'); ?>
                    </td>
                    <td><?=$leilao->status?> </td>
                    <? if($leilao->status == "Em Andamento"){?>
                        <td> <a href="<?= BASE_URL(); ?>compraController/identificacao/<?=$leilao->idPedido?>">Pagamento</a> </td>
                    <?}?>
                </tr>
              <?}?>
         </table>
    </div>
</div>
</body>
</html>