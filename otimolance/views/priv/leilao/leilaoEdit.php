<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= BASE_URL(); ?>/area-restrita">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>conta/leilaoController">Listagem de leilões</a> &raquo; Editar cadastro de leilão</span>
    </div>

    <div class="formulario">
        <h2>Editar cadastro de leilão</h2>
        <?= $sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>

        <? foreach ($leilao as $row) { ?>
            <form method="post" action="<?= BASE_URL(); ?>leilaoController/editarLeilao/<?= $row->idLeilao ?>">
                <div class="item">
                    <label>Data início</label><br />
                    <input type="text" name="dataInicio" id="dataInicio" value="<?= date('d/m/Y', strtotime($row->dataInicio)) ?>" class="inputSmall"/>
                </div>

                <div class="item">
                    <label>Hora início</label><br />
                    <input type="text" name="horaInicio" id="horaInicio" value="<?= date('H:i:s', strtotime($row->dataInicio)) ?>" class="inputSmall"/>
                </div>

                <div class="item">
                    <label>Tempo cronômetro</label><br />
                    <select name='tempoCronometro' id='tempoCronometro' class="select">
                        <option value=""> Selecione </option>
                        <option value="15" <?= $row->tempoCronometro == '15' ? "selected" : "" ?>> 15 segundos</option>
                        <option value="20" <?= $row->tempoCronometro == '20' ? "selected" : "" ?>> 20 segundos</option>
                        <option value="25" <?= $row->tempoCronometro == '25' ? "selected" : "" ?>> 25 segundos</option>
                        <option value="30" <?= $row->tempoCronometro == '30' ? "selected" : "" ?>> 30 segundos</option>
                    </select>
                </div>

                <div class="item">
                    <label>Valor leilão</label><br />
                    <select name='valorLeilao' id='valorLeilao' class="select">
                        <option value=""> Selecione </option>
                        <option value="1" <?= $row->valorLeilao == '1' ? "selected" : "" ?>> 1 centavo</option>
                        <option value="2" <?= $row->valorLeilao == '2' ? "selected" : "" ?>> 2 centavos</option>
                    </select>
                </div>


                <div class="item">
                    <label>Categoria do leilão</label><br />
                    <select name='idCategoriaLeilao' id='idCategoriaLeilao' class="select">
                        <option value=""> Selecione </option>
                        <?
                        if (count($categorias)) {
                            foreach ($categorias as $key) {
                                if ($key->idCategoriaLeilao == $row->idCategoriaLeilao)
                                    echo "<option value='" . $key->idCategoriaLeilao . "' selected>" . $key->categoriaLeilao . "</option>";
                                else
                                    echo "<option value='" . $key->idCategoriaLeilao . "'>" . $key->categoriaLeilao . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>


                <div class="acao">
                    <input type="button" value="Cancelar" class="button" />
                    <input type="submit" class="button" name="btSalvarLeilao" value="Salvar leilão" />
                    <input type="button" class="button" name="btPublicarLeilao" value="Publicar leilão" />
                </div>		


            </form>
            <br/>
            <h2>Produto</h2>

            <form method="post" action="<?= BASE_URL(); ?>leilaoController/salvarItemLeilao/<?= $row->idLeilao ?>">

                <div class="acao">
                    <input type="submit" class="button" name="btIncluir" value="Salvar produto" />
                </div>		

                <input type="hidden" name="hItemLeilao" id="hItemLeilao" value="<?= $row->idItemLeilao ?>" />    

                <div class="item">
                    <label>Nome produto</label><br />
                    <?
                    if (count($produtos)) {
                        foreach ($produtos as $produto) {
                            ?>
                            <select name='idProduto' id='idProduto' class="select" onchange="carregaDadosProduto(this.value)">
                                <option value=""> Selecione </option>

                                <?
                                if ($produto->idProduto == $row->idProduto)
                                    echo "<option value='" . $produto->idProduto . "' selected>" . $produto->categoria . " - " . $produto->nome . "</option>";
                                else
                                    echo "<option value='" . $produto->idProduto . "'>" . $produto->categoria . " - " . $produto->nome . "</option>";
                                ?>
                            </select>
                        </div>

                        <div class="item">
                            <label>Valor do produto</label><br />
                            <input type="text" name="valorProduto" id="valorProduto" value="<?= $row->valorProduto ?>" class="inputSmall"/>
                        </div>

                        <?
                    }
                }
                ?>

                <div class="item">
                    <label>Valor do frete</label><br />
                    <input type="text" name="valorFrete" id="valorFrete" value="<?= $row->valorFrete ?>" class="inputSmall"/>
                </div>

                <br/>
            </form>
        <? } ?>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>