<?php

class CompraController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function comprarLances(){
        $this->load->model('Produto_model', 'produtoDAO');
        $data["produtos"] = $this->produtoDAO->buscarProdutosPorIdCategoria(2);
        $this->load->view("priv/compra/comprarLances",$data);
    
     }
}

?>
