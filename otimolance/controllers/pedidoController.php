<?php
require_once "PagSeguroLibrary/PagSeguroLibrary.php";
require_once "otimolance/models/Pedido.php";

class PedidoController extends CI_Controller {

    function __coCompraControllernstruct() {
        parent::__construct();
    }
    
    function pedidos(){
        $this->load->model('Pedido_model', 'pedidoDAO');
        $data["produtos"] = $this->produtoDAO->buscarProdutosGaleriaPorNomeCategoria("Lance");
        $this->load->view("compra/comprarLances",$data);
     }
     
     
}

?>
