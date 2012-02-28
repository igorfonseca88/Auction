<?php

class LeilaoController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('Leilao_model', 'leilaoDAO');
        $leilao["leiloes"] = $this->leilaoDAO->getAll();
        $leilao["categorias"] = $this->getCategoriasLeilao();
        $this->load->view("priv/leilao/leilaoList", $leilao);
    }

    function salvarNovoLeilao() {
        $this->load->model("Leilao_model", "leilao");

        $dataInicio = $this->ajustaDataSql($this->input->post("dataInicio")) . " " . $this->input->post("horaInicio");
        $format = 'Y-m-d H:i:s';
        $dateInicio = DateTime::createFromFormat($format, $dataInicio);


        $data = array(
            "dataCriacao" => date('Y-m-d H:i:s'),
            "dataInicio" => $dateInicio->format('Y-m-d H:i:s'),
            "tempoCronometro" => $this->input->post("tempoCronometro"),
            "valorLeilao" => $this->input->post("valorLeilao"),
            "idConta" => $this->session->userdata("idConta"),
            "idCategoriaLeilao" => $this->input->post("idCategoriaLeilao"),
            "freteGratis" => $this->input->post("freteGratis")
        );



        $id = $this->leilao->salvar($data);

        if ($id > 0) {
            $this->load->model('Leilao_model', 'leilao');
            $leilao["leilao"] = $this->leilao->buscarLeilaoPorId($id);

            if (!is_null($leilao)) {
                $leilao["sucesso"] = "Salvo com sucesso.";
                $leilao["categorias"] = $this->getCategoriasLeilao();
                $leilao["produtos"] = $this->getProdutos();
                $this->load->vars($leilao);
                $this->load->view("priv/leilao/leilaoEdit");
            }
        }
    }

    function editarLeilao($idLeilao) {
        $this->load->model("Leilao_model", "leilao");


        $dataInicio = $this->ajustaDataSql($this->input->post("dataInicio")) . " " . $this->input->post("horaInicio");
        $format = 'Y-m-d H:i:s';
        $dateInicio = DateTime::createFromFormat($format, $dataInicio);

        $data = array(
            "dataInicio" => $dateInicio->format('Y-m-d H:i:s'),
            "tempoCronometro" => $this->input->post("tempoCronometro"),
            "valorLeilao" => $this->input->post("valorLeilao"),
            "idCategoriaLeilao" => $this->input->post("idCategoriaLeilao"),
            "freteGratis" => $this->input->post("freteGratis")
        );

        $result = $this->leilao->alterar($data, $idLeilao);
        $mensagem = array();
        if ($result > 0) {
            $msg = "Salvo com sucesso.";
        }
        $mensagem["sucesso"] = $msg;
        $this->editarLeilaoAction($idLeilao, $mensagem);
    }

    function salvarItemLeilao($idLeilao) {
        $this->load->model("Leilao_model", "leilao");
        $produto = $this->input->post("idProduto");
        $valorFrete = $this->input->post("valorFrete");
        $valorProduto = $this->input->post("valorProduto");

        $mensagem = array();
        $msg = "";
        $erro = false;
        if ($produto == "") {
            $erro = true;
            $msg .= "Produto obrigatório." . "<br/>";
        }
        if ($valorProduto == "") {
            $msg .= " Valor do produto é obrigatório." . "<br/>";
            $erro = true;
        }
        if ($valorFrete == "") {
            $msg .= " Valor do frete é obrigatório.";
            $erro = true;
        }

        if ($erro == FALSE) {
            $data = array(
                "idLeilao" => $idLeilao,
                "valorFrete" => $valorFrete,
                "valorProduto" => $valorProduto,
                "idProduto" => $produto
            );
            $itemLeilao = $this->input->post("hIdItemLeilao");
            $result = $this->leilao->salvarItemLeilao($data, $itemLeilao);

            if ($result > 0) {
                $msg = "Salvo com sucesso.";
            }
            $mensagem["sucesso"] = $msg;
            $this->editarLeilaoAction($idLeilao, $mensagem);
        } else {
            $mensagem["erro"] = $msg;
            $this->editarLeilaoAction($idLeilao, $mensagem);
        }
    }

    /* Actions */

    function editarLeilaoAction($id, $mensagem = array()) {
        $this->load->model('Leilao_model', 'leilao');
        $leilao["leilao"] = $this->leilao->buscarLeilaoPorId($id);
        $leilao["categorias"] = $this->getCategoriasLeilao();
        $leilao["produtos"] = $this->getProdutos();
        $leilao["lances"] = $this->getLances($id);
        $leilao["sucesso"] = $mensagem["sucesso"];
        $leilao["erro"] = $mensagem["erro"];
        //$leilao["itemLeilao"] = $this->getItemLeilao($id);

        if (!is_null($leilao)) {
            $this->load->vars($leilao);
            $this->load->view("priv/leilao/LeilaoEdit");
        }
    }

    function novoLeilaoAction() {
        $leilao["categorias"] = $this->getCategoriasLeilao();
        $this->load->vars($leilao);
        $this->load->view("priv/leilao/leilaoAdd");
    }

    function pesquisarAction() {
        $this->load->model('Leilao_model', 'leilao');
        $situacao = $this->input->post("situacao");
        $categoriaLeilao = $this->input->post("idCategoriaLeilao");

        $this->leilao->situacao = $situacao;
        $this->leilao->idCategoriaLeilao = $categoriaLeilao;

        $leilao["leiloes"] = $this->leilao->getAll();
        $leilao["categorias"] = $this->getCategoriasLeilao();
        $this->load->vars($leilao);
        $this->load->view("priv/leilao/leilaoList");
    }

    function publicarLeilao($idLeilao) {
        $this->load->model("Leilao_model", "leilao");

        if ($this->leilao->leilaoProntoParaPublicar($idLeilao) == true) {

            $data = array(
                "publicado" => 1
            );

            $result = $this->leilao->alterar($data, $idLeilao);
            $mensagem = array();
            if ($result > 0) {
                $msg = "Salvo com sucesso.";
            }
            $mensagem["sucesso"] = $msg;
        }
        else{
            $mensagem["erro"] = 'Adicione um produto a ser leiloado.';
        }
        $this->editarLeilaoAction($idLeilao, $mensagem);
    }

    function getCategoriasLeilao() {
        $this->load->model("CategoriaLeilao_model", "categoria");
        return $this->categoria->getAll();
    }

    function getProdutos() {
        $this->load->model("Produto_model", "produto");
        return $this->produto->getAll();
    }

    function getLances($idLeilao) {
        $this->load->model("lance_model", "lance");
        return $this->lance->buscarLancesPorIdLeilao($idLeilao);
    }

    function ajustaDataSql($data) {
        if ($data) {
            $dataDividida = explode("/", $data);
            return $dataDividida[2] . "-" . $dataDividida[1] . "-" . $dataDividida[0];
        }
        return NULL;
    }

    /* metodos para o site */

    function detalheLeilao($param) {
        echo "to aqui" . $param;

        $dados = explode("-", $param);

        $id = $dados[0];

        echo $id;

        exit;
    }

}

?>
