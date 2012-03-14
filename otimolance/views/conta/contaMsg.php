<?
$this->load->view('_padrao/topo');
?>
<br/>
<br/>
<div class="formulario">
    <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
    <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>
    
    <?= $msgHtml != "" ? '<div> ' . $msgHtml . ' </div>' : "" ?>
</div>
