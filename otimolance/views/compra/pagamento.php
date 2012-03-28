<?
$this->load->view('conta/conta');
?>	
<div id="conteudoAdmin">
    <div class="formulario">
        
        <h2>Pagamento utilizando PagSeguro</h2>
        <p class="titulo">Pague com toda a segurança e conveniência do PagSeguro!</p>
        <br/><br/><br/>
        
        <img src="<?=  base_url()?>/img/pagseguro-meios-pagamento.png" width="700px"></img>
        <br/><br/><br/>
        <form target="pagseguro" action="<?= BASE_URL(); ?>compraController/criarTransacaoPagSeguro/<?=$idPedido?>" method="post">
            <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/209x48-pagar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
        </form>
    </div>
    </div>
</div>
