<?php

class CompraController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function comprarLances(){
        $this->load->model('Produto_model', 'produtoDAO');
        $data["produtos"] = $this->produtoDAO->buscarProdutosGaleriaPorNomeCategoria("Lance");
        $this->load->view("compra/comprarLances",$data);
    
     }
     
     function carrinho($idProduto){
        $this->load->model('Produto_model', 'produtoDAO');
        $data["produtos"] = $this->produtoDAO->buscarProdutosGaleriaPorIdProduto($idProduto);
        $this->load->view("compra/carrinhoCompra",$data);
    
     }
     
     function pagamento(){
        $this->load->model("Produto_model", "produtoDAO");
        $idProduto = $this->input->post("idProdutoHidden");
        $data["produtos"] = $this->produtoDAO->buscarProdutosGaleriaPorIdProduto($idProduto);
        $this->load->view("compra/pagamento",$data);
     }
}

?>
