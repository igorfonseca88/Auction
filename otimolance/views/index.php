<?
$this->load->view('_padrao/topo');
?>


            <div class="formulario">

                <h2>Listagem de leilões</h2>


                <? foreach ($leiloes as $leilao) { ?>

                    <div class="galeria_lista">
                        <p>Produto: <?= $leilao->nome ?></p>
                        <p>Leilão nº <?= $leilao->idLeilao ?> - Início <?= date("d/m/Y H:i:s", strtotime($leilao->dataInicio)) ?></p>
                        <div class="galeria_img">
                            <a href="<?= base_url() ?>leiloes/<?= $leilao->idLeilao ?>-<?= $leilao->nome ?>.html">
                                <img width="130px" height="180px" src="<?= base_url() ?>img/imagem_nao_cadastrada.jpg"/>
                            </a> 
                        </div>
                    </div>

                <? } ?>
            </div>
        </div>
    </body>
</html>