<?php

require_once "PagSeguroLibrary/PagSeguroLibrary.php";
require_once "otimolance/models/Util.php";

class NotificacaoController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    function transacoes(){
      $data["transactions"] = null;
      $this->load->view("priv/transacoes/transacoesList", $data);
    }

    function processarEscolha(){
        $option = $this->input->post("optHidden");
        if($option == "pesquisar"){
            $this->pesquisarAction();
        }else if($option == "processar"){
            $this->processar();
        }else{
            $data["transactions"] = null;
            $this->load->view("priv/transacoes/transacoesList", $data);
        }
    }
    
    function processar(){
     $selecionados = $this->input->post("checkboxesChecked");
     
     $arrSelecionados = explode(",", $selecionados);
     
     if($selecionados != ""){
     foreach ($arrSelecionados as $row) {
        
         
        }
     }
     
    }
    
    function pesquisarAction(){
        $dataInicio = Util::ajustaDataSql($this->input->post("dataInicio"))."T00:00:00Z";
        $dataFim = Util::ajustaDataSql($this->input->post("dataFim"))."T00:00:00Z";
        
        $this->transacoesPorIntervaloDatas($dataInicio, $dataFim);
    }
    
    function notificacao(){
        
        /* Definindo as credenciais  */  
        $credentials = PagSeguroConfig::getAccountCredentials();

        /* Tipo de notificação recebida */  
        $type = $_POST['notificationType'];  

        /* Código da notificação recebida */  
        $code = $_POST['notificationCode'];  

        /* Verificando tipo de notificação recebida */  
        if ($type === 'transaction') {  
            /* Obtendo o objeto PagSeguroTransaction a partir do código de notificação */  
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $code );  
        }
     }
     
     function transacoesPorIntervaloDatas($dataInicial, $dataFinal){
         
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
      
        /* Realizando a consulta */  
        $result = PagSeguroTransactionSearchService::searchByDate(  
            $credentials, $pageNumber, $maxPageResults,
            $initialDate, $finalDate); 
      
        /* Obtendo as transações do objeto PagSeguroTransactionSearchResult */  
        $transactions = $result->getTransactions(); 
        
        $data["transactions"] = $transactions;
        $this->load->view("priv/transacoes/transacoesList",$data);
        
     }
}

?>
