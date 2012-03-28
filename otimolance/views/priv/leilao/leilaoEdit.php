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
        <?= $sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <h2>Editar cadastro de leilão</h2>

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
                        <select name='horaInicio' id='horaInicio' class="selectSmall">
                            <option value="00:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "00:00:00" ? "selected" : "" ?>> 00:00 horas</option>
                            <option value="00:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "00:30:00" ? "selected" : "" ?>> 00:30 horas</option>
                            <option value="01:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "01:00:00" ? "selected" : "" ?>> 01:00 horas</option>
                            <option value="01:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "01:30:00" ? "selected" : "" ?>> 01:30 horas</option>
                            <option value="02:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "02:00:00" ? "selected" : "" ?>> 02:00 horas</option>
                            <option value="02:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "02:30:00" ? "selected" : "" ?>> 02:30 horas</option>
                            <option value="03:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "03:00:00" ? "selected" : "" ?>> 03:00 horas</option>
                            <option value="03:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "03:30:00" ? "selected" : "" ?>> 03:30 horas</option>
                            <option value="04:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "04:00:00" ? "selected" : "" ?>> 04:00 horas</option>
                            <option value="04:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "04:30:00" ? "selected" : "" ?>> 04:30 horas</option>
                            <option value="05:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "05:00:00" ? "selected" : "" ?>> 05:00 horas</option>
                            <option value="05:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "05:30:00" ? "selected" : "" ?>> 05:30 horas</option>
                            <option value="06:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "06:00:00" ? "selected" : "" ?>> 06:00 horas</option>
                            <option value="06:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "06:30:00" ? "selected" : "" ?>> 06:30 horas</option>
                            <option value="07:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "07:00:00" ? "selected" : "" ?>> 07:00 horas</option>
                            <option value="07:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "07:30:00" ? "selected" : "" ?>> 07:30 horas</option>
                            <option value="08:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "08:00:00" ? "selected" : "" ?>> 08:00 horas</option>
                            <option value="08:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "08:30:00" ? "selected" : "" ?>> 08:30 horas</option>
                            <option value="09:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "09:00:00" ? "selected" : "" ?>> 09:00 horas</option>
                            <option value="09:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "09:30:00" ? "selected" : "" ?>> 09:30 horas</option>
                            <option value="10:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "10:00:00" ? "selected" : "" ?>> 10:00 horas</option>
                            <option value="10:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "10:30:00" ? "selected" : "" ?>> 10:30 horas</option>
                            <option value="11:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "11:00:00" ? "selected" : "" ?>> 11:00 horas</option>
                            <option value="11:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "11:30:00" ? "selected" : "" ?>> 11:30 horas</option>
                            <option value="12:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "12:00:00" ? "selected" : "" ?>> 12:00 horas</option>
                            <option value="12:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "12:30:00" ? "selected" : "" ?>> 12:30 horas</option>
                            <option value="13:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "13:00:00" ? "selected" : "" ?>> 13:00 horas</option>
                            <option value="13:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "13:30:00" ? "selected" : "" ?>> 13:30 horas</option>
                            <option value="14:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "14:00:00" ? "selected" : "" ?>> 14:00 horas</option>
                            <option value="14:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "14:30:00" ? "selected" : "" ?>> 14:30 horas</option>
                            <option value="15:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "15:00:00" ? "selected" : "" ?>> 15:00 horas</option>
                            <option value="15:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "15:30:00" ? "selected" : "" ?>> 15:30 horas</option>
                            <option value="16:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "16:00:00" ? "selected" : "" ?>> 16:00 horas</option>
                            <option value="16:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "16:30:00" ? "selected" : "" ?>> 16:30 horas</option>
                            <option value="17:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "17:00:00" ? "selected" : "" ?>> 17:00 horas</option>
                            <option value="17:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "17:30:00" ? "selected" : "" ?>> 17:30 horas</option>
                            <option value="18:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "18:00:00" ? "selected" : "" ?>> 18:00 horas</option>
                            <option value="18:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "18:30:00" ? "selected" : "" ?>> 18:30 horas</option>
                            <option value="19:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "19:00:00" ? "selected" : "" ?>> 19:00 horas</option>
                            <option value="19:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "19:30:00" ? "selected" : "" ?>> 19:30 horas</option>
                            <option value="20:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "20:00:00" ? "selected" : "" ?>> 20:00 horas</option>
                            <option value="20:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "20:30:00" ? "selected" : "" ?>> 20:30 horas</option>
                            <option value="21:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "21:00:00" ? "selected" : "" ?>> 21:00 horas</option>
                            <option value="21:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "21:30:00" ? "selected" : "" ?>> 21:30 horas</option>
                            <option value="22:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "22:00:00" ? "selected" : "" ?>> 22:00 horas</option>
                            <option value="22:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "22:30:00" ? "selected" : "" ?>> 22:30 horas</option>
                            <option value="23:00:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "23:00:00" ? "selected" : "" ?> > 23:00 horas</option>
                            <option value="23:30:00" <?= date('H:i:s', strtotime($row->dataInicio)) == "23:30:00" ? "selected" : "" ?> > 23:30 horas</option>
                        </select>
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
                            <option value="0.01" <?= $row->valorLeilao == '0.01' ? "selected" : "" ?>> 1 centavo</option>
                            <option value="0.02" <?= $row->valorLeilao == '0.02' ? "selected" : "" ?>> 2 centavos</option>
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
                    <select name='idProduto' id='idProduto' class="select" <?= $row->publicado != 1 ? 'onchange="carregaDadosProduto(this.value)"' : "" ?> >
                        <option value=""> Selecione </option>
                        <?
                        if (count($produtos)) {
                            foreach ($produtos as $produto) {
                                ?>

                                <?
                                if ($produto->idProduto == $row->idProduto)
                                    echo "<option value='" . $produto->idProduto . "' selected>" . $produto->categoria . " - " . $produto->nome . "</option>";
                                else
                                    echo "<option value='" . $produto->idProduto . "'>" . $produto->categoria . " - " . $produto->nome . "</option>";
                            }
                            ?> 
    <? } ?>

                    </select>
                </div>

                <div class="item">
                    <label>Valor do produto</label><br />
                    <input type="text" name="valorProduto" id="valorProduto" value="<?= $row->valorProduto ?>" class="inputSmall"/>
                </div>

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