<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">

    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= BASE_URL(); ?>/area-restrita">Principal</a> &raquo; Parâmetros do sistema</span>
    </div>

    <div class="formulario">
        <h2>Parâmetros do sistema</h2>
        <?= $sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>

        <? foreach ($parametros as $parametro) { ?>
            <form method="post" action="<?= BASE_URL(); ?>cparametro/salvarParametro/<?= $parametro->idParametro ?>">
                <div class="acao">
                    <input type="reset" value="Cancelar" class="button" />
                    <input type="submit" class="button" name="btSalvarParametros" value="Salvar parâmetros"  />
                </div>	
                <div class="itemEsquerda">

                    <div class="item">
                        <label>Núm. lances para novo cadastro</label><br />
                        <input type="text" name="numLancesNovoCadastro" id="numLancesNovoCadastro" value="<?= $parametro->numLancesNovoCadastro ?>" class="inputSmall"/>
                    </div>

                    <div class="item">
                        <label>Máximo de IPs por cadastro</label><br />
                        <input type="text" name="maxIp" id="maxIp" value="<?= $parametro->maxIp ?>" class="inputSmall"/>
                    </div>

                    <div class="item">
                        <label>E-mail remetente</label><br />
                        <input type="text" name="emailRemetente" id="emailRemetente" value="<?= $parametro->emailRemetente ?>" class="inputSmall"/>
                    </div>

                    <div class="item">
                        <label>Smtp host</label><br />
                        <input type="text" name="smtp_host" id="smtp_host" value="<?= $parametro->smtp_host ?>" class="inputSmall"/>
                    </div>

                    <div class="item">
                        <label>Smtp porta</label><br />
                        <input type="text" name="smtp_port" id="smtp_port" value="<?= $parametro->smtp_port ?>" class="inputSmall"/>
                    </div>

                    <div class="item">
                        <label>Smtp usuário</label><br />
                        <input type="text" name="smtp_user" id="smtp_user" value="<?= $parametro->smtp_user ?>" class="inputSmall"/>
                    </div>

                    <div class="item">
                        <label>Smtp senha</label><br />
                        <input type="password" name="smtp_pass" id="smtp_pass" value="<?= $parametro->smtp_pass ?>" class="inputSmall"/>
                    </div>
                    
                    <div class="item">
                        <label>Padrão e-mail cadastro</label><br />
                        <textarea class="textarea" id="padraoEmailConfirmarCadastro" name="padraoEmailConfirmarCadastro" rows="10" cols="60"><?= $parametro->padraoEmailConfirmarCadastro ?></textarea>
                    </div>

                     <div class="item">
                        <label>Padrão cadastro confirmado</label><br />
                        <textarea class="textarea" id="padraoEmailCadastroConfirmado"name="padraoEmailCadastroConfirmado" rows="10" cols="60"><?= $parametro->padraoEmailCadastroConfirmado ?></textarea>
                    </div>
                    
                    <div class="item">
                        <label>Padrão recuperar senha</label><br />
                        <textarea class="textarea" id="padraoEmailRecuperarSenha"name="padraoEmailRecuperarSenha" rows="10" cols="60"><?= $parametro->padraoEmailRecuperarSenha ?></textarea>
                    </div>
                    
                </div>

            </form>
        <? } ?>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>