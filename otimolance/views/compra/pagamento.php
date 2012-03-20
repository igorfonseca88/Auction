<?
$this->load->view('conta/conta');
?>	
<div id="conteudoAdmin">
    <div class="formulario">
<form target="pagseguro" action="<?= BASE_URL(); ?>compraController/criarTransacaoPagSeguro" method="post">
    <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-pagar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
    </div>
</div>
