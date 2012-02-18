<?php

class Lance_model extends CI_Model {


    function salvarLance($data = array()) {
        $this->db->insert('tb_lance', $data);
        return $this->db->insert_id();
    }

    function buscarValorUltimoLance($idLeilao) {

        $query = $this->db->query("select ifnull(max(valor),0) as valor
               FROM tb_lance
               where idLeilao = $idLeilao ");
        
        $valor = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $valor = $row->valor;
            }
        }
        return $valor;
    }
}

?>
