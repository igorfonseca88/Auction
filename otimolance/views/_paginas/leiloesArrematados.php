<table class="tabela_arrematados">
    <? foreach ($leiloesArrematados as $leilao) {  ?>
        <tr class="linha">
            <td>
                <?=$leilao->nome?><br /><br />
                <? if ($leilao->caminho != "") { ?>
                    <img width="50px" height="80px" src="<?= base_url() ?>upload/produtos/<?= $leilao->caminho ?>"/>
                <? } else { ?>
                    <img width="50px" height="80px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                <? } ?>
            </td>
            <td>Iniciado em <br/> <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?> <br/><br/> 
                Finalizado em <br/> <?= date("d/m/Y H:i:s", strtotime($leilao->dataFim))  ?> </td>
            <td>Valor de mercado <br/> <?=  'R$ ' . number_format($leilao->valorProduto, 2, ',', '.'); ?> </br><br/>
                Vendido por: <br/> <?= 'R$ ' . number_format($leilao->valorArremate, 2, ',', '.'); ?>
            </td>
            <td> Arrematado por<br/><b><?=$leilao->login?></b> <br/> com <?=$leilao->qtdeLances?> lance(s) </td>
        </tr>
      <?}?>
 </table>