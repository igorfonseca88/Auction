<?php

class ProdutoController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    private $msgSucesso = "";
    private $msgErro = "";
    private $msgAlerta = "";
    
    function index(){
        $this->load->model('Produto_model', 'produtoDAO');
        $data["produtos"] = $this->produtoDAO->getAll();
        $this->load->view("priv/produto/produtoList",$data);
    }
    
    function salvarNovoProduto(){
        $this->load->model("Produto_model", "produto");
        
        $data = array(
            "nome" => $this->input->post("txtNome"),
            "descricao" => $this->input->post("txtDescricao"),
            "idCategoria" => $this->input->post("idCategoria"),
            "preco" => $this->input->post("txtPreco"),
            "desconto" => $this->input->post("txtDesconto")
             
        );
        
           $id = $this->produto->add($data);
           $produto["produto"] = $this->produto->buscarPorId($id);

            if (!is_null($produto)) {
                $this->msgSucesso= "Produto salvo com sucesso";
                $this->editarProdutoAction($id);
            }
    }
    
    function editarProduto(){
        $this->load->model("Produto_model", "produtoDAO");
        $id = $this->input->post("idProdutoh");
        
        $data = array(
            "nome" => $this->input->post("txtNome"),
            "descricao" => $this->input->post("txtDescricao"),
            "idCategoria" => $this->input->post("idCategoria"),
            "preco" => $this->input->post("txtPreco"),
            "desconto" => $this->input->post("txtDesconto")
                
        );

        $this->produtoDAO->update($data,$id);
        $this->msgSucesso = "Produto salvo com sucesso";
        $this->editarProdutoAction($id);
       
    }
    
     function uploadImagem($id) {

        $isPrincipal = $this->input->post("isPrincipal");
        //parametriza as preferências
        $config["upload_path"] = "./upload/produtos/";
        $config["allowed_types"] = "gif|jpg|png";
        $numeroRand = rand(00, 9999);
        $config["file_name"] =  "imgProduto_".$numeroRand."_".$id ;
        $config["overwrite"] = TRUE;
        $config["remove_spaces"] = TRUE;
        $this->load->library("upload", $config);
        //em caso de sucesso no upload  
        if ($this->upload->do_upload()) {
           
            $this->load->model('Galeria_model', 'galeriaDAO');
            $this->load->model('Produto_model', 'produtoDAO');
            
            $data = array('upload_data' => $this->upload->data());

            $insert = array(
                "caminho" => $this->upload->file_name,
                "idProduto" => $id,
                "isPrincipal" => $isPrincipal,
                "tipoGaleria" => 'imagem'
                 );

            $this->galeriaDAO->salvarGaleria($insert);
            $this->msgSucesso = "Imagem salva com sucesso";
            $this->editarProdutoAction($id);
            
        } else {
            $this->msgAlerta = "Selecione uma imagem para enviar.";
            $this->editarProdutoAction($id);
        }
    }
    
    function excluirImagem($id){
        $this->load->model('Galeria_model', 'galeriaDAO');
        
        $galeria["galeria"] = $this->galeriaDAO->buscarGaleriaPorId($id);
        
        foreach ($galeria as $row) {
            $caminho =  $row[0]->caminho;
            $idProduto = $row[0]->idProduto;
        }
        
        $filename = "./upload/produtos/".$caminho;
        
        if(unlink($filename)){
            $delete = array(
                "idGaleria" => $id
             );
             print_r($delete);
            $this->galeriaDAO->excluirGaleria($delete);
        }
        
       $this->msgSucesso = "Imagem excluída com sucesso";
       $this->editarProdutoAction($idProduto);
        
    }
    
    function uploadVideo($id) {
        $this->load->model('Galeria_model', 'galeriaDAO');
        $this->load->model('Produto_model', 'produtoDAO');
        
        if($this->input->post("video") != ""){
            
        $insert = array(
                "embed" => $this->input->post("video"),
                "idProduto" => $id,
                "tipoGaleria" => 'video'
                 );

            $this->galeriaDAO->salvarGaleria($insert);
            $this->msgSucesso = "Video salvo com sucesso.";
            $this->editarProdutoAction($id);

        } else {
            $this->msgAlerta = "Adicione um embed para enviar.";
            $this->editarProdutoAction($id);
        }
    }
    
    function excluirVideo($id){
        $this->load->model('Galeria_model', 'galeriaDAO');
        echo $id;
        $galeria["galeria"] = $this->galeriaDAO->buscarGaleriaPorId($id);
        
        foreach ($galeria as $row) {
            $idProduto = $row[0]->idProduto;
        }
        
        $delete = array(
               "idGaleria" => $id
         );
        $this->galeriaDAO->excluirGaleria($delete);
        $this->msgSucesso = "Video excluído com sucesso";
        $this->editarProdutoAction($idProduto);
    }
    
    function editarProdutoAction($id){
        $this->load->model('Produto_model', 'produtoDAO');
        $produto["produto"] = $this->produtoDAO->buscarPorId($id);
        
        if(!is_null($produto)){
            $produto["categorias"] = $this->getCategorias();
            $produto["galeria"] = $this->getGaleriaPorIdProdutoETipo($id, 'imagem');
            $produto["galeriaVideo"] = $this->getGaleriaPorIdProdutoETipo($id, 'video');
            $produto["sucesso"] = $this->msgSucesso;
            $produto["erro"] = $this->msgErro;
            $produto["alerta"] = $this->msgAlerta;
            $this->load->vars($produto);
            $this->load->view("priv/produto/produtoEdit");
        }
    }
    
    function excluirProdutoAction($idProduto){
         $this->load->model('Produto_model', 'produtoDAO');
         $this->load->model('Galeria_model', 'galeriaDAO');
        
         $galeria[] = $this->galeriaDAO->buscarGaleriaPorIdProduto($idProduto);
         //exclui galeria antes de excluir produto
         foreach ($galeria[0] as $row) {
           $delete = array("idGaleria" => $row->idGaleria);
           $this->galeriaDAO->excluirGaleria($delete);
                   
        }

        $delete = array("idProduto" => $idProduto);
         
        $this->produtoDAO->excluirProduto($delete);
        $this->session->set_flashdata('sucesso','Produto excluído com sucesso.');
        redirect("produtoController");
    }
    
    function novoProdutoAction(){
        $produto["categorias"] = $this->getCategorias();
        $this->load->vars($produto);
        $this->load->view("priv/produto/produtoAdd");
    }
    
    function getCategorias() {
        $this->load->model("Categoria_model", "categoriaDAO");
        return $this->categoriaDAO->getAll();
    }

    
    /*
     * Retorna em string os dados 
     * PRECO
     */
    function buscarDadosProdutoAjax() {
        $id = $this->input->get_post("idProduto");
        $this->load->model('Produto_model', 'produtoDAO');
        
        $produtos = array();
        $produtos = $this->produtoDAO->buscarPorId($id);

        $retorno = $produtos[0]->preco . "@";
        echo $retorno;
        exit;
    }
    
    function getGaleriaPorIdProdutoETipo($id, $tipo) {
        $this->load->model("Galeria_model", "galeriaDAO");
        return $this->galeriaDAO->buscarGaleriaPorIdProdutoETipo($id, $tipo);
    }

}

?>
