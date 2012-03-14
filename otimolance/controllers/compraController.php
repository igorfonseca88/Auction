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

        if($this->session->userdata('pedido') != null){
             $data["pedido"] = $this->session->userdata('pedido');
         }
         
        $data["pedido"]["infoPedido".$idProduto] = $this->produtoDAO->buscarProdutosGaleriaPorIdProduto($idProduto);
        
        $this->session->set_userdata($data); 
        $this->load->view("compra/carrinhoCompra",$data);
    
     }
     
     function pagamento(){
        $this->load->model("Produto_model", "produtoDAO");
        
        if($this->session->userdata('pedido') != null){
             $data["pedido"] = $this->session->userdata('pedido');
         }
         
         foreach ($data["pedido"] as $row) {
             $quantidade = $this->input->post("txtQuantidade".$row[0]->idProduto);
             $data["pedido"]["infoPedido".$row[0]->idProduto]["quantidade"] = $quantidade;
        }
        $this->session->set_userdata($data); 
        $this->load->view("compra/pagamento");
        
     }
     
     function criarTransacaoPagSeguro(){
         
         if($this->session->userdata('pedido') != null){
             $data["pedido"] = $this->session->userdata('pedido');
         }
         
	$paymentRequest = new PagSeguroPaymentRequest();
	//moeda Brasileira
        $paymentRequest->setCurrency("BRL");
		
        foreach ($data["pedido"] as $row) {
             $paymentRequest->addItem($row[0]->idProduto, $row[0]->nome,  $row["quantidade"], round($row[0]->preco,2));
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
		$credentials = PagSeguroConfig::getAccountCredentials();
		
		$url = $paymentRequest->register($credentials);
		
                header("Location: $url"); 
	} catch (PagSeguroServiceException $e) {
		die($e->getMessage());
	}
     }
}

?>
