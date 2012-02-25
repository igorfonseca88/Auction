<?php

class CategoriaController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    private $msgPadrao = "";
    
    function index(){
        
        $this->load->model('CategoriaDAO', 'categoriaDAO');
        $data["categorias"] = $this->categoriaDAO->getAll();
        $this->load->view("priv/categoria/categoriaList",$data);
    }
    
 function salvarNovaCategoria() {
        $this->load->model("Categoria_model", "categoriaDAO");

        $data = array(
            "nome" => $this->input->post("txtNome")
        );

        $id = $this->categoriaDAO->save($data);

        $this->msgPadrao = "Categoria salva com sucesso.";
        $this->editarCategoriaAction($id);
    }
    
    function editarCategoria(){
        $this->load->model("Categoria_model", "categoriaDAO");
        $id = $this->input->post("idCategoriah");
        
        $data = array(
            "nome" => $this->input->post("txtNome")
        );

        $this->categoriaDAO->update($data,$id);
        $this->msgPadrao = "Categoria salva com sucesso.";
        $this->editarCategoriaAction($id);
    }
  

    function editarCategoriaAction($id){
        $this->load->model('Categoria_model', 'categoriaDAO');
        $categoria["categoria"] = $this->categoriaDAO->buscarPorId($id);

        $categoria["sucesso"] = $this->msgPadrao;
        $this->load->vars($categoria);
        $this->load->view("priv/categoria/categoriaEdit");
    }
       
    function excluirCategoriaAction($idCategoria){
        $this->load->model('Categoria_model', 'categoriaDAO');
        
        $delete = array("idCategoria" => $idCategoria);
         
        $this->categoriaDAO->excluirCategoria($delete);
        $this->session->set_flashdata('sucesso','Categoria excluída com sucesso.');
        redirect("categoriaController");
    }
    
    function novaCategoriaAction(){
        $this->load->view("priv/categoria/categoriaAdd");
    }
}

?>
