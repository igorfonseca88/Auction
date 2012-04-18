<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">
    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="/otimolance/">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>contaController/">Listagem de Usuários do Sistema</a> &raquo; Nova conta</span>
    </div>
    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <h2>Novo cadastro de usuários do sistema</h2>
        <form method="post" action="salvarNovaConta">
            <div class="item">
                <label>Tipo de Conta</label><br />
                <select name='idTipoUsuario' id='idTipoUsuario' class="selectSmall">
                    <option value="<?echo $_POST['idTipoUsuario']; ?>"> Selecione </option>
                    <?
                    if (count($tiposUsuario)) {
                        foreach ($tiposUsuario as $key) {
                            if ($key->idTipoUsuario == $_GET['idTipoUsuario'])
                                echo "<option value='" . $key->idTipoUsuario . "'selected>" . $key->tipoUsuario . "</option>";
                                else
                                echo "<option value='" . $key->idTipoUsuario . "'>" . $key->tipoUsuario . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="item">
                <label>Nome</label><br />
                <input type="text" name="txtNome" id="txtNome" value="<?echo $_POST['txtNome']; ?>" class="input"/>
            </div>

            <div class="item">
                <label>Sobrenome</label><br />
                <input type="text" name="txtSobrenome" id="txtSobrenome" value="<?echo $_POST['txtSobrenome']; ?>" class="input"/>
            </div>

            <div class="item">
                <label>Cpf</label><br />
                <input type="text" name="txtCpf" id="txtCpf" value="<?echo $_POST['txtCpf']; ?>" class="inputSmall"/>
            </div>

            <div class="item">
                <label>Login</label><br />
                <input type="text" name="txtLogin" id="txtLogin" value="<?echo $_POST['txtLogin']; ?>" class="inputSmall"/>
            </div>

            <div class="item">
                <label>E-Mail</label><br />
                <input type="text" name="txtEmail" id="txtEmail" value="<?echo $_POST['txtEmail']; ?>" class="input"/>
            </div>

            <div class="item">
                <label>Repetir E-Mail</label><br />
                <input type="text" name="txtRepetirEmail" id="txtRepetirEmail" value="<?echo $_POST['txtRepetirEmail']; ?>" class="input"/>
            </div>

            <div class="item">
                <label>Senha</label><br />
                <input type="password" name="txtSenha" id="txtSenha" value="" class="inputSmall"/>
            </div>

            <div class="item">
                <label>Repetir Senha</label><br />
                <input type="password" name="txtRepetirSenha" id="txtRepetirSenha" value="" class="inputSmall"/>
            </div>

            <div class="acao">
                <input type="button" value="Cancelar" class="button" />
                <input type="submit" class="button" name="btSalvarConta" value="Salvar Conta" />
            </div>
        </form>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>

