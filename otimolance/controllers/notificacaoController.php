<?php

require_once "PagSeguroLibrary/PagSeguroLibrary.php";

class NotificacaoController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    function transacoes(){
      $data["transactions"] = null;
      $this->load->view("priv/transacoes/transacoesList", $data);
    }


    function pesquisarAction(){
        $dataInicial = $this->input->post("dataInicial");
        $dataFim = $this->input->post("dataFim");
        
        echo $dataFim;
        echo $dataInicial;
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
     
     function transacoesPorIntervaloDatas($dataInicial = null, $dataFinal = null){
         
        /* Definindo as credenciais  */    
        $credentials = PagSeguroConfig::getAccountCredentials();
      
        /* Definindo a data de ínicio da consulta */  
        $initialDate = '2012-03-18T08:50';  
      
        /* Definindo a data de término da consulta */  
        $finalDate = '2012-03-21T20:30';  
        
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
