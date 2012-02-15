<?php

class Principal extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $leiloes["leiloes"] = $this->getLeiloes();
        $this->load->vars($leiloes);
        $this->load->view('index');
    }

    public function areaRestrita() {
        $this->load->view('priv/default');
    }

    /*
     * metodos para login
     */

    public function redirecionaLoginClientes() {
        $this->load->view('autenticar');
    }

    public function redirecionaLogin() {
        $this->load->view('priv/login/login_view');
    }

    /* metodos para carregar leilos */

    public function getLeiloes() {
        $this->load->model('Leilao_model', 'leilao');
        return $this->leilao->getAll();
    }

}

