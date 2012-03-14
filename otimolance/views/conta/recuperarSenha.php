<?
$this->load->view('_padrao/topo');
?>
<br/>
<br/>
<div id="conteudo">
    <div class="formulario">
    <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
    <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>      
        <form method="post" action="<?= BASE_URL(); ?>contaController/retornarSenha">
                <label>Digite seu e-mail</label><br />
                <input type="text" name="txtEmail" id="txtEmail" value="" class="input"/>
                <input type="submit" value="Enviar" class="button"/>
        </form>
    </div>
</div>