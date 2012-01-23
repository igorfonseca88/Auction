<?php

class CategoriaDAO extends CI_Model {
    
	function getAll() {
        $query = $this->db->query("select * from tb_categoria");
        return $query->result();
    }
}
?>
