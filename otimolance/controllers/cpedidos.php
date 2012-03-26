<?php

class Cpedidos extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

   function listarEmAndamento(){
       $this->load->model('Pedido_model', 'pedidoDAO');
       $pedidos["pedidos"] = $this->pedidoDAO->buscarPedidoPorStatusPedido(Pedido_model::STATUS_EM_ANDAMENTO);
       $this->load->vars($pedidos);
       $this->load->view("priv/pedido/pedidoList");
   }
   
   function editarPedidoAction($id) {
        $this->load->model('Pedido_model', 'pedidoDAO');
        $pedido["pedido"] = $this->pedidoDAO->buscarPedidoPorId($id);
        $pedido["itensPedido"] = $this->pedidoDAO->buscarItensPedidoPorIdPedido($id);

        if (!is_null($pedido)) {
            $this->load->vars($pedido);
            $this->load->view("priv/pedido/pedidoEdit");
        }
    }

    function ajustaDataSql($data) {
        if ($data) {
            $dataDividida = explode("/", $data);
            return $dataDividida[2] . "-" . $dataDividida[1] . "-" . $dataDividida[0];
        }
        return NULL;
    }
    
   
}

?>
