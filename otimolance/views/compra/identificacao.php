<?
$this->load->view('conta/conta');
?>	
<div id="conteudoAdmin">
    <div class="formulario">
        <form method="post" action="<?= BASE_URL(); ?>compraController/pagamento/">

            <? foreach ($conta as $row) { ?>
            <input type="hidden" name="idContah" id="idContah" value="<?= $row->idConta?>"/>
                <div class="item">
                   <label>Nome</label><br />
                   <input type="text" class="inputSmall" name="txtNome" id="txtNome" value="<?= $row->nome ?>"/>
                </div>
            
                <div >
                    <label>Sobrenome</label><br />
                    <input type="text" name="txtSobrenome" class="inputSmall" id="txtSobrenome" value="<?= $row->sobrenome ?>" />
                </div>
            
                <div >
                    <label>Cpf</label><br />
                    <input type="text" disabled="true" class="inputSmall" name="txtCpf" id="txtCpf" value="<?= $row->cpf ?>"/>
                </div>

                <div >
                    <label>Login</label><br />
                    <input type="text" name="txtLogin" class="inputSmall" id="txtLogin" value="<?= $row->login ?>" />
                </div>
            <? } ?>
             <div>
                <a href="<?= BASE_URL(); ?>compraController/carrinho/">Voltar</a>
                <input type="submit" value="Continuar" class="button" >
            </div>
        </form>
    </div>
</div>
