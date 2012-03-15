<?
$this->load->view('conta/conta');
?>	
<div id="conteudo">
    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <h2>Alterar Senha</h2>
        <label>Para sua segurança, troque sua senha periodicamente. O mínimo de 6 caracteres para uma senha é exigido.</label>
        <br /><br />
        <form method="post" action="<?= BASE_URL(); ?>contaController/alterarSenha">
                <div class="item">
                    <label><font color="#FF0000">*</font> Senha Atual</label><br />
                    <input type="password" name="txtSenhaAtual" id="txtSenhaAtual" value="" class="input"/>
                </div>
            
                <div class="item">
                    <label><font color="#FF0000">*</font> Nova Senha</label><br />
                    <input type="password" name="txtNovaSenha" id="txtNovaSenha" value="" class="input"/>
                </div>

                <div class="item">
                    <label><font color="#FF0000">*</font> Repetir Nova Senha</label><br />
                    <input type="password" name="txtRepetirNovaSenha" id="txtRepetirNovaSenha" value="" class="input"/>
                </div>

                <div class="acao">
                    <input type="submit" class="button" name="btEnviar" value="Concluir" />
                </div>
        </form>
    </div>
</div>
</body>
</html>