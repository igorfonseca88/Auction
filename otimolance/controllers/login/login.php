<?php

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        
        // VALIDATION RULES 
        //$this->load->library('form_validation');
        $this->form_validation->set_rules('usuarioEmail', 'Usuario', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $error = array('error' => 'Usuario e senha obrigatórios.');
            $this->load->vars($error);
            $this->load->view('login/login_view');
        } else {
            $error = $this->autenticar();
            
            $error = array('error' => 'Usuario inativo.');
            $this->load->vars($error);
            $this->load->view('login/login_view');
            
        }
    }
	
	function autenticar(){
	
		$usuario = $this->input->post("usuario");
		$senha = $this->input->post("senha");
		echo $usuario."--";
		echo $senha;
		exit;
	
	}

    function login() {
	    // MODELO USUARIO
        $this->load->model('Usuario_model');
        $this->Usuario_model->setLogin($this->input->post("usuarioEmail"));
        $this->Usuario_model->setSenha($this->input->post("senha"));


        $usuarios = $this->Usuario_model->validate();

        if ($usuarios) {

            foreach ($usuarios as $row) {
                $this->Usuario_model->setIdUsuario($row->idUsuario);
                $this->Usuario_model->setSituacao($row->situacao);
            }
            
            if($this->Usuario_model->getSituacao() != "ATIVO"){
                return 1;
            }
            
            // VERIFICA LOGIN E SENHA 
            $data = array(
                'session_id' => $this->Usuario_model->getIdUsuario(),
                'idUsuario' => $this->Usuario_model->getIdUsuario(),
                'login' => $this->Usuario_model->getLogin(),
                'senha' => $this->Usuario_model->getSenha(),   
                'logged' => true
                 );
           
            $this->session->set_userdata($data);
            redirect('principal');
        } else {
            redirect($this->index());
        }
    }
    
    function logoff(){
        $this->session->sess_destroy();
        redirect($this->index());
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */