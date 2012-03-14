

<table class="tabela">
            
            
            <? foreach ($leiloesArrematados as $leilao) {  ?>
                <tr class="linha">
                    
                    <td>
                        
                        <? if ($leilao->caminho != "") { ?>
                            <img width="50px" height="80px" src="<?= base_url() ?>upload/produtos/<?= $leilao->caminho ?>"/>
                        <? } else { ?>
                            <img width="50px" height="80px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                        <? } ?>
                    </td>
                    <td><?=$leilao->nome?></td>
                    <td>Iniciado em <br/> <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?> <br/><br/> 
                        Finalizado em <br/> <?= date("d/m/Y H:i:s", strtotime($leilao->dataFim))  ?> </td>
                    <td>Valor de mercado <br/> <?=  'R$ ' . number_format($leilao->valorProduto, 2, ',', '.'); ?> </br><br/>
                        Vendido por: <br/> <?= 'R$ ' . number_format($leilao->valorArremate, 2, ',', '.'); ?>
                    </td>
                    <td> Arrematado por :<br/><?=$leilao->login?> <br/> com <?=$leilao->qtdeLances?> lance(s) </td>
                    
                </tr>
              <?}?>
         </table>
