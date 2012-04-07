<?php
require_once "PagSeguroLibrary/PagSeguroLibrary.php";
//require_once "otimolance/models/Pedido.php";
require_once "otimolance/models/Categoria.php";

class CompraController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function comprarLances(){
        $this->load->model('Produto_model', 'produtoDAO');
        $data["produtos"] = $this->produtoDAO->buscarProdutosGaleriaPorNomeCategoria(Categoria::$TIPO_LANCE);
        $this->load->view("compra/comprarLances",$data);
     }
     
     function carrinho($idProduto){
        $this->load->model("Produto_model", "produtoDAO");
        $this->load->model("Pedido_model", "pedidoDAO");
        $this->load->model("ItemPedido_model", "itemPedidoDAO");
        $idConta = $this->session->userdata('idConta');
        
        $pedido["pedido"] = $this->pedidoDAO->buscarPedidoPorIdContaEStatusPedido($idConta, Pedido_model::STATUS_EM_ANDAMENTO);
        print_r($pedido["pedido"]);
        
        if (is_null($pedido["pedido"][0])) {
            //CRIA UM NOVO PEDIDO
            $pedido = array(
                "idConta" => $idConta,
                "status" => Pedido_model::STATUS_EM_ANDAMENTO,
                "dataCriacao"  => date('Y-m-d H:i:s')
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
     
     /**
      *
      * @param type $origem 
      * origem: arremate, lances, produtos
      */
     function identificacao($idPedidoArrematado = NULL){
       $this->load->model('Conta_model', 'contaDAO');
       $this->load->model("Produto_model", "produtoDAO");
       $this->load->model("Pedido_model", "pedidoDAO");
       $this->load->model("ItemPedido_model", "itemPedidoDAO");
       $idConta = $this->session->userdata('idConta');
       
       $pedido["pedido"] = $this->pedidoDAO->buscarPedidoPorIdContaEStatusPedido($idConta, Pedido_model::STATUS_EM_ANDAMENTO);
       $idPedido = $pedido["pedido"][0]->idPedido;
       $itensPedido = $this->itemPedidoDAO->buscarItemPedidoPorIdPedido($idPedido);

       if($idPedidoArrematado == NULL){
           foreach ($itensPedido as $row) {
                 $quantidade = $this->input->post("txtQuantidade".$row->idItemPedido);
                 $itemPedido = array("quantidade" => $quantidade);
                 //Salva Item pedido com quantidade
                 $this->itemPedidoDAO->atualizarItemPedido($itemPedido, $row->idItemPedido);
            }
       }

        $data["conta"] = $this->contaDAO->buscarContaPorId($idConta);
        if($idPedidoArrematado != NULL){
            $data["idPedido"] = $idPedidoArrematado;
        }
        $this->load->view("compra/identificacao", $data);
     }
     
     function pagamento(){
        $idPedido = $this->input->post("idPedidoh"); 
        $data["idPedido"] = $idPedido;
        $this->load->view("compra/pagamento",$data);
     }
     
     function atualizarDadosCadastrais(){
     
         
         
     }
     
     function excluirProdutoAction($idItemPedido){
       $this->load->model("Pedido_model", "pedidoDAO");
       $this->load->model("ItemPedido_model", "itemPedidoDAO");
       $idConta = $this->session->userdata('idConta');
       
       $itemPedido = array("idItemPedido" => $idItemPedido);
       
       $this->itemPedidoDAO->excluirItemPedido($itemPedido);
       $pedido = $this->pedidoDAO->buscarPedidoPorIdContaEStatusPedido($idConta, Pedido_model::STATUS_EM_ANDAMENTO);
       
       $idPedido = $pedido[0]->idPedido;
       
       $data["produtos"] = $this->pedidoDAO->buscarProdutosGaleriaPorIdPedido($idPedido);

       $this->load->view("compra/carrinhoCompra",$data);
       
     }

     function criarTransacaoPagSeguro($idPedidoArremate=null){
       $this->load->model("Conta_model", "contaDAO");
       $this->load->model("Pedido_model", "pedidoDAO");
       $idConta = $this->session->userdata('idConta');
     
       $conta = $this->contaDAO->buscarContaPorId($idConta);
       if($idPedidoArremate == null){
        $pedido = $this->pedidoDAO->buscarPedidoPorIdContaEStatusPedido($idConta, Pedido_model::STATUS_EM_ANDAMENTO);
        $idPedido = $pedido[0]->idPedido;
       }
       else {
           $idPedido = $idPedidoArremate;
       }
       
       $itens = $this->pedidoDAO->buscarItensPedidoPorIdPedido($idPedido);
       
	$paymentRequest = new PagSeguroPaymentRequest();
	//moeda Brasileira
        $paymentRequest->setCurrency("BRL");
		
        foreach ($itens as $row) {
             $paymentRequest->addItem($row->idProduto, $row->nome,  $row->quantidade, round($row->valor,2));
        }
	
	//serve para controles futuros, caso estejamos salvando em banco também as transações
	$paymentRequest->setReference($idPedido);
	
        //entrega FRETE
        $CODIGO_SEDEX = PagSeguroShippingType::getCodeByType('SEDEX');
	$paymentRequest->setShippingType($CODIGO_SEDEX);
	$paymentRequest->setShippingAddress($conta[0]->cep,  $conta[0]->logradouro,  $conta[0]->numero, $conta[0]->complemento, $conta[0]->bairro, $conta[0]->cidade, $conta[0]->estado, 'BRA');
	
	//dados do cliente para que ele não necessite informar novamente no pagseguro
        //pode-se colocar ainda o codico de area e o telefone
	$paymentRequest->setSender($conta[0]->nome+" "+$conta[0]->sobrenome, $conta[0]->email);
	
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
            
            // altera status do pedido para Aguardando pagamento
            $statusPedido = array("status" => Pedido_model::STATUS_AGUARD_PAGTO);
            $this->pedidoDAO->atualizar($statusPedido, $idPedido);
             
	} catch (PagSeguroServiceException $e) {
		die($e->getMessage());
	}
     }
}

?>