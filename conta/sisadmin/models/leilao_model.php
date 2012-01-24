<?php

class Leilao_model extends CI_Model {

    function getAll() {
        $query = $this->db->query("select idLeilao, dataCriacao, dataInicio, dataFim, tempoCronometro, valorLeilao, idConta, idCategoriaLeilao
                   from tb_leilao");
        return $query->result();
    }
    
    function salvar($data = array()){
        $this->db->insert('tb_leilao', $data);
        return $this->db->affected_rows();
    }
	
	function buscarLeilaoPorId($id){
	$query = $this->db->query("select idLeilao, dataCriacao, dataInicio, dataFim, tempoCronometro, valorLeilao, idConta, idCategoriaLeilao
                   from tb_leilao where idLeilao = $id ");
        return $query->result();
	}

}

?>
