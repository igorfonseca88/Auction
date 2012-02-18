<?php

class Clance extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    function darLance() {
        $this->load->model("Lance_model", "lance");
        
        $valor = 0.00 ;
        $valor = $this->getValorUltimoLance($this->input->post("leilao")) + $this->getValorLeilao($this->input->post("leilao"));
        $idConta = $this->input->post("id");
        
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
            }
        }
        
        $dados = $login."@".$valor;
        
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
