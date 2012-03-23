<?
$this->load->view('conta/conta');
?>
<br/>
<br/>
<div id="conteudoAdmin">
    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <h2>Dados Pessoais</h2>         
            <p><? echo $this->session->flashdata('sucesso'); ?></p>
            <form method="post" action="<?= BASE_URL(); ?>contaController/realizarAlteracaoDados">
            <? foreach ($conta as $row) { ?>
                <input type="hidden" name="idContah" id="idContah" value="<?= $row->idConta?>"/>
                <div class="item">
                    <label><font color="#FF0000">*</font> Sexo</label><br />
                    <select name='sexo' id='sexo' class="selectSmall">
                        <option value=""> Selecione </option>
                        <option value="Feminino" <?= $row->sexo == "Feminino" ? "selected" : "" ?>> Feminino</option>
                        <option value="Masculino" <?= $row->sexo == "Masculino" ? "selected" : "" ?>> Masculino</option>
                    </select>
                </div>

                <div class="item">
                    <label><font color="#FF0000">*</font> Data de Nascimento</label><br />
                    <input type="text" name="txtDataNascimento" id="txtDataNascimento" value="<?= date('d/m/Y', strtotime($row->dtNascimento)) ?>" class="inputSmall"/>
                </div>

                <h2>Meu Endereço</h2> 
                <div>
                    <div class="item" style="float: left; width: 260px;">
                        <label><font color="#FF0000">*</font> CEP</label>
                        <label><font color="#00FF00"><a href="javascript:abrir('http://m.correios.com.br/movel/buscaCep.do');">Não sei meu CEP</a></font></label><br />
                        <input type="text" name="txtCep" id="txtCep" value="<?= $row->cep ?>" class="inputSmall" onblur="return getEndereco()"/>
                    </div>
                    <div id="ScriptDiv" style="float: left; margin-top: 25px; color: #FF0000;"></div>
                </div>

                <div class="item" style="float: left;">
                    <label><font color="#FF0000">*</font> Logradouro</label><br />
                    <input type="text" name="txtLogradouro" id="txtLogradouro" value="<?= $row->logradouro ?>" class="input"/>
                </div>

                <div class="item" style="float: left;">
                    <label><font color="#FF0000">*</font> Número</label><br />
                    <input type="text" name="txtNumero" id="txtNumero" value="<?= $row->numero ?>" class="inputSmall"/>
                </div>

                <div class="item" style="float: left;">
                    <label> Complemento</label><br />
                    <input type="text" name="txtComplemento" id="txtComplemento" value="<?= $row->complemento ?>" class="input"/>
                </div>

                <div class="item"  style="float: left;">
                    <label><font color="#FF0000">*</font> Bairro</label><br />
                    <input type="text" name="txtBairro" id="txtBairro" value="<?= $row->bairro ?>" class="input"/>
                </div>

                <div class="item" style="float: left;">
                    <label><font color="#FF0000">*</font> Estado</label><br />
                    <select name='estado' id='estado' class="selectSmall">
                        <option value=""> Selecione </option>
                        <option value="MS" <?= $row->estado == "MS" ? "selected" : "" ?>> MS</option>
                        <option value="MT" <?= $row->estado == "MT" ? "selected" : "" ?>> MT</option>
                    </select>
                </div>

                <div class="item" style="float: left;">
                    <label> Cidade</label><br />
                    <input type="text" name="txtCidade" id="txtCidade" value="<?= $row->cidade ?>" class="input"/>
                </div>

                <h2>Meus Contatos</h2> 
                <div class="item" style="float: left;">
                    <label><font color="#FF0000">*</font> Telefone</label><br />
                    <input type="text" name="txtTelefone" id="txtTelefone" value="<?= $row->telefone ?>" class="inputSmall"/>
                </div>

                <div class="item" style="float: left;">
                    <label> Celular</label><br />
                    <input type="text" name="txtCelular" id="txtCelular" value="<?= $row->celular ?>" class="inputSmall"/>
                </div>

                <div class="item" style="float: left;">
                    <label><font color="#FF0000">*</font> E-Mail</label><br />
                    <input type="text" name="txtEmail" id="txtEmail" value="<?= $row->email ?>" class="input"/>
                </div>

                <div class="item" style="float: left;">
                    <label><font color="#FF0000">*</font> Repetir E-Mail</label><br />
                    <input type="text" name="txtRepetirEmail" id="txtRepetirEmail" value="<?= $row->email ?>" class="input"/>
                </div>

                <div class="acao" style="float: left;">
                    <input type="submit" class="button" name="btSalvar" value="Salvar Dados" />
                </div>
            <? } ?>
        </form> 
    </div>
</div>
</body>
</html>
