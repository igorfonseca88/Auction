<?
$this->load->view('_padrao/topo');
?>
	
<div class="formulario">
    <h2>Dados Pessoais</h2>        
    <form method="post" action="<?= BASE_URL(); ?>contaController/salvarClienteSite">
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

