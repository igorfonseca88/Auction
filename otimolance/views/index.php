<?php
$this->load->view('_padrao/topo');
?>

<div class="formulario">

    <h2>Listagem de leilões</h2>


    <? foreach ($leiloes as $leilao) { ?>

        <div class="galeria_lista" id="leilao<?= $leilao->idLeilao ?>">
            <input type="hidden" name="painel" class="LeilaoOnline" id="leilao<?= $leilao->idLeilao ?>" value="<?= $leilao->idLeilao ?>"/>
            <input type="hidden" id="leilaoinfo_<?= $leilao->idLeilao ?>" value=""/>
            <input type="hidden" id="leilaotipo_<?= $leilao->idLeilao ?>" value="S"/>
             
            <p>Produto: <?= $leilao->nome ?></p>
            <p>Leilão nº <?= $leilao->idLeilao ?> - Início <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?></p>
            <div class="galeria_img">
                <a href="<?= base_url() ?>leiloes/<?= $leilao->idLeilao ?>-<?= $leilao->nome ?>.html">
                    <? 
                    if ($leilao->caminho != "") {?>
                    <img width="130px" height="180px" src="<?= base_url() ?>upload/produtos/<?=$leilao->caminho?>"/>
                    <?}else{?>
                    <img width="130px" height="180px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                    <?}?>
                </a> 
            </div>
            
            Início do Leilão: 
                                <br> 
                                <span id="L_DataInicio_<?= $leilao->idLeilao ?>">
									                               </span>
      
                          
          <p id="L_UltimoValor_<?= $leilao->idLeilao ?>"></p>    
          <p id="L_UltimoLogin_<?= $leilao->idLeilao ?>"></p>

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
                <input type="button" name="lance" id="lance" value="Lance" onclick="lance(<?=$leilao->idLeilao?>,<?=$this->session->userdata("idConta")?>)"/>
            <? } else { ?>
                <input type="button" name="autenticar" id="autenticar" value="Autenticar" onclick="location.href='<?= base_url() ?>clientes/autenticar'"/>
            <? } ?>
            </div>
        </div>

    <? } ?>
    
    
                
    
</div>
</div>
</body>
</html>