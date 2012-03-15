<script>
    var detalhe = "sim";
</script>

<?php
$this->load->view('_padrao/topo');
?>

<div id="conteudo">
    <div class="formulario">
    <h2>Meu painel de leilões</h2>
    
    <? foreach ($leilaoArray as $leilao) { ?>
        <div class="bloco1">
        
            <input type="hidden" name="painel" class="LeilaoOnline" id="leilao<?= $leilao->idLeilao ?>" value="<?= $leilao->idLeilao ?>"/>
            <input type="hidden" id="leilaoinfo_<?= $leilao->idLeilao ?>" value=""/>
            <input type="hidden" id="leilaotipo_<?= $leilao->idLeilao ?>" value="S"/>

            <p><?= $leilao->nome ?></p>
            <p>Leilão nº <?= $leilao->idLeilao ?></p>
            <div class="img_produto">
                <a href="<?= base_url() ?>leiloes/<?= $leilao->idLeilao ?>-<?= $leilao->nome ?>.html">
                    <? if ($leilao->caminho != "") { ?>
                        <img src="<?= base_url() ?>upload/produtos/<?= $leilao->caminho ?>"/>
                    <? } else { ?>
                        <img width="130px" height="180px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                    <? } ?>
                </a> 
            </div>
       
        </div>
    <div class="bloco2">
        
        <span id="L_DataInicio_<?= $leilao->idLeilao ?>">
        </span>

        Preço: <br/>
        <p id="L_UltimoValor_<?= $leilao->idLeilao ?>"></p>    <br/><br/>
        Último lance: <br/>
        <p id="L_UltimoLogin_<?= $leilao->idLeilao ?>"></p><br/><br/>

        <p id="L_Fixador_<?= $leilao->idLeilao ?>"></p>
        <div id="LeilaoOnline_UltimoTempo_<?= $leilao->idLeilao ?>" style="display:none;"></div>
        <div id="L_Tempo_<?= $leilao->idLeilao ?>">--:--:--</div>




        <input type="hidden" id="hcronometro<?= $leilao->idLeilao ?>" value="<?= $leilao->tempoCronometro ?>"/>
        <p id="valorLance<?= $leilao->idLeilao ?>"></p>
        <p id="usuLance<?= $leilao->idLeilao ?>"></p>
        <div id="boxBtn_<?= $leilao->idLeilao ?>">
            <?
            if ($this->session->userdata("logged") && $this->session->userdata("idTipoUsuario") == Conta_model::TU_CLIENTE) {
                ?>
                <input type="button" name="lance" id="lance" value="Lance" onclick="lance(<?= $leilao->idLeilao ?>,<?= $this->session->userdata("idConta") ?>)"/>
            <? } else { ?>
                <input type="button" name="autenticar" id="autenticar" value="Autenticar" onclick="location.href='<?= base_url() ?>clientes/autenticar'"/>
            <? } ?>
        </div>
    </div>
    <div class="bloco3">
        <p>Histórico de lances</p>
        <div id="L_LancesHistorico_<?= $leilao->idLeilao ?>"></div>
    </div>

    <? } ?>
    
     <?php
        $this->load->view('_paginas/leiloesArrematados');
        ?>
    
    </div>
</div>
</body>
</html>

