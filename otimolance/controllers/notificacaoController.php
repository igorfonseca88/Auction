<?php

require_once "PagSeguroLibrary/PagSeguroLibrary.php";
//require_once "otimolance/models/Util.php";
//require_once "otimolance/models/Categoria.php";
require_once "exception/otimoLanceException.php";

class NotificacaoController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    private $msgSucesso = "";
    private $msgErro = "";
    private $msgAlerta = "";

    function transacoes() {
        $data["transactions"] = null;
        $this->load->view("priv/transacoes/transacoesList", $data);
    }

    function processarEscolha() {
        $option = $this->input->post("optHidden");
        if ($option == "pesquisar") {
            $this->pesquisarAction();
        } else if ($option == "processar") {
            $this->processar();
        } else {
            $data["transactions"] = null;
            $this->load->view("priv/transacoes/transacoesList", $data);
        }
    }

    function processar() {
        $this->load->model("Pedido_model", "pedidoDAO");
        $this->load->model('Conta_model', 'contaDAO');
        $this->load->model("Itempedido_model", "itemPedidoDAO");
        $this->load->model("Produto_model", "produtoDAO");
        $this->load->model("Categoria_model", "categoriaDAO");

        $selecionados = $this->input->post("checkboxesChecked");

        $arrSelecionados = explode(",", $selecionados);

        if ($selecionados != "") {
            foreach ($arrSelecionados as $row) {
                $pedido = $this->pedidoDAO->buscarPorId($row);
                $conta = $this->contaDAO->buscarContaPorId($pedido[0]->idConta);
                $itensPedido = $this->itemPedidoDAO->buscarItemPedidoPorIdPedido($row);

                foreach ($itensPedido as $itemPedido) {
                    $produto = $this->produtoDAO->buscarPorId($itemPedido->idProduto);
                    $categoria = $this->categoriaDAO->buscarPorId($produto[0]->idCategoria);

                    //processa somente os pedidos NÃO PROCESSADOS
                    if ($pedido[0]->status != Util::$STATUS_PROCESSADO) {

                        if ($categoria[0]->nome == Util::$TIPO_LANCE) {

                            //Quantidade de créditos a ser acrescentado ao usuario no caso de CATEGORIAS do TIPO LANCE para CADA PRODUTO
                            //Ex: Comprei Pacote de 25 Lances a quantidade é 25 (OBS: A quantidade pode ser alterada no cadastro de produto);
                            $quantidadeProduto = $produto[0]->quantidade;
                            //Quantidade selecionado no ato da compra
                            //Ex: Selecionei o produto Pacote de 25 Lances e escolhi comprar 2 unidades deste pacote. 
                            $quantidadeItemPedido = $itemPedido->quantidade;
                            //Crédito a ser inserido na conta do usuario.
                            //Ex: Comprei 2 unidades do produto Pacote de 25 lances com a quantidade = 25 cada, total a ser creditado = 50 .
                            $credito = $quantidadeProduto * $quantidadeItemPedido;

                            //Atualiza o saldo da conta com os créditos comprados
                            $contaUpdate = array(
                                "saldo" => $conta[0]->saldo + $credito
                            );

                            $this->contaDAO->update($contaUpdate, $conta[0]->idConta);
                        }
                        //Atualiza o status do pedido para Processado
                        $pedidoUpdate = array(
                            "status" => Util::$STATUS_PROCESSADO
                        );

                        $this->pedidoDAO->atualizar($pedidoUpdate, $pedido[0]->idPedido);
                    }
                }
            }
        }
    }

    function pesquisarAction() {
        $dataInicio = Util::ajustaDataSql($this->input->post("dataInicio")) . "T00:00:00Z";
        $dataFim = Util::ajustaDataSql($this->input->post("dataFim")) . "T00:00:00Z";

        $this->transacoesPorIntervaloDatas($dataInicio, $dataFim);
    }

    function notificacao() {

        /* Definindo as credenciais  */
        $credentials = PagSeguroConfig::getAccountCredentials();

        /* Tipo de notificação recebida */
        $type = $_POST['notificationType'];

        /* Código da notificação recebida */
        $code = $_POST['notificationCode'];

        /* Verificando tipo de notificação recebida */
        if ($type === 'transaction') {
            /* Obtendo o objeto PagSeguroTransaction a partir do código de notificação */
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $code);
        }
    }

    function transacoesPorIntervaloDatas($dataInicial, $dataFinal) {

        /* Definindo as credenciais  */
        $credentials = PagSeguroConfig::getAccountCredentials();

        /* Definindo a data de ínicio da consulta */
        $initialDate = $dataInicial;

        /* Definindo a data de término da consulta */
        $finalDate = $dataFinal;

        /* Definindo o número máximo de resultados por página */
        $maxPageResults = 20;

        /* Definindo o número da página */
        $pageNumber = 1;

        try {
            /* Realizando a consulta */
            $result = PagSeguroTransactionSearchService::searchByDate(
                            $credentials, $pageNumber, $maxPageResults, $initialDate, $finalDate);
        } catch (PagSeguroServiceException $exp) {

            foreach ($exp->getErrors(null) as $key => $error) {
                $a = new OtimoLanceException();
                $this->msgErro = $a->getMessage($error->getCode());
            }
            $notificacao["erro"] = $this->msgErro;
            $this->load->vars($notificacao);
            $this->load->view("priv/transacoes/transacoesList");

            return;
        } catch (Exception $e) {
            LogPagSeguro::error("Exception: " . $e->getMessage());
            echo $e;
            return;
        }


        /* Obtendo as transações do objeto PagSeguroTransactionSearchResult */
        $transactions = $result->getTransactions();

        $data["transactions"] = $transactions;
        $this->load->view("priv/transacoes/transacoesList", $data);
    }

}

?>
