<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= BASE_URL(); ?>/area-restrita">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>leilaoController">Listagem de leilões</a> &raquo; Editar cadastro de leilão</span>
    </div>

    <div class="formulario">
        <h2>Editar cadastro de leilão</h2>
        <?= $sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>

        <? foreach ($leilao as $row) { ?>
            <form method="post" action="<?= BASE_URL(); ?>leilaoController/editarLeilao/<?= $row->idLeilao ?>">
                <div class="acao">
                    <input type="reset" value="Cancelar" class="button"<?= $row->publicado == 1 ? "disabled" : "" ?> />
                    <input type="submit" class="button" name="btSalvarLeilao" value="Salvar leilão" <?= $row->publicado == 1 ? "disabled" : "" ?> />
                    <input type="button" class="button" onclick="location.href='<?= BASE_URL(); ?>leilaoController/publicarLeilao/<?= $row->idLeilao ?>'" name="btPublicarLeilao" value="Publicar leilão" <?= ($row->publicado == 1) ? "disabled" : "" ?> />
                </div>	
                <div class="itemEsquerda">
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
                        <select name='tempoCronometro' id='tempoCronometro' class="selectSmall">
                            <option value=""> Selecione </option>
                            <option value="15" <?= $row->tempoCronometro == '15' ? "selected" : "" ?>> 15 segundos</option>
                            <option value="20" <?= $row->tempoCronometro == '20' ? "selected" : "" ?>> 20 segundos</option>
                            <option value="25" <?= $row->tempoCronometro == '25' ? "selected" : "" ?>> 25 segundos</option>
                            <option value="30" <?= $row->tempoCronometro == '30' ? "selected" : "" ?>> 30 segundos</option>
                        </select>
                    </div>
                </div>
                <div class="itemDireita">
                    <div class="item">
                        <label>Valor leilão</label><br />
                        <select name='valorLeilao' id='valorLeilao' class="selectSmall">
                            <option value=""> Selecione </option>
                            <option value="1" <?= $row->valorLeilao == '1' ? "selected" : "" ?>> 1 centavo</option>
                            <option value="2" <?= $row->valorLeilao == '2' ? "selected" : "" ?>> 2 centavos</option>
                        </select>
                    </div>


                    <div class="item">
                        <label>Categoria do leilão</label><br />
                        <select name='idCategoriaLeilao' id='idCategoriaLeilao' class="selectSmall">
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

                    <div class="item">
                        <label>Frete grátis ?</label><br />
                        <input type="checkbox" value="1" name="freteGratis" id="freteGratis" <?= $row->freteGratis == 1 ? "checked" : "" ?>/>
                    </div>
                </div>
            </form>
            <br/>
            <h2>Produto</h2>

            <form method="post" action="<?= BASE_URL(); ?>leilaoController/salvarItemLeilao/<?= $row->idLeilao ?>">

                <div class="acao">
                    <input type="submit" class="button" name="btIncluir" value="Salvar produto" <?= $row->publicado == 1 ? "disabled" : "" ?> />
                </div>		

                <input type="hidden" name="hItemLeilao" id="hItemLeilao" value="<?= $row->idItemLeilao ?>" />    

                <div class="item">
                    <label>Nome produto</label><br />
                    <?
                    if (count($produtos)) {
                        foreach ($produtos as $produto) {
                            ?>
                            <select name='idProduto' id='idProduto' class="select" <?= $row->publicado != 1 ? 'onchange="carregaDadosProduto(this.value)"' : "" ?> >
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
            <? if ($lances != "") { ?>
                <br/>
                <h2>Histórico de lances </h2>
                <br/>
                <table class="tabela">
                    <thead>
                    <td>Data</td>
                    <td>Nome</td>
                    <td>Valor</td>
                    </thead>

                    <? foreach ($lances as $lance) { ?>

                        <tr class="linha">
                            <td> <?= date('d/m/Y', strtotime($lance->data)) ?> </td>
                            <td> <?= $lance->nome ?> </td>
                            <td> <?= $lance->valor ?> </td>
                        </tr>

                    <? } ?>
                </table>
            <? } ?>
<br/><br/>
        <? } ?>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>