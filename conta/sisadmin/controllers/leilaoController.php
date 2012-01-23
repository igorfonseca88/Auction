<?php

class LeilaoController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        $this->load->model('Leilao_model', 'leilaoDAO');
        $data["leiloes"] = $this->leilaoDAO->getAll();
        $this->load->view("priv/leilao/leilaoList",$data);
    }
    
    function salvarNovoLeilao(){
        $this->load->model("Cliente_model", "cliente");
        
        $data = array(
            "cnpj_cpf" => $this->input->post("txtCPF_CNPJ"),
            "razaoSocial" => $this->input->post("txtRazaoSocial"),
            "nomeFantasia" => $this->input->post("txtNomeFantasia"),
            "logradouro" => $this->input->post("txtLogradouro"),
            "nro" => $this->input->post("txtNumero"),
            "bairro" => $this->input->post("txtBairro"),
            "complemento" => $this->input->post("txtComplemento"),
            "cep" => $this->input->post("txtCEP"),
            "telefone" => $this->input->post("txtTelefone"),
            "email" => $this->input->post("txtEmail"),
            "site" => $this->input->post("txtSite"),
            "institucional" => $this->input->post("txtInstitucional"),
            "video" => $this->input->post("video")
        );

        if ($this->cliente->add_record($data) > 0) {
            redirect("clienteController");
        }
    }
    
    function editarLeilao(){
        $this->load->model("Leilao_model", "leilaoDAO");
        $id = $this->input->post("idClienteh");
        
        $data = array(
            "cnpj_cpf" => $this->input->post("txtCPF_CNPJ"),
            "razaoSocial" => $this->input->post("txtRazaoSocial"),
            "nomeFantasia" => $this->input->post("txtNomeFantasia"),
            "logradouro" => $this->input->post("txtLogradouro"),
            "nro" => $this->input->post("txtNumero"),
            "bairro" => $this->input->post("txtBairro"),
            "complemento" => $this->input->post("txtComplemento"),
            "cep" => $this->input->post("txtCEP"),
            "telefone" => $this->input->post("txtTelefone"),
            "email" => $this->input->post("txtEmail"),
            "site" => $this->input->post("txtSite"), 
            "institucional" => $this->input->post("txtInstitucional"),
            "video" => $this->input->post("video")
        );

        if ($this->cliente->update_record($data,$id) > 0) {
            $this->session->set_flashdata('sucesso','Cadastro salvo com sucesso.');
            
            redirect("clienteController");
        }
	else 
	    redirect("clienteController");
    }
    
    function uploadImagem($id) {

        //parametriza as preferências
        $config["upload_path"] = "./upload/clientes/";
        $config["allowed_types"] = "gif|jpg|png";
        $config["file_name"] = "logomarca_".$id;
        $config["overwrite"] = TRUE;
        $config["remove_spaces"] = TRUE;
        $this->load->library("upload", $config);
        //em caso de sucesso no upload
        if ($this->upload->do_upload()) {
           
            $this->load->model('Cliente_model', 'cliente');
            $this->load->model('Comentario_model', 'comentario');
            $this->load->helper('url');
            
            $update = array(
                "logomarca" => $this->upload->file_name);

            $this->cliente->update_record($update,$id);



            $cliente["cliente"] = $this->cliente->buscarPorId($id);
            $cliente["comentarios"] = $this->comentario->buscarComentarioPorTipoEId("CLIENTE",$id);
            
            

            if (!is_null($cliente)) {
                $cliente["sucesso"] = "Logomarca cadastrada com sucesso";
                $this->load->vars($cliente);
                $this->load->view("cliente/editCliente");
            }
        } else {
            echo $this->upload->display_errors();
        }
    }
    
    /* Actions */
    
    function editarLeilaoAction($id){
        $this->load->model('Cliente_model', 'cliente');
        $this->load->model('Comentario_model', 'comentario');
        $cliente["cliente"] = $this->cliente->buscarPorId($id);
        //$cliente["comentarios"] = $this->comentario->buscarComentarioPorTipoEId("CLIENTE", $id);
        
        if(!is_null($cliente)){
            $this->load->vars($cliente);
            $this->load->view("cliente/editCliente");
        }
    }
    
       
    function novoLeilaoAction(){
        $this->load->view("leilao/leilaoEdit");
    }
	
	function getCategoriasLeilao() {
        $this->load->model("CategoriaLeilao_model", "categoria");
        return $this->categoria->getAll();
    }
    
}

?>
