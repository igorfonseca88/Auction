<?php

class ProdutoController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        echo 'teste';
        $this->load->model('Produto_model', 'leilaoDAO');
        $data["produtos"] = $this->leilaoDAO->getAll();
        print_r($data);
        $this->load->view("produto/produtoList",$data);
    }
    
    function salvarNovoProduto(){
        $this->load->model("Produto_model", "produto");
        
        $data = array(
            "nome" => $this->input->post("txtNome"),
            "descricao" => $this->input->post("txtDescricao"),
            "idCategoria" => $this->input->post("txtNomeFantasia"),
            "preco" => $this->input->post("txtPreco")
        );

        if ($this->produto->add_record($data) > 0) {
            redirect("produtoController");
        }
    }
    
    function editarProduto(){
        $this->load->model("Produto_model", "produto");
        $id = $this->input->post("idProdutoh");
        
        $data = array(
            "nome" => $this->input->post("txtNome"),
            "descricao" => $this->input->post("txtDescricao"),
            "idCategoria" => $this->input->post("txtNomeFantasia"),
            "preco" => $this->input->post("txtPreco")
        );

        if ($this->produto->update_record($data,$id) > 0) {
            $this->session->set_flashdata('sucesso','Produto salvo com sucesso.');
            
            redirect("produtoController");
        }
	else 
	    redirect("produtoController");
    }
    
    function uploadImagem($id) {

        //parametriza as preferências
        $config["upload_path"] = "./upload/produtos/";
        $config["allowed_types"] = "gif|jpg|png";
        $config["file_name"] = "logomarca_".$id;
        $config["overwrite"] = TRUE;
        $config["remove_spaces"] = TRUE;
        $this->load->library("upload", $config);
        //em caso de sucesso no upload
        if ($this->upload->do_upload()) {
           
            $this->load->model('Produto_model', 'produto');
            $this->load->model('Comentario_model', 'comentario');
            $this->load->helper('url');
            
            $update = array(
                "logomarca" => $this->upload->file_name);

            $this->produto->update_record($update,$id);



            $produto["produto"] = $this->produto->buscarPorId($id);
            $produto["comentarios"] = $this->comentario->buscarComentarioPorTipoEId("CLIENTE",$id);
            
            

            if (!is_null($produto)) {
                $produto["sucesso"] = "Logomarca cadastrada com sucesso";
                $this->load->vars($produto);
                $this->load->view("produto/editProduto");
            }
        } else {
            echo $this->upload->display_errors();
        }
    }
    
    /* Actions */
    
    function editarProdutoAction($id){
        $this->load->model('Produto_model', 'produto');
        $this->load->model('Comentario_model', 'comentario');
        $produto["produto"] = $this->produto->buscarPorId($id);
        //$produto["comentarios"] = $this->comentario->buscarComentarioPorTipoEId("CLIENTE", $id);
        
        if(!is_null($produto)){
            $this->load->vars($produto);
            $this->load->view("produto/editProduto");
        }
    }
    
       
    function novoProdutoAction(){
        $this->load->view("leilao/leilaoEdit");
    }
    
}

?>
