<?php

class Leilao_model extends CI_Model {
    
	function getAll() {
        $query = $this->db->query("select idLeilao, dataCriacao, dataInicio, dataFim, tempoCronometro, valorLeilao, idConta, idCategoriaLeilao
                   from tb_leilao");
        return $query->result();
    }
}
?>
