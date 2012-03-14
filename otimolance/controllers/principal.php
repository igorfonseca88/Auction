<?php

class Principal extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }
    
    
    function home(){
        $leiloes["leiloes"] = $this->getLeiloes();
        $leiloes["leiloesArrematados"] = $this->getLeiloesArrematados();
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
        return $this->leilao->listarLeiloesPublicados();
    }
    
    public function carregarConta(){
        $this->load->view('conta/conta');
    }
    
    public function getLeiloesArrematados() {
        $this->load->model('Leilao_model', 'leilao');
        return $this->leilao->listarLeiloesPublicadosEArrematados();
    }
    

}

