<?php
require_once "PagSeguroLibrary/PagSeguroLibrary.php";
//require_once "otimolance/models/Pedido.php";
require_once "otimolance/models/Categoria.php";
require_once "otimolance/models/Util.php";

class CompraController extends CI_Controller {

    
    private $msgPadrao = "";
    
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
        $this->atualizarDadosCadastrais();
        $idPedido = $this->input->post("idPedidoh"); 
        $data["idPedido"] = $idPedido;
        $this->load->view("compra/pagamento",$data);
     }
     
     function atualizarDadosCadastrais() {

        $this->load->model("Conta_model", "contaDAO");
        $id = $this->input->post("idContah");

        $sexo = $this->input->post("txtSexo");
        $dtNascimento = $this->input->post("txtDataNascimento");
        $cep = $this->input->post("txtCep");
        $logradouro = $this->input->post("txtLogradouro");
        $numero = $this->input->post("txtNumero");
        $complemento = $this->input->post("txtComplemento");
        $bairro = $this->input->post("txtBairro");
        $estado = $this->input->post("txtEstado");
        $cidade = $this->input->post("txtCidade");
        $telefone = $this->input->post("txtTelefone");
        $celular = $this->input->post("txtCelular");
        $email = $this->input->post("txtEmail");

        $msg = "";

        // Validações de campos nulos
        if ($sexo == "Selecione") {
            $msg .= "O campo Sexo é obrigatório. Favor selecioná-lo corretamente." . "<br/>";
        }

        if ($dtNascimento == "") {
            $msg .= "O campo Data de Nascimento é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }

        if ($cep == "") {
            $msg .= "O campo Cep é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }

        if ($logradouro == "") {
            $msg .= "O campo Logradouro é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }

        if ($numero == "") {
            $msg .= "O campo Número é obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }

        if ($bairro == "") {
            $msg .= "O campo Bairro obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }

        if ($estado == "Selecione") {
            $msg .= "O campo Estado obrigatório. Favor selecioná-lo corretamente." . "<br/>";
        }

        if ($cidade == "") {
            $msg .= "O campo Cidade obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }

        if ($telefone == "") {
            $msg .= "O campo Telefone obrigatório. Favor preenche-lo corretamente." . "<br/>";
        }

        if (Util::validaEmail($email) == false) {
            $msg .= "E-mail inválido." . "<br/>";
        }

        // Verificar de email já foi cadastrado
        $listaEmail["$listaEmail"] = $this->contaDAO->buscarEmailCadastradoEdit($email, $id);

        foreach ($listaEmail as $row) {
            $emailExistente = $row[0]->email;
        }

        if (!is_null($emailExistente)) {
            $msg .= "E-mail já cadastrado." . "<br/>";
        }
        echo $sexo;

        if (strlen($msg) <= 0) {
            $data = array(
                "sexo" => $sexo,
                "dtNascimento" => Util::ajustaDataSql($dtNascimento),
                "cep" => $cep,
                "logradouro" => $logradouro,
                "numero" => $numero,
                "complemento" => $complemento,
                "bairro" => $bairro,
                "estado" => $estado,
                "cidade" => $cidade,
                "telefone" => $telefone,
                "celular" => $celular,
                "email" => $email
            );

            $this->contaDAO->update($data, $id);
        } else {
            $this->msgPadrao = $msg;
            echo $msg;
            $conta["conta"] = $this->contaDAO->buscarContaPorId($id);
            $conta["erro"] = $this->msgPadrao;
            $this->load->vars($conta);
            $this->load->view("compra/identificacao", $conta);
        }
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