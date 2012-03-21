<?
$this->load->view('conta/conta');
?>
<div id="conteudoAdmin">
    <div class="formulario">
        <h2> Leilões arrematados </h2>
        <br/><br/><br/><br/>
        <table class="tabela_arrematados">
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
                    <td>Iniciado em <br/> <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?> <br/><br/> 
                        Finalizado em <br/> <?= date("d/m/Y H:i:s", strtotime($leilao->dataFim))  ?> </td>
                    <td>Valor de mercado <br/> <?=  'R$ ' . number_format($leilao->valorProduto, 2, ',', '.'); ?> </br><br/>
                        Vendido por: <br/> <?= 'R$ ' . number_format($leilao->valorArremate, 2, ',', '.'); ?>
                    </td>
                    <td> Arrematado por<br/><b><?=$leilao->login?></b> <br/> com <?=$leilao->qtdeLances?> lance(s) </td>
                    <td> <input type="button" name="efetuarPagamento" id="efetuarPagameto" class="button" value="Pagar"/> </td>
                </tr>
              <?}?>
         </table>
    </div>
</div>
</body>
</html>
