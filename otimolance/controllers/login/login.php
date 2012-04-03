<?php

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

        if ($this->Conta_model->logged() == TRUE && ($this->Conta_model->validaTipoUsuario(Conta_model::TU_ADMIN) || $this->Conta_model->validaTipoUsuario(Conta_model::TU_INTERNO))) {
            redirect('principal/arearestrita');
        }

        $this->load->view('priv/login/login_view');
    }

    function autenticarClientes() {

        // se um usu�rio do tipo administrador estiver na sess�o n�o deixa logar aqui
        if ($this->Conta_model->logged() == TRUE && ($this->Conta_model->validaTipoUsuario(Conta_model::TU_ADMIN) || $this->Conta_model->validaTipoUsuario(Conta_model::TU_INTERNO))) {
            redirect('principal/redirecionaLogin');
        }
        // MODELO USUARIO

        $this->Conta_model->setLogin($this->input->post("login"));
        $this->Conta_model->setSenha($this->input->post("senha"));


        $usuarios = $this->Conta_model->validate();

        if ($usuarios) {

            foreach ($usuarios as $row) {
                $this->Conta_model->setIdConta($row->idConta);
                $this->Conta_model->setIdTipoUsuario($row->idTipoUsuario);
                $this->Conta_model->setTipoUsuario($row->tipoUsuario);
                $this->Conta_model->setStatus($row->status);
            }

            if ($this->Conta_model->getTipoUsuario() != "Cliente") {
                return 1;
            }
            
            if ($this->Conta_model->getStatus() != "liberado") {
                return 1;
            }

            // VERIFICA LOGIN E SENHA 
            $data = array(
                'session_id' => $this->Conta_model->getIdConta(),
                'idConta' => $this->Conta_model->getIdConta(),
                'login' => $this->Conta_model->getLogin(),
                'senha' => $this->Conta_model->getSenha(),
                'idTipoUsuario' => $this->Conta_model->getIdTipoUsuario(),
                'logged' => true
            );

            $this->session->set_userdata($data);
            redirect('home');
        } else {
            redirect('clientes/autenticar');
        }
    }

    function autenticarAdmin() {
        // se um usu�rio do tipo cliente estiver na sess�o n�o deixa logar aqui
        if ($this->Conta_model->logged() == TRUE && $this->Conta_model->validaTipoUsuario(Conta_model::TU_CLIENTE)) {
            redirect('home');
        }

        // MODELO USUARIO

        $this->Conta_model->setLogin($this->input->post("usuarioEmail"));
        $this->Conta_model->setSenha($this->input->post("senha"));


        $usuarios = $this->Conta_model->validate();

        if ($usuarios) {

            foreach ($usuarios as $row) {
                $this->Conta_model->setIdConta($row->idConta);
                $this->Conta_model->setIdTipoUsuario($row->idTipoUsuario);
                $this->Conta_model->setTipoUsuario($row->tipoUsuario);
            }

            if ($this->Conta_model->getTipoUsuario() != "Administrador") {
                return 1;
            }
            $numeroRand = rand(00, 999999999);
            // VERIFICA LOGIN E SENHA 
            $data = array(
                'session_idRest' => ($this->Conta_model->getIdConta()*$numeroRand),
                'idConta' => $this->Conta_model->getIdConta(),
                'loginRest' => $this->Conta_model->getLogin(),
                'senha' => $this->Conta_model->getSenha(),
                'idTipoUsuario' => $this->Conta_model->getIdTipoUsuario(),
                'logged' => true
            );

            $this->session->set_userdata($data);
            redirect('principal/arearestrita');
        } else {
            redirect($this->index());
        }
    }

    function logoffClientes() {
        $this->session->sess_destroy();
        redirect("home");
    }

    function logoff() {
        $this->session->sess_destroy();
        redirect("principal/arearestrita");
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */