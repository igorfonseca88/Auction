<?
$this->load->view('_padrao/topo');
?>
<br/>
<br/>
<div class="formulario">
    <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
    <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
    
    <h3>Verifique o seu e-mail!!</h3>
    <br/>
    <br/>
    <label>Acabamos de enviar um e-mail para você. Para que possamos finalizar seu cadastro é necessário que você verifique o e-mail que usou na etapa anterior e clique no link que enviamos.</label>
    <br/><br/>
    <label>Obs.: Caso o e-mail não esteja em sua caixa de entrada, por favor verifique a pasta de spam/lixo eletrônico.</label>
    <br/><br/>
    <label>Obrigado</label>
    <br/><br/>
    <label>Equipe OtimoLance</label>
</div>
