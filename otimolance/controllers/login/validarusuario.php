<?php

class ValidarUsuario extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        echo $this->session->userdata("login");
        exit;
        
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
                'idUsuario' => $this->Usuario_model->getIdUsuario(),
                'login' => $this->Usuario_model->getLogin());
            
            $this->session->set_userdata($data);
            redirect('principal');
        } else {
            redirect($this->index());
        }
        
    }
}
?>
