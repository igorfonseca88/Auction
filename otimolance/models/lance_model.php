<?php

class Lance_model extends CI_Model {

    function salvarLance($data = array()) {
        $this->db->insert('tb_lance', $data);
        return $this->db->insert_id();
    }
    
    function atualizaSaldoConta($idConta) {
        $this->db->set('saldo', 'saldo - 1', FALSE);
        $this->db->where('idConta',$idConta);
        $this->db->update('tb_conta', $update);
    }
    
    function buscarLancesPorIdLeilao($idLeilao) {

        $query = $this->db->query("select l.*, c.nome 
               FROM tb_lance l join tb_conta c on l.idConta = c.idConta
               where idLeilao = $idLeilao order by idLance desc");

        
         return $query->result();
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

    function buscarUltimoLance($idLeilao) {

        $query = $this->db->query("SELECT idLance AS idLance, valor, login, tempoCronometro
                                    FROM tb_lance l
                                    JOIN tb_conta c ON l.idConta = c.idConta
                                    JOIN tb_leilao le ON l.idLeilao = le.idLeilao
                                    WHERE l.idLeilao = $idLeilao
                                    ORDER BY idLance DESC 
                                    LIMIT 0 , 1  ");

        return $query->result();
    }
    
    function buscarListaLancePorIdLeilao($id) {

        $query = $this->db->query("select data, valor, login
               FROM tb_lance l 
               join tb_conta c on c.idConta = l.idConta
               where l.idLeilao = $id order by idLance desc ");
        return $query->result();
    }

}

?>
