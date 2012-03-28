<?php

class Lance_model extends CI_Model {

    function salvarLance($data = array()) {
        $this->db->insert('tb_lance', $data);
        return $this->db->insert_id();
    }
    
    function atualizaSaldoConta($idConta, $valor) {
        $this->db->set('saldo', 'saldo - '.$valor, FALSE);
        $this->db->where('idConta',$idConta);
        $this->db->update('tb_conta', $update);
    }
    
    function buscarLancesPorIdLeilao($idLeilao) {

        $query = $this->db->query("SELECT l.*, c.nome 
               FROM tb_lance l join tb_conta c on l.idConta = c.idConta
               where idLeilao = $idLeilao order by idLance desc");

        
         return $query->result();
    }

    function buscarValorUltimoLance($idLeilao) {

        $query = $this->db->query("SELECT ifnull(max(valor),0) as valor
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

        $query = $this->db->query("SELECT data, valor, login
               FROM tb_lance l 
               join tb_conta c on c.idConta = l.idConta
               where l.idLeilao = $id order by idLance desc ");
        return $query->result();
    }
    
    function buscarHistoricoLances($id){
        
        $query = $this->db->query("SELECT COUNT( * ) qtde, p.nome produto, le.dataFim
                FROM  tb_lance l
                INNER JOIN tb_leilao le ON le.idLeilao = l.idLeilao
                INNER JOIN tb_itemleilao il ON il.idLeilao = l.idLeilao
                INNER JOIN tb_produto p ON p.idProduto = il.idProduto
                WHERE l.idConta = $id 
                GROUP BY p.nome, le.dataFim ");
        return $query->result();
    }

}

?>
