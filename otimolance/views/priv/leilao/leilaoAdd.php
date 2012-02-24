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
                    <input type="text" name="horaInicio" id="horaInicio" value="" class="inputSmall"/>
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
                    <label>Valor leilão</label><br />
                    <select name='valorLeilao' id='valorLeilao' class="selectSmall">
                        <option value=""> Selecione </option>
                        <option value="1"> 1 centavo</option>
                        <option value="2"> 2 centavos</option>
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
                
                <div class="item">
                    <label>Frete grátis ?</label><br />
                    <input type="checkbox" value="1" name="freteGratis" id="freteGratis"/>
                        
                </div>
                
            </div>
         

        </form>

    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>