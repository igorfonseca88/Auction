<?php

class CategoriaLeilao_model extends CI_Model {
    
	function getAll() {
        $query = $this->db->query("select idCategoriaLeilao, categoriaLeilao
                   from tb_categoriaLeilao");
        return $query->result();
    }
}
?>
