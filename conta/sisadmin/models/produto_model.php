<?php

class Produto_model extends CI_Model {

    function getAll() {
        $query = $this->db->query("select * from tb_produto");
        return $query->result();
    }

    function add_record($options = array()) {
        $this->db->insert('tb_produto', $options);
        return $this->db->affected_rows();
    }
    
    function update_record($options = array(), $id) {
        
        $this->db->where('idProduto', $id);
        $this->db->update('tb_produto', $options);
        return $this->db->affected_rows();
    }
    
    function buscarPorId($id) {
        $this->db->where('idProduto', $id);
        $query = $this->db->get("tb_produto");
        return $query->result();
    }
}
?>
