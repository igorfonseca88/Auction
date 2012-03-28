<?
$this->load->view('priv/_inc/superior');
?>	
<div id="conteudo">
    <div class="titulo">
        <h1>Olá <?= $this->session->userdata("login") ?> !</h1>
        <p><span><span>Você está em:</span> <a href="<?= BASE_URL(); ?>/area-restrita">Principal</a> &raquo; 
                <a href="<?= BASE_URL(); ?>contaController">Listagem de Usuários do Sistema</a> &raquo; Editar usuário do sistema</span>
    </div>

    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
        <h2>Editar usuário do sistema</h2>
        <p><? echo $this->session->flashdata('sucesso'); ?></p>
        <form method="post" action="<?= BASE_URL(); ?>contaController/editarConta">

            <? foreach ($conta as $row) { ?>
                <input type="hidden" name="idContah" id="idContah" value="<?= $row->idConta?>"/>
                <div class="item">
                    <label>Nome</label><br />
                    <input type="text" name="txtNome" id="txtNome" value="<?= $row->nome ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Sobrenome</label><br />
                    <input type="text" name="txtSobrenome" id="txtSobrenome" value="<?= $row->sobrenome ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Cpf</label><br />
                    <input type="text" name="txtCpf" id="txtCpf" value="<?= $row->cpf ?>" class="inputSmall"/>
                </div>

                <div class="item">
                    <label>Login</label><br />
                    <input type="text" name="txtLogin" id="txtLogin" value="<?= $row->login ?>" class="inputSmall"/>
                </div>

                <div class="item">
                    <label>E-Mail</label><br />
                    <input type="text" name="txtEmail" id="txtEmail" value="<?= $row->email ?>" class="input"/>
                </div>

                <div class="item">
                    <label>Saldo</label><br />
                    <input type="text" name="txtSaldo" id="txtSaldo" value="<?= $row->saldo ?>" class="inputSmall"/>
                </div>

                <div class="item">
                    <label>Tipo de Conta</label><br />
                    <select name='idTipoUsuario' id='idTipoUsuario' class="select">
                        <option value=""> Selecione </option>
                        <?
                        if (count($tiposUsuario)) {
                            foreach ($tiposUsuario as $key) {
                                if ($row->idTipoUsuario == $key->idTipoUsuario)
                                    echo "<option selected value='" . $key->idTipoUsuario . "'>" . $key->tipoUsuario . "</option>";
                                else
                                    echo "<option value='" . $key->idTipoUsuario . "'>" . $key->tipoUsuario . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="acao">
                    <input type="reset" value="Cancelar" class="button"/>
                    <input type="submit" class="button" name="btSalvarConta" value="Salvar conta"/>
                </div>	
            <? } ?>
                
        </form>
    </div>
</div>
<?
$this->load->view('priv/_inc/inferior');
?>
