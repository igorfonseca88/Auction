<?
$this->load->view('_padrao/topo');
?>
<br/>
<br/>
<div id="conteudo">
    <div class="formulario">
        <?=$sucesso != "" ? '<div class="success"> ' . $sucesso . ' </div>' : "" ?>
        <?= $erro != "" ? '<div class="error"> ' . $erro . ' </div>' : "" ?>

        <?= $msgHtml != "" ? '<div> ' . $msgHtml . ' </div>' : "" ?>
    </div>
</div>
</body>
</html>