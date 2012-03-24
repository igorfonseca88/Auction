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
                <input type="text" name="txtCpf" id="txtCpf" value="<?echo $_POST['txtCpf']; ?>" class="inputSmall"/>
                <label><font color="#FF0000">Somente números.</font></label><label><font size="1"> Só será permitido um cadastro por CPF. <br />Atenção: Verifique se os dados cadastrados estão corretos. Caso seja identificada alguma divergência, no caso de arremate e/ou compra de produtos, a entrega poderá ser prejudicada.</font></label>
            </div>

            <h2>Dados de Acesso</h2> 
            <div>
                <div class="item" style="float: left; width: 260px;">
                    <label><font color="#FF0000">*</font> Login</label><br />
                    <input type="text" name="txtLogin" id="txtLogin" value="<?echo $_POST['txtLogin']; ?>" class="inputSmall"/>
                </div>
                <div style="float: left; margin-top: 25px; color: #FF0000;"><label><font size="1">O login deve possuir no mínimo 5 caracteres.</font></label></div>
            </div>
            
            <div class="item" style="float: left;">
                <label><font color="#FF0000">*</font> E-Mail</label><br />
                <input type="text" name="txtEmail" id="txtEmail" value="<?echo $_POST['txtEmail']; ?>" class="input"/>
            </div>

            <div class="item" style="float: left;">
                <label><font color="#FF0000">*</font> Repetir E-Mail</label><br />
                <input type="text" name="txtRepetirEmail" id="txtRepetirEmail" value="<?echo $_POST['txtRepetirEmail']; ?>" class="input"/>
            </div>

            <div style="float: left;">
                <div class="item" style="float: left; width: 260px;">
                    <label><font color="#FF0000">*</font> Senha</label><br />
                    <input type="password" name="txtSenha" id="txtSenha" value="" class="inputSmall"/>
                </div>
                <div style="float: left; margin-top: 25px; color: #FF0000;"><label><font size="1">Mínimo de 6 caracteres.</font></label></div>
            </div>
            
            <div style="float: left;"> 
                <div class="item" style="float: left; width: 260px;">
                    <label><font color="#FF0000">*</font> Repetir Senha</label><br />
                    <input type="password" name="txtRepetirSenha" id="txtRepetirSenha" value="" class="inputSmall"/>
                </div>
                <div style="float: left; margin-top: 25px; color: #FF0000;"><label><font size="1">Mínimo de 6 caracteres.</font></label></div>
            </div>
            
            <div class="item" style="float: left;">
                <input type="checkbox" name="checkReceberEmail" id="checkReceberEmail" value="1"/>&nbsp;&nbsp;
                <label>Quero receber e-mails do OtimoLance</label><br/><br/>
            </div>         

            <div class="item" style="float: left;">
                <input type="checkbox" name="checkAceitarTermo" id="checkAceitarTermo" value="1" onchange="showHideFinalizarConta()"/>&nbsp;&nbsp
                <label>Eu li e aceito os </label><label><font color="#00FF00"><a href="javascript:abrirTermosCondicoes('http://localhost/otimolance/contaController/termosCondicoes');">Termos e Condições</a></font></label><label> de uso do OtimoLance</label>
            </div>

            <div class="acao" style="float: left;">
                <input type="submit" class="button" name="btFinalizar" id="btFinalizar" value="Finalizar" disabled="disabled"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>

