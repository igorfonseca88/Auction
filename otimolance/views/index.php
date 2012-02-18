<?
$this->load->view('_padrao/topo');
?>

<div class="formulario">

    <h2>Listagem de leilões</h2>


    <? foreach ($leiloes as $leilao) { ?>

        <div class="galeria_lista" id="produto<?= $leilao->idLeilao ?>">
            <p>Produto: <?= $leilao->nome ?></p>
            <p>Leilão nº <?= $leilao->idLeilao ?> - Início <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?></p>
            <div class="galeria_img">
                <a href="<?= base_url() ?>leiloes/<?= $leilao->idLeilao ?>-<?= $leilao->nome ?>.html">
                    <img width="130px" height="180px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                </a> 
            </div>

            <p id="cronometro<?= $leilao->idLeilao ?>"><?= $leilao->tempoCronometro ?></p>
            <p id="valorLance<?= $leilao->idLeilao ?>"></p>
            <p id="usuLance<?= $leilao->idLeilao ?>"></p>

            <?
            if ($this->session->userdata("logged") && $this->session->userdata("idTipoUsuario") == Conta_model::TU_CLIENTE) {
                ?>
                <input type="button" name="lance" id="lance" value="Lance" onclick="lance(<?=$leilao->idLeilao?>,<?=$this->session->userdata("idConta")?>)"/>
            <? } else { ?>
                <input type="button" name="autenticar" id="autenticar" value="Autenticar" onclick="location.href='<?= base_url() ?>clientes/autenticar'"/>
            <? } ?>

        </div>

    <? } ?>
</div>
</div>
</body>
</html>