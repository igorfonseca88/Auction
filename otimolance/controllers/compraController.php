<?php

class CompraController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function comprarLances(){
        $this->load->model('Produto_model', 'produtoDAO');
        $data["produtos"] = $this->produtoDAO->buscarProdutosPorNomeCategoria("Lance");
        $this->load->view("compra/comprarLances",$data);
    
     }
     
     function carrinho($idProduto){
         echo $idProduto;
    
     }
}

?>
