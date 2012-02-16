<?php

class Parametro_model extends CI_Model {

    function buscarParametros() {
        $query = $this->db->get("tb_parametrosistema");
        return $query->result();
    }
    
    function salvar($data = array(), $id) {
        $this->db->where('idParametro', $id);
        $this->db->update('tb_parametrosistema', $data);
        return $this->db->affected_rows();
    }

}

?>