<?php

class Usuario_model extends CI_Model {

    private $login;
    private $senha;
    private $idUsuario;
    private $situacao;

    function getLogin() {
        return $this->login;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function validate() {

        $sql = "select idUsuario, login, situacao from tb_usuario 
                where login = '" . $this->getLogin() . "' and senha = '" . $this->getSenha() . "'";

        $query = $this->db->query($sql);

        return $query->result();
    }

# VERIFICA SE O USUÁRIO ESTÁ LOGADO 

    function logged() {
        $logged = $this->session->userdata('logged');
        if (!isset($logged) || $logged != true) {
            return false;
        }
        return true;
    }

// acesso a banco

    function get_all() {
        $query = $this->db->query("select * from tb_usuario");
        return $query->result();
    }

    function get_nome($login) {
        $this->db->where('login', $login);
        $query = $this->db->get("tb_usuario");
        return $query->result();
    }
    
    function buscarUsuarioPorId($id) {
        $this->db->where('idUsuario', $id);
        $query = $this->db->get("tb_usuario");
        return $query->result();
    }

    function add_record($options = array()) {
        $this->db->insert('tb_usuario', $options);
        return $this->db->affected_rows();
    }

}

?>