<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/otimolance/conta/">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>leilaoController/">Listagem de leilões</a> &raquo; Novo leilão</span>
    </div>
    <div class="formulario">
        <h2>Novo cadastro de leilão</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="salvarNovoLeilao">
            <div class="acao">
                <input type="button" value="Cancelar" class="button" />
                <input type="submit" class="button" name="btSalvarLeilao" value="Salvar leilão" />
            </div>	
            <div class="itemEsquerda">
                <div class="item">
                    <label>Data início</label><br />
                    <input type="text" name="dataInicio" id="dataInicio" value="" class="inputSmall"/>
                </div>


                <div class="item">
                    <label>Hora início</label><br />
                    <select name='horaInicio' id='horaInicio' class="selectSmall">
                        <option value="00:00:00" > 00:00 horas</option>
                        <option value="00:30:00" > 00:30 horas</option>
                        <option value="01:00:00" > 01:00 horas</option>
                        <option value="01:30:00" > 01:30 horas</option>
                        <option value="02:00:00" > 02:00 horas</option>
                        <option value="02:30:00" > 02:30 horas</option>
                        <option value="03:00:00" > 03:00 horas</option>
                        <option value="03:30:00" > 03:30 horas</option>
                        <option value="04:00:00" > 04:00 horas</option>
                        <option value="04:30:00" > 04:30 horas</option>
                        <option value="05:00:00" > 05:00 horas</option>
                        <option value="05:30:00" > 05:30 horas</option>
                        <option value="06:00:00" > 06:00 horas</option>
                        <option value="06:30:00" > 06:30 horas</option>
                        <option value="07:00:00" > 07:00 horas</option>
                        <option value="07:30:00" > 07:30 horas</option>
                        <option value="08:00:00" > 08:00 horas</option>
                        <option value="08:30:00" > 08:30 horas</option>
                        <option value="09:00:00" > 09:00 horas</option>
                        <option value="09:30:00" > 09:30 horas</option>
                        <option value="10:00:00" > 10:00 horas</option>
                        <option value="10:30:00" > 10:30 horas</option>
                        <option value="11:00:00" > 11:00 horas</option>
                        <option value="11:30:00" > 11:30 horas</option>
                        <option value="12:00:00" > 12:00 horas</option>
                        <option value="12:30:00" > 12:30 horas</option>
                        <option value="13:00:00" > 13:00 horas</option>
                        <option value="13:30:00" > 13:30 horas</option>
                        <option value="14:00:00" > 14:00 horas</option>
                        <option value="14:30:00" > 14:30 horas</option>
                        <option value="15:00:00" > 15:00 horas</option>
                        <option value="15:30:00" > 15:30 horas</option>
                        <option value="16:00:00" > 16:00 horas</option>
                        <option value="16:30:00" > 16:30 horas</option>
                        <option value="17:00:00" > 17:00 horas</option>
                        <option value="17:30:00" > 17:30 horas</option>
                        <option value="18:00:00" > 18:00 horas</option>
                        <option value="18:30:00" > 18:30 horas</option>
                        <option value="19:00:00" > 19:00 horas</option>
                        <option value="19:30:00" > 19:30 horas</option>
                        <option value="20:00:00" > 20:00 horas</option>
                        <option value="20:30:00" > 20:30 horas</option>
                        <option value="21:00:00" > 21:00 horas</option>
                        <option value="21:30:00" > 21:30 horas</option>
                        <option value="22:00:00" > 22:00 horas</option>
                        <option value="22:30:00" > 22:30 horas</option>
                        <option value="23:00:00" > 23:00 horas</option>
                        <option value="23:30:00" > 23:30 horas</option>
                    </select>
                </div>

                <div class="item">
                    <label>Tempo cronômetro</label><br />
                    <select name='tempoCronometro' id='tempoCronometro' class="selectSmall">
                        <option value=""> Selecione </option>
                        <option value="15"> 15 segundos</option>
                        <option value="20"> 20 segundos</option>
                        <option value="25"> 25 segundos</option>
                        <option value="30"> 30 segundos</option>
                    </select>
                </div>
            </div>
            <div class="itemDireita">
                
                <div class="item">
                        <label>Valor mínimo leilão</label><br />
                        <input type="text" name="valorMinimoLeilao" id="valorMinimoLeilao" value="" class="inputSmall maskMoney"/>
                    </div>
                
                <div class="item">
                    <label>Valor leilão</label><br />
                    <select name='valorLeilao' id='valorLeilao' class="selectSmall">
                        <option value=""> Selecione </option>
                        <option value="0.01"> 1 centavo</option>
                        <option value="0.02"> 2 centavos</option>
                    </select>
                </div>


                <div class="item">
                    <label>Categoria do leilão</label><br />
                    <select name='idCategoriaLeilao' id='idCategoriaLeilao' class="selectSmall">
                        <option value=""> Selecione </option>
                        <?
                        if (count($categorias)) {
                            foreach ($categorias as $key) {
                                echo "<option value='" . $key->idCategoriaLeilao . "'>" . $key->categoriaLeilao . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

            </div>


        </form>

    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>