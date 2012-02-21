<?php

class Categoria_model extends CI_Model {
    
    function getAll() {
        $query = $this->db->query("select * from tb_categoria");
        return $query->result();
    }
    
    function save($options = array()) {
        $this->db->insert('tb_categoria', $options);
        return $this->db->insert_id();
    }
    
    function update($options = array(), $id) {
        
        $this->db->where('idCategoria', $id);
        $this->db->update('tb_categoria', $options);
        return $this->db->insert_id();
    }
    
    function buscarPorId($id) {
        $this->db->where('idCategoria', $id);
        $query = $this->db->get("tb_categoria");
        return $query->result();
    }
    
}
?>
