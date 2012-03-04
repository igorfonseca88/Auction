<?
$this->load->view('_padrao/topo');
?>
<br/>
<br/>	
<div class="formulario">
    <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
    <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
    
    <h3>Seu cadastro foi ativado com sucesso!</h3>  
    <br/><br/>
    <label>Agora você já pode começar ganhar! \o/</label>
    <br/><br/>
    <label>Para acessar suas informações pessoais, comprar pacote de lances e participar de um leilão, você deverá utilizar seu login e senha criados.</label>
    <label>Por segurança, não compartilhe essas informações com ninguém.</label>
</div>
