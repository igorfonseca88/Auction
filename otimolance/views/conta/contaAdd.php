<?
$this->load->view('_padrao/topo');
?>
<br/>
<br/>
<div id="conteudoAdmin">
    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <h2>Dados Pessoais</h2>        
        <form method="post" action="<?= BASE_URL(); ?>contaController/salvarClienteSite">
            <div class="item">
                <label><font color="#FF0000">*</font> Nome</label><br />
                <input type="text" name="txtNome" id="txtNome" value="<?echo $_POST['txtNome']; ?>" class="input"/>
            </div>

            <div class="item">
                <label><font color="#FF0000">*</font> Sobrenome</label><br />
                <input type="text" name="txtSobrenome" id="txtSobrenome" value="<?echo $_POST['txtSobrenome']; ?>" class="input"/>
            </div>

            <div class="item">
                <label><font color="#FF0000">*</font> Cpf</label><br />
                <input type="text" name="txtCpf" id="txtCpf" value="<?echo $_POST['txtCpf']; ?>" class="input"/>
                <label><font size="1">Somente números. Só será permitido um cadastro por CPF. <br />Atenção: Verifique se os dados cadastrados estão corretos. Caso seja identificada alguma divergência, no caso de arremate e/ou compra de produtos, a entrega poderá ser prejudicada.</font></label>
            </div>

            <h2>Dados de Acesso</h2> 
            <div class="item">
                <label><font color="#FF0000">*</font> Login</label><br />
                <input type="text" name="txtLogin" id="txtLogin" value="<?echo $_POST['txtLogin']; ?>" class="input"/>
            </div>

            <div class="item">
                <label><font color="#FF0000">*</font> E-Mail</label><br />
                <input type="text" name="txtEmail" id="txtEmail" value="<?echo $_POST['txtEmail']; ?>" class="input"/>
            </div>

            <div class="item">
                <label><font color="#FF0000">*</font> Repetir E-Mail</label><br />
                <input type="text" name="txtRepetirEmail" id="txtRepetirEmail" value="<?echo $_POST['txtRepetirEmail']; ?>" class="input"/>
            </div>

            <div class="item">
                <label><font color="#FF0000">*</font> Senha</label><br />
                <div><label><font size="1">Mínimo de 6 caracteres.</font></label></div>
                <input type="password" name="txtSenha" id="txtSenha" value="" class="input"/>
            </div>

            <div class="item">
                <label><font color="#FF0000">*</font> Repetir Senha</label><br />
                <div><label><font size="1">Mínimo de 6 caracteres.</font></label></div>
                <input type="password" name="txtRepetirSenha" id="txtRepetirSenha" value="" class="input"/>
            </div>

            <div class="item">
                <label>Quero receber e-mails do OtimoLance</label><br />
                <input type="checkbox" name="checkReceberEmail" id="checkReceberEmail" value="1" class="input"/>
            </div>

            <div class="item">
                <label>Eu li e aceito os Termos e Condições de uso do OtimoLance</label><br />
                <input type="checkbox" name="checkAceitarTermo" id="checkAceitarTermo" value="1" class="input"/>
            </div>

            <div class="acao">
                <input type="submit" class="button" name="btFinalizar" value="Finalizar" />
            </div>
        </form>
    </div>
</div>

