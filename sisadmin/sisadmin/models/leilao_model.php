<?php

class Leilao_model extends CI_Model {
    
	function getAll() {
        $query = $this->db->query("select * from tb_leilao");
        return $query->result();
    }
}
?>
