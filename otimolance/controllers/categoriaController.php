<?php

class CategoriaController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        
        $this->load->model('CategoriaDAO', 'categoriaDAO');
        $data["categorias"] = $this->categoriaDAO->getAll();
        $this->load->view("priv/categoria/categoriaList",$data);
    }
    
 function salvarNovaCategoria() {
        $this->load->model("Categoria_model", "categoria");

        $data = array(
            "nome" => $this->input->post("txtNome")
        );

        $id = $this->categoria->save($data);

        if ($id > 0) {
            $categoria["categoria"] = $this->categoria->buscarPorId($id);

            if (!is_null($categoria)) {
                $categoria["sucesso"] = "Salvo com sucesso.";
                $this->load->vars($categoria);
                $this->load->view("priv/categoria/categoriaEdit");
            }
        }
    }
    
    function editarCategoria(){
        $this->load->model("Categoria_model", "categoria");
        $id = $this->input->post("idCategoriah");
        
        $data = array(
            "nome" => $this->input->post("txtNome")
        );

        if ($this->categoria->update($data,$id) > 0) {
            $this->session->set_flashdata('sucesso','Cadastro salvo com sucesso.');
            
            redirect("categoriaController");
        }
	else 
	    redirect("categoriaController");
    }
  
    /* Actions */
    
    function editarCategoriaAction($id){
        $this->load->model('Categoria_model', 'categoria');
        $categoria["categoria"] = $this->categoria->buscarPorId($id);

        if(!is_null($categoria)){
            $this->load->vars($categoria);
            $this->load->view("priv/categoria/categoriaEdit");
        }
    }
       
    function novaCategoriaAction(){
        $this->load->view("priv/categoria/categoriaAdd");
    }
    
}

?>
