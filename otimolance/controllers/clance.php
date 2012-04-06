<?php

class Clance extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function darLance() {
        $this->load->model("Lance_model", "lance");
        $this->load->model("Leilao_model", "leilao");

        // valida se o leilao ainda está ativo e tem tempo
        // RETORNO 1 = FINALIZADA
        // valida o saldo da conta para o lance
        // RETORNO 2 = SEM SALDO
        $idConta = $this->input->post("id");
        if ($this->Conta_model->existeSaldoNaConta($idConta) == FALSE) {
            //echo "SALDO_INSUFICIENTE@";
            echo json_encode(array("retorno" => "SALDO_INSUFICIENTE"));
            exit;
        }
        
        if ($this->leilao->leilaoAtivo($this->input->post("leilao")) == FALSE) {
            //echo "LEILAO_INATIVO@";
            echo json_encode(array("retorno" => "LEILAO_INATIVO"));
            exit;
        }

        $valor = 0.00;
        //$valorLeilao = $this->getValorLeilao($this->input->post("leilao"));
        $arrayValores = $this->leilao->buscarDadosLeilaoParaLance($this->input->post("leilao"));
        
        if ($arrayValores["categoriaLeilao"] == "Nunca venci" &&  $this->leilao->leilaoNuncaVenci($idConta) > 0) {
            echo json_encode(array("retorno" => "LEILAO_INICIANTE"));
            exit;
        }
        
        
        $valor = $this->getValorUltimoLance($this->input->post("leilao")) + $arrayValores["valor"];


        $data = array(
            "data" => date('Y-m-d H:i:s'),
            "idConta" => $idConta,
            "idLeilao" => $this->input->post("leilao"),
            "valor" => $valor
        );

        $id = $this->lance->salvarLance($data);
        $atualizaSaldo = 0;
        if ($id > 0) {
            // chama um procedimento no banco de dados pra debitar do saldo do cliente
            
            switch ($valorLeilao){
                case 0.01 :
                    $atualizaSaldo = 1;
                    break;
                case 0.02 :
                    $atualizaSaldo = 2;
                    break;
            }
            $this->lance->atualizaSaldoConta($idConta, $atualizaSaldo);
        }


        // atualiza o saldo de lances da conta

        $saldoConta = $this->retLances($idConta);

        //echo "SUCESSO@" . $saldoConta;
        echo json_encode(array("retorno" => "SUCESSO", "saldo" => $saldoConta));
    }

    function buscarUltimoLance() {

        $this->load->model("Lance_model", "lance");
        $login = "";
        $valor = 0.00;

        $idLeilao = $this->input->post("leilao");

        $result = $this->lance->buscarUltimoLance($idLeilao);
        if ($result) {

            foreach ($result as $dados) {
                $valor = $dados->valor;
                $login = $dados->login;
                $cronometro = $dados->tempoCronometro;
            }
        }

        $dados = $login . "@" . $valor . "@" . $cronometro;

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

    function getDadosLeilao() {
        $this->load->model("leilao_model", "leilao");
        $leiloes = $this->input->post("Leiloes");

        $leiloes = substr($leiloes, 1, strlen($leiloes));

        $leiloes = str_replace("_", ",", $leiloes);
        $dados = $this->leilao->buscarDadosLeilao($leiloes);

        $ret = array();
        $i = 0;
        foreach ($dados as $value) {

            // verifica se existe um lance dado para o item leilão
            // caso esse lance tenha a data maior que a data do agendamento do leilão
            // utiliza-se essa data para o cálculo de tempo do leilão
            // senão continua com a data do agendamento
            if ($value->dataUltLance == 0) {
                $dataCalcular = $value->dataInicio;
            } else {
                if ($value->dataInicio > $value->dataUltLance) {
                    $dataCalcular = $value->dataInicio;
                } else {
                    $dataCalcular = $value->dataUltLance;
                }
            }
            // tem que acrescentar o valor do cronometro no time
            $data = str_replace(" ", "-", str_replace(":", "-", $dataCalcular));
            $data = explode("-", $data);
            $time = mktime($data[3], $data[4], $data[5] + $value->tempoCronometro, $data[1], $data[2], $data[0]);

            $time2 = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
            $status = '2';
            if (($time - $time2) <= 0 && $value->vencedor == "" ) {
                $status = 'F';
                // chama o arremate
                $this->arrematar($value->idLeilao, $value->valor, $value->idContaArremate, $value->idProduto);
            }

            $ret[$i] = array(
                "idLeilao" => $value->idLeilao,
                "login" => $value->login,
                "valor" => $value->valor,
                "MicroTimeFim" => $time,
                "tempoCronometro" => $value->tempoCronometro,
                "status" => $status,
                "listaLances" => $this->getListaLances($value->idLeilao),
                "dataInicio" => date("d/m/Y H:i:s", strtotime($dataCalcular))
            );
            $i++;
        }


        echo json_encode($ret);
    }

    private function arrematar($idLeilao, $valor, $idContaArremate, $idProduto) {
        
        $this->load->model("leilao_model", "leilao");
        
        
        $data = array(
            "dataFim" => date('Y-m-d H:i:s'),
            "valorArremate" => $valor,
            "idContaArremate" => $idContaArremate
        );
        $this->leilao->alterar($data, $idLeilao);
        
        $this->criarPedido($idLeilao, $idContaArremate,$idProduto);

    }
    
    private function criarPedido($idLeilao, $idContaArremate, $idProduto){
        
        //$this->load->model("produto_model", "produtoDAO");
        $this->load->model("pedido_model", "pedido");
        $this->load->model("itempedido_model", "itemPedidoDAO");
        
            //CRIA UM NOVO PEDIDO
        $pedido = array(
            "idConta" => $idContaArremate,
            "status" => Pedido_model::STATUS_EM_ANDAMENTO,
            "dataCriacao"  => date('Y-m-d H:i:s'),
            "idLeilao"  => $idLeilao
        );
        

        $idPedido = $this->pedido->salvar($pedido);
        
        //INSERE O ITEM NO PEDIDO
        if($idProduto != null){
            $itemPedido = array(
                "idProduto" => $idProduto,
                "idPedido" => $idPedido,
                "quantidade" => 1
            );

            $idItemPedido = $this->itemPedidoDAO->salvarItemPedido($itemPedido);
        }
    }

    private function getListaLances($idLeilao) {
        $this->load->model("lance_model", "lance");
        $lista = $this->lance->buscarListaLancePorIdLeilao($idLeilao);
        $retorno = "";
        if ($lista != "") {
            foreach ($lista as $row) {
                $retorno = $retorno. $row->data."#".$row->valor."#".$row->login."@";
            }
        }
        return $retorno;
    }

    /**
     * retora o horário em microsegundos para utilização no js
     */
    function retHorario() {
        //$tempoCliente = $this->input->post("rand");
        
        $mkTimeServer = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
        //if($tempoCliente == ""){
            echo json_encode(array("time" =>$mkTimeServer ));
        //}
        //else{  
          //  $arrayTempoCliente = explode("/", $tempoCliente);
           // $mkTimeCliente = mktime(date($arrayTempoCliente[3]), date($arrayTempoCliente[4]), date($arrayTempoCliente[5]), date($arrayTempoCliente[1]), date($arrayTempoCliente[0]), date($arrayTempoCliente[2]));
           // echo json_encode(array("time" =>$tempoCliente));
        //}
    }
    function retHorarioAtual() {
        echo mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
    }

    function retLances($id = "") {
        $idConta = $this->input->post("id") != "" ? $this->input->post("id") : $id;

        if ($idConta != "") {
            $saldo = $this->Conta_model->buscarSaldoConta($idConta);
            if ($id == "")
                echo json_encode(array("saldo" => $saldo));
            else
                return $saldo;
        }
        else {
            echo '';
        }
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
        $this->load->model("leilao_model", "leilao");

        $dados = explode("-", $param);

        $id = $dados[0];

        if ($id != "") {
            $leilaoArray["leilaoArray"] = $this->leilao->buscarLeilaoPorId($id);
        }
        
        $leilaoArray["leiloesArrematados"] = $this->getLeiloesArrematados();

        $this->load->view("_paginas/detalhe_produto", $leilaoArray);
    }
    
    public function getLeiloesArrematados() {
        $this->load->model('Leilao_model', 'leilao');
        return $this->leilao->listarLeiloesPublicadosEArrematados();
    }
}

?>
