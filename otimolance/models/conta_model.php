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
    private $status;

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
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }

    function validate() {

        $sql = "select idConta, login, senha, c.idTipoUsuario, tipoUsuario, status from tb_conta c 
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
        $query = $this->db->query("select * from tb_conta");
        return $query->result();
    }

    function get_nome($login) {
        $this->db->where('login', $login);
        $query = $this->db->get("tb_conta");
        return $query->result();
    }
    
    function buscarUsuarioPorId($id) {
        $this->db->where('idConta', $id);
        $query = $this->db->get("tb_conta");
        return $query->result();
    }

    function salvar($data = array()) {
        $this->db->insert('tb_conta', $data);
        return $this->db->insert_id();
    }
    
    function salvarHistoricoSaldo($data = array()) {
        $this->db->insert('tb_historicosaldo', $data);
        return $this->db->insert_id();
    }
       
    function update($data = array(), $id) {
        $this->db->where('idConta', $id);
        $this->db->update('tb_conta', $data);
        return $this->db->affected_rows();
    }
    
    function excluirConta($data = array()){
        $this->db->delete('tb_conta', $data);
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
            c.login, c.email, c.senha, c.receberEmail, c.aceitarTermo, c.idTipoUsuario,
            c.ip, c.status, c.sexo, c.dtNascimento, c.cep, c.logradouro, c.numero, c.complemento,
            c.bairro, c.estado, c.cidade, c.telefone, c.celular, c.saldo
               FROM tb_conta c 
               where c.idConta = $id ");
        return $query->result();
    }
    
    function listarContaCliente() {
        $query = $this->db->query("select c.idConta, c.nome, c.sobrenome, c.cpf, 
            c.login, c.email, c.senha, c.receberEmail, c.aceitarTermo, c.idTipoUsuario, c.saldo
               FROM tb_conta c 
               where c.idTipoUsuario = 2");
        return $query->result();
    }
    
    function listarContaInterna() {
        $query = $this->db->query("select c.idConta, c.nome, c.sobrenome, c.cpf, 
            c.login, c.email, c.senha, c.receberEmail, c.aceitarTermo, c.idTipoUsuario, c.saldo
               FROM tb_conta c 
               where c.idTipoUsuario <> 2");
        return $query->result();
    }
    
    function buscarLoginCadastrado($login) {
        $query = $this->db->query("select c.login FROM tb_conta c where c.login = '$login' ");
        return $query->result();
    }
    
    function buscarCpfCadastrado($cpf) {
        $query = $this->db->query("select c.cpf FROM tb_conta c where c.cpf = '$cpf' ");
        return $query->result();
    }
    
    function buscarEmailCadastrado($email) {
        $query = $this->db->query("select c.email FROM tb_conta c where c.email = '$email' ");
        return $query->result();
    }
    
    function buscarEmailCadastradoEdit($email, $id) {
        $query = $this->db->query("select c.email FROM tb_conta c where c.email = '$email' and c.idConta <> '$id' ");
        return $query->result();
    }
    
    function buscarIpCadastrado($ip) {
        $query = $this->db->query("select c.ip FROM tb_conta c where c.ip = '$ip' ");
        return $query->result();
    }
    
    function existeSaldoNaConta($idConta){
        $query = $this->db->query("select saldo
               FROM tb_conta c 
               where c.idConta = $idConta ");
        $saldo = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $saldo = $row->saldo;
            }
        }
        if($saldo > 0)
            return TRUE;
        else
            return FALSE;
    }
    
    function buscarSaldoConta($idConta){
        $query = $this->db->query("select ifnull(saldo,0) as saldo
               FROM tb_conta c 
               where c.idConta = $idConta ");
        $saldo = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $saldo = $row->saldo;
            }
        }
        return $saldo;
    }
    
    function recuperarSenha($email){
        $query = $this->db->query("select c.senha, c.login FROM tb_conta c where c.email = '$email' ");
        return $query->result();
    }
    
    function buscarSenhaAtual($senhaAtual, $id){
        $query = $this->db->query("select c.idConta FROM tb_conta c where c.idConta = '$id' and c.senha = '$senhaAtual' ");
        return $query->result();
    }
    
    function buscarExtratoLances($id){
        $query = $this->db->query("SELECT h.dataCadastro, h.qtdeLances, t.nome tipo
                FROM  tb_historicosaldo h
                INNER JOIN tb_tipoaquisicao t ON t.idTipoAquisicao = h.idTipoAquisicao
                WHERE h.idConta = $id ");
        return $query->result();
    }
}

?>