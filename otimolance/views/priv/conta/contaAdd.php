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
        <h2>Novo cadastro de usuários do sistema</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="salvarNovaConta">
                <div class="item">
                    <label>Nome</label><br />
                    <input type="text" name="txtNome" id="txtNome" value="" class="input"/>
                </div>
            
                <div class="item">
                    <label>Sobrenome</label><br />
                    <input type="text" name="txtSobrenome" id="txtSobrenome" value="" class="input"/>
                </div>

                <div class="item">
                    <label>Cpf</label><br />
                    <input type="text" name="txtCpf" id="txtCpf" value="" class="input"/>
                </div>

                <div class="item">
                    <label>Login</label><br />
                    <input type="text" name="txtLogin" id="txtLogin" value="" class="input"/>
                </div>

                <div class="item">
                    <label>E-Mail</label><br />
                    <input type="text" name="txtEmail" id="txtEmail" value="" class="input"/>
                </div>

                <div class="item">
                    <label>Repetir E-Mail</label><br />
                    <input type="text" name="txtRepetirEmail" id="txtRepetirEmail" value="" class="input"/>
                </div>

                <div class="item">
                    <label>Senha</label><br />
                    <input type="password" name="txtSenha" id="txtSenha" value="" class="input"/>
                </div>

                <div class="item">
                    <label>Repetir Senha</label><br />
                    <input type="password" name="txtRepetirSenha" id="txtRepetirSenha" value="" class="input"/>
                </div>

                <div class="item">
                    <label>Tipo de Conta</label><br />
                    <select name='idTipoUsuario' id='idTipoUsuario' class="select">
                        <option value=""> Selecione </option>
                        <?
                        if (count($tiposUsuario)) {
                            foreach ($tiposUsuario as $key) {
                                echo "<option value='" . $key->idTipoUsuario . "'>" . $key->tipoUsuario . "</option>";
                            }
                        }
                        ?>
                    </select>
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

