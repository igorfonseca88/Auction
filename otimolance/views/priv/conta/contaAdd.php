<?
$this->load->view('_padrao/topo');
?>
	
<div id="conteudo">

    
    <div class="formulario">
        <h2>Dados Pessoais</h2>
        
        <h2>    
            <?=$tituloSucesso != "" ? '<h2> '.$tituloSucesso.' </h2>': ""?>
            <?=$tituloErro != "" ? '<h2> '.$tituloErro.' </h2>': ""?>
        </h2>
        
        <?=$sucesso != "" ? '<div class="success"> '.$sucesso.' </div>': ""?>
        <?=$erro != "" ? '<div class="error"> '.$erro.' </div>': ""?>
        
        <form method="post" action="<?= BASE_URL(); ?>contaController/salvarNovaConta">
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
                <input type="submit" class="button" name="btFinalizar" value="Finalizar" />
            </div>

        </form>

    </div>
</div>

