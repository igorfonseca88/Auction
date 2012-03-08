<?php
require_once "PagSeguroLibrary/PagSeguroLibrary.php";

class CompraController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function comprarLances(){
        $this->load->model('Produto_model', 'produtoDAO');
        $data["produtos"] = $this->produtoDAO->buscarProdutosGaleriaPorNomeCategoria("Lance");
        $this->load->view("compra/comprarLances",$data);
    
     }
     
     function carrinho($idProduto){
        $this->load->model('Produto_model', 'produtoDAO');
        $data["produtos"] = $this->produtoDAO->buscarProdutosGaleriaPorIdProduto($idProduto);
        $this->load->view("compra/carrinhoCompra",$data);
    
     }
     
     function pagamento(){
        $this->load->model("Produto_model", "produtoDAO");
        $idProduto = $this->input->post("idProdutoHidden");
        $quantidade = $this->input->post("txtQuantidade");
        $data["produtos"] = $this->produtoDAO->buscarProdutosGaleriaPorIdProduto($idProduto);
        
        $dadosNovaCompra = array(
                   'produtos'  => $this->produtoDAO->buscarProdutosGaleriaPorIdProduto($idProduto),
                   'quantidade'     => $quantidade
               );
        $this->session->set_userdata($dadosNovaCompra);      
        $this->load->view("compra/pagamento",$data);
     }
     
     function criarTransacaoPagSeguro(){
         $quantidade = $this->session->userdata('quantidade');
         $produtos = $this->session->userdata('produtos');
         
	$paymentRequest = new PagSeguroPaymentRequest();
	//moeda Brasileira
        $paymentRequest->setCurrency("BRL");
		
        foreach ($produtos as $row) {
            $paymentRequest->addItem($row->idProduto, $row->nome,  100);
        }
	
	//serve para controles futuros, caso estejamos salvando em banco também as transações
	//$paymentRequest->setReference("REF1234");
	
        //entrega FRETE
        $CODIGO_SEDEX = PagSeguroShippingType::getCodeByType('SEDEX');
	$paymentRequest->setShippingType($CODIGO_SEDEX);
	$paymentRequest->setShippingAddress('01452002',  'Av. Brig. Faria Lima',  '1384', 'apto. 114', 'Jardim Paulistano', 'São Paulo', 'SP', 'BRA');
	
	//dados do cliente para que ele não necessite informar novamente no pagseguro
	$paymentRequest->setSender('William Witter da Silva Comprador', 'wwwitters@gmail.com', '11', '56273440');
	
	$paymentRequest->setRedirectUrl("http://www.lojamodelo.com.br");
	
	try {
		
		/*
		* #### Crendencials ##### 
		* Credenciais (e-mail and token) - Token = numero gerado na conta do pagseguro
		* Você pode pegar as credenciais de um arquivo de conf.
		* $credentials = PagSeguroConfig::getAccountCredentials();
		*/			
		$credentials = new PagSeguroAccountCredentials("wwwitters@gmail.com", "2C36B0FEB8844C62947D65145B09115A");
		
		$url = $paymentRequest->register($credentials);
		
	} catch (PagSeguroServiceException $e) {
		die($e->getMessage());
	}
     }
}

?>
