<?php

class Cliente_model extends CI_Model {
    
    

    function getAll() {
        $query = $this->db->query("select * from tb_cliente");
        return $query->result();
    }

    // adiciona um cliente
    function add_record($options = array()) {
        $this->db->insert('tb_cliente', $options);
        return $this->db->affected_rows();
    }
    
    function update_record($options = array(), $id) {
        
        $this->db->where('idCliente', $id);
        $this->db->update('tb_cliente', $options);
        return $this->db->affected_rows();
    }
    
    
    // busca um cliente por id
    function buscarPorId($id) {
        $this->db->where('idCliente', $id);
        $query = $this->db->get("tb_cliente");
        return $query->result();
    }
}
?>
