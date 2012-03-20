<?php
require_once "PagSeguroLibrary/PagSeguroLibrary.php";
require_once "otimolance/models/Pedido.php";

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
        $this->load->model("Produto_model", "produtoDAO");
        $this->load->model("Pedido_model", "pedidoDAO");
        $this->load->model("ItemPedido_model", "itemPedidoDAO");
        $idConta = $this->session->userdata('idConta');
        
        $pedido["pedido"] = $this->pedidoDAO->buscarPedidoPorIdContaEStatusPedido($idConta, Pedido::$STATUS_EM_ANDAMENTO);
        
        if (is_null($pedido["pedido"][0])) {
            //CRIA UM NOVO PEDIDO
            $pedido = array(
                "idConta" => $idConta,
                "status" => Pedido::$STATUS_EM_ANDAMENTO
            );
        
            $idPedido = $this->pedidoDAO->salvar($pedido);
        }else{
            $idPedido = $pedido["pedido"][0]->idPedido;
        }
        
        //INSERE O ITEM NO PEDIDO
        if($idProduto != null){
            $itemPedido = array(
                "idProduto" => $idProduto,
                "idPedido" => $idPedido,
                "quantidade" => 1
            );

            $idItemPedido = $this->itemPedidoDAO->salvarItemPedido($itemPedido);
        }
        
        $data["produtos"] = $this->pedidoDAO->buscarProdutosGaleriaPorIdPedido($idPedido);

        $this->load->view("compra/carrinhoCompra",$data);
     }
     
     function identificacao(){
       $this->load->model('Conta_model', 'contaDAO');
       $this->load->model("Produto_model", "produtoDAO");
       $this->load->model("Pedido_model", "pedidoDAO");
       $this->load->model("ItemPedido_model", "itemPedidoDAO");
       $idConta = $this->session->userdata('idConta');
       
       $pedido["pedido"] = $this->pedidoDAO->buscarPedidoPorIdContaEStatusPedido($idConta, Pedido::$STATUS_EM_ANDAMENTO);
       $idPedido = $pedido["pedido"][0]->idPedido;
       $itensPedido = $this->itemPedidoDAO->buscarItemPedidoPorIdPedido($idPedido);

       foreach ($itensPedido as $row) {
             $quantidade = $this->input->post("txtQuantidade".$row->idItemPedido);
             $itemPedido = array("quantidade" => $quantidade);
             //Salva Item pedido com quantidade
             $this->itemPedidoDAO->atualizarItemPedido($itemPedido, $row->idItemPedido);
        }

        $data["conta"] = $this->contaDAO->buscarContaPorId($idConta);
        $this->load->view("compra/identificacao", $data);
     }
     
     function pagamento(){
        $this->load->view("compra/pagamento");
     }
     
     function excluirProdutoAction($idItemPedido){
       $this->load->model("Pedido_model", "pedidoDAO");
       $this->load->model("ItemPedido_model", "itemPedidoDAO");
       $idConta = $this->session->userdata('idConta');
       
       $itemPedido = array("idItemPedido" => $idItemPedido);
       
       $this->itemPedidoDAO->excluirItemPedido($itemPedido);
       $pedido = $this->pedidoDAO->buscarPedidoPorIdContaEStatusPedido($idConta, Pedido::$STATUS_EM_ANDAMENTO);
       
       $idPedido = $pedido[0]->idPedido;
       
       $data["produtos"] = $this->pedidoDAO->buscarProdutosGaleriaPorIdPedido($idPedido);

       $this->load->view("compra/carrinhoCompra",$data);
       
     }

     function criarTransacaoPagSeguro(){
       $this->load->model("Conta_model", "contaDAO");
       $this->load->model("Pedido_model", "pedidoDAO");
       $idConta = $this->session->userdata('idConta');
       
       $conta = $this->contaDAO->buscarContaPorId($idConta);
       
       $pedido = $this->pedidoDAO->buscarPedidoPorIdContaEStatusPedido($idConta, Pedido::$STATUS_EM_ANDAMENTO);
       
       $idPedido = $pedido[0]->idPedido;
       
       $itens = $this->pedidoDAO->buscarProdutosGaleriaPorIdPedido($idPedido);
       
	$paymentRequest = new PagSeguroPaymentRequest();
	//moeda Brasileira
        $paymentRequest->setCurrency("BRL");
		
        foreach ($itens as $row) {
             $paymentRequest->addItem($row->idProduto, $row->nome,  $row->quantidade, round($row->preco,2));
        }
	
	//serve para controles futuros, caso estejamos salvando em banco também as transações
	$paymentRequest->setReference($idPedido);
	
        //entrega FRETE
        $CODIGO_SEDEX = PagSeguroShippingType::getCodeByType('SEDEX');
	$paymentRequest->setShippingType($CODIGO_SEDEX);
	$paymentRequest->setShippingAddress('01452002',  'Rua Tenente Waldevino',  '350', 'apto. 12', 'Centro', 'Campo grande', 'MS', 'BRA');
	
	//dados do cliente para que ele não necessite informar novamente no pagseguro
        //pode-se colocar ainda o codico de area e o telefone
	$paymentRequest->setSender($conta[0]->nome." ".$conta[0]->sobrenome, $conta[0]->email);
	
	$paymentRequest->setRedirectUrl("http://www.mynewbiz.com.br/otimolance");
	
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
