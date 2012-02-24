<?php

class Clance extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function darLance() {
        $this->load->model("Lance_model", "lance");
        
        // valida se o leilao ainda está ativo e tem tempo
        // RETORNO 1 = FINALIZADA
        
        // valida o saldo da conta para o lance
        // RETORNO 2 = SEM SALDO
        $idConta = $this->input->post("id");
        if($this->Conta_model->existeSaldoNaConta($idConta) == FALSE){
            echo 2;
            exit;
        }
        
        $valor = 0.00 ;
        $valor = $this->getValorUltimoLance($this->input->post("leilao")) + $this->getValorLeilao($this->input->post("leilao"));
        
        
        $data = array(
            "data" => date('Y-m-d H:i:s'),
            "idConta" => $idConta,
            "idLeilao" => $this->input->post("leilao"),
            "valor" => $valor
        );

        $id = $this->lance->salvarLance($data);
        
        // atualiza o saldo de lances da conta
        
        echo $id;
    }
    
    function buscarUltimoLance(){
       
        $this->load->model("Lance_model", "lance");
        $login = "";
        $valor= 0.00;
       
        $idLeilao = $this->input->post("leilao");
        
        $result = $this->lance->buscarUltimoLance($idLeilao);
        if($result){
            
            foreach ($result as $dados) {
                $valor = $dados->valor;
                $login = $dados->login;
                $cronometro = $dados->tempoCronometro;
            }
        }
        
        $dados = $login."@".$valor."@".$cronometro;
        
        echo $dados;
    }
 
    private function getValorUltimoLance($idLeilao) {
        $this->load->model("lance_model", "lance");
        return $this->lance->buscarValorUltimoLance($idLeilao);
    }

    private function getValorLeilao($idLeilao) {
        $this->load->model("leilao_model", "leilao");
        return $this->leilao->buscarValorLeilao($idLeilao);
    }
    
    function getTime(){
        $this->load->model("leilao_model", "leilao");
        $idLeilao = $this->input->post("leilao");
        echo $this->leilao->buscarData($idLeilao);
    }
    
    function  getDadosLeilao(){
        $this->load->model("leilao_model", "leilao");
        //$leiloes = $this->input->post("leiloes");
        $dados = $this->leilao->buscarDadosLeilao(2);
        
        $ret = array();
        $i=0;
        foreach ($dados as $value) {
            
            $dataCalcular = ($value->dataUltLance == 0)  ? $value->dataInicio : $value->dataUltLance;
            // tem que acrescentar o valor do cronometro no time
            $data = str_replace(" ", "-",str_replace(":", "-", $dataCalcular));
            $data = explode("-", $data);
            $time = mktime($data[3], $data[4], $data[5]+16, $data[1], $data[2], $data[0]);
            
            $time2 = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
            $status = '2';
            if( ($time - $time2) <= 0 ){
                $status = 'F';
            }
            
                $ret[$i] = array(
                "idLeilao"=> $value->idLeilao,
                "login"=>$value->login,
                "valor" =>$value->valor,
                "MicroTimeFim" => $time,//($value->dataUltLance == 0  ? time($value->dataInicio) : time($value->dataUltLance)),
                "tempoCronometro" =>   $value->tempoCronometro,
                "status"   => $status 
            );
                $i++;
        }

        
        echo json_encode($ret);
        
    }


    function retHorario(){
        echo json_encode(array("time"=> time(date('Y-m-d H:i:s'))));
    }

    function ajustaDataSql($data) {
        if ($data) {
            $dataDividida = explode("/", $data);
            return $dataDividida[2] . "-" . $dataDividida[1] . "-" . $dataDividida[0];
        }
        return NULL;
    }

    /* metodos para o site */

    function detalheLeilao($param) {
        echo "to aqui" . $param;

        $dados = explode("-", $param);

        $id = $dados[0];

        echo $id;

        exit;
    }

}

?>
