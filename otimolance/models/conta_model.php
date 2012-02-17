<?php

class Conta_model extends CI_Model {

    const TU_ADMIN = 1;
    const TU_CLIENTE = 2;
    const TU_INTERNO = 3;
    
    private $login;
    private $senha;
    private $idConta;
    private $idTipoUsuario;
    private $tipoUsuario;

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

    public function getIdConta() {
        return $this->idConta;
    }

    public function setIdConta($idConta) {
        $this->idConta = $idConta;
    }

    public function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    public function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

       

    function validate() {

        $sql = "select idConta, login, senha, c.idTipoUsuario, tipoUsuario from tb_conta c 
                join tb_tipousuario tu  on tu.idTipoUsuario = c.idTipoUsuario
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
    
    function validaTipoUsuario($idTipo) {
        $idTipoUsuario = $this->session->userdata('idTipoUsuario');
        echo $idTipoUsuario;
        if (!isset($idTipoUsuario) || $idTipoUsuario != $idTipo) {
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
	
    function salvar($data = array()) {
        $this->db->insert('tb_conta', $data);
        return $this->db->insert_id();
    }
    
    function alterar($data = array(), $id) {
        $this->db->where('idConta', $id);
        $this->db->update('tb_conta', $data);
        return $this->db->affected_rows();
    }

    function getAll() {
        $where = "";
            
        if($this->idTipoUsuario != ""){
            $where != "" ? $where .= " AND " : $where = " WHERE ";
            $where.= " c.idTipoUsuario = " . $this->idTipoUsuario;
        }
        
        $query = $this->db->query("select c.idConta, c.nome, c.sobrenome, c.cpf, 
            c.login, c.email, c.senha, c.receberEmail, c.aceitarTermo,
            t.idTipoUsuario, t.tipoUsuario
                   from tb_conta c 
                   join tb_tipousuario t on t.idTipoUsuario = c.idTipoUsuario $where ");
        return $query->result();
    }
    
    function buscarContaPorId($id) {

        $query = $this->db->query("select c.idConta, c.nome, c.sobrenome, c.cpf, 
            c.login, c.email, c.senha, c.receberEmail, c.aceitarTermo, c.idTipoUsuario
               FROM tb_conta c 
               where c.idConta = $id ");
        return $query->result();
    }
}

?>