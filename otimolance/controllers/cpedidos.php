<?php

class Cpedidos extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
       $this->load->model('Pedido_model', 'pedidoDAO');
       $pedidos["pedidos"] = $this->pedidoDAO->buscarPedidoPorFiltros();
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
    
    function pesquisarAction($offset=0) {
        $this->load->model('Pedido_model', 'pedidoDAO');
        $situacao = $this->input->post("situacao");

        
        $query = $this->pedidoDAO->buscarPedidoPorFiltros($situacao, 4, $offset);

        $config['base_url'] = base_url() . "cpedidos/pesquisarAction";
        
        $config['total_rows'] = $this->db->count_all('tb_pedido');
        $config['per_page'] = '4';
        $config['first_link'] = 'Inicio';
        $config['prev_link'] = 'Anterior';
        $config['next_link'] = 'Proximo';
        $config['last_link'] = 'Fim';
        $this->pagination->initialize($config);


        $data['paginacao'] = $this->pagination->create_links();
        $data['pedidos'] = $query->result();
        $this->load->vars($data);
        $this->load->view("priv/pedido/pedidoList");
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
