<script> var detalhe = "";</script>
<?php
$this->load->view('_padrao/topo');
?>
<!--Conteúdo-->
<div id="conteudo">
    <div class="conteudo">

        <h2> Veja os leilões e dê um ótimo lance!</h2>

        

        <? foreach ($leiloes as $leilao) { ?>
            <input type="hidden" name="painel" class="LeilaoOnline" id="leilao<?= $leilao->idLeilao ?>" value="<?= $leilao->idLeilao ?>"/>
            <input type="hidden" id="leilaoinfo_<?= $leilao->idLeilao ?>" value=""/>
            <input type="hidden" id="leilaotipo_<?= $leilao->idLeilao ?>" value="S"/>

            <!--Leilão a iniciar-->
            <div class="itemLeilao iniciar">
                <p class="cents">1¢</p>
                <div class="itemProduto">
                    <p class="produto"><?= $leilao->nome ?></p>
                    <a href="<?= base_url() ?>leiloes/<?= $leilao->idLeilao ?>-<?= $leilao->nome ?>.html">
                        <? if ($leilao->caminho != "") { ?>
                            <img width="130px" height="180px" src="<?= base_url() ?>upload/produtos/<?= $leilao->caminho ?>"/>
                        <? } else { ?>
                            <img width="130px" height="180px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                        <? } ?>
                    </a>
                    <p class="inicio">Leilão nº <?= $leilao->idLeilao ?> - Início <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?></p>
                </div>
                
                
                
                
                <p class="usuario" id="L_UltimoLogin_<?= $leilao->idLeilao ?>"></p>
                <div id="LeilaoOnline_UltimoTempo_<?= $leilao->idLeilao ?>" style="display:none;"></div>
                <div id="L_Tempo_<?= $leilao->idLeilao ?>">--:--:--</div>
                <p id="L_Fixador_<?= $leilao->idLeilao ?>" style="display:none;"></p>
                <p class="valor" id="L_UltimoValor_<?= $leilao->idLeilao ?>"></p>
                <div id="boxBtn_<?= $leilao->idLeilao ?>">
                    <?
                    if ($this->session->userdata("logged") && $this->session->userdata("idTipoUsuario") == Conta_model::TU_CLIENTE) {
                        ?>
                        <input type="button" name="lance" class="lance" id="lance" value="Lance" onclick="lance(<?= $leilao->idLeilao ?>,<?= $this->session->userdata("idConta") ?>)"/>
                    <? } else { ?>
                        <input type="button" name="autenticar" id="autenticar" value="Autenticar" onclick="location.href='<?= base_url() ?>clientes/autenticar'"/>
                    <? } ?>
                </div>
            </div>

        

    

<? } ?>
            

<?php
$this->load->view('_paginas/leiloesArrematados');
?>
            
            </div>
</div>

</body>
</html>