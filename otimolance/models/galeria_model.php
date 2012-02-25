<?php

class Galeria_model extends CI_Model {
    
    function buscarTodos() {
        $query = $this->db->query("select * from tb_galeria ");
        return $query->result();
    }
    
    function buscarGaleriaPorIdProdutoETipo($id, $tipo){
        $query = $this->db->query("select * from tb_galeria
                                   where idProduto = $id 
                                   and tipoGaleria = '$tipo'
                                   order by idGaleria desc ");
        return $query->result();
    }
    
    function buscarGaleriaPorIdProduto($id){
        $query = $this->db->query("select * from tb_galeria
                                   where idProduto = $id 
                                   order by idGaleria desc ");
        return $query->result();
    }
    
    // adiciona um anuncio
    function salvarGaleria($options = array()) {
        $this->db->insert('tb_galeria', $options);
        return $this->db->insert_id();
    }
    
    function excluirGaleria($options = array()){
        $this->db->delete('tb_galeria', $options);
    }
    
    function buscarGaleriaPorId($id){
        $this->db->where('idGaleria', $id);
        $query = $this->db->get("tb_galeria");
        return $query->result();
    }
    
}
?>
