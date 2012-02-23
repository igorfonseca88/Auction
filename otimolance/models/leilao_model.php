<?php

class Leilao_model extends CI_Model {
    
    public $situacao;
    public $idCategoriaLeilao;

    function salvar($data = array()) {
        $this->db->insert('tb_leilao', $data);
        return $this->db->insert_id();
    }

    function alterar($data = array(), $id) {
        $this->db->where('idLeilao', $id);
        $this->db->update('tb_leilao', $data);
        return $this->db->affected_rows();
    }

    /*
     * Método para salvar o item do leilão
     */

    function salvarItemLeilao($data = array(), $idItemLeilao = 0) {

        if ($idItemLeilao == 0) {
            $this->db->insert('tb_itemLeilao', $data);
            return $this->db->insert_id();
        } else {
            $this->db->where('idItemLeilao', $idItemLeilao);
            $this->db->update('tb_itemLeilao', $data);
            return $this->db->affected_rows();
        }
    }

    function getAll() {
        
        $where = "";
        if($this->situacao == "Em andamento"){
            $where = " WHERE l.dataFim is null ";
        }
        else if($this->situacao == "Finalizado"){
            $where =  " WHERE l.dataFim is not null ";
        }
        
        if($this->idCategoriaLeilao != ""){
            $where != "" ? $where .= " AND " : $where = " WHERE ";
            $where.= " l.idCategoriaLeilao = " . $this->idCategoriaLeilao;
        }
        
        $sql = "select l.idLeilao, dataCriacao, dataInicio, dataFim, 
            tempoCronometro, valorLeilao, idConta, l.idCategoriaLeilao, il.valorProduto, p.nome
                   from tb_leilao l 
                   left join tb_itemleilao il on l.idLeilao = il.idLeilao
                   join tb_categorialeilao cl on l.idCategoriaLeilao = cl.idCategoriaLeilao
                   left join tb_produto p on il.idProduto = p.idProduto $where ";
        
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function buscarValorLeilao($idLeilao) {

        $query = $this->db->query("select ifnull(max(valorLeilao),0) as valor
               FROM tb_leilao
               where idLeilao = $idLeilao ");
        
        $valor = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $valor = $row->valor;
            }
        }
        return $valor;
    }
    
    function buscarData($idLeilao) {

        $query = $this->db->query("select dataInicio 
               FROM tb_leilao
               where idLeilao = $idLeilao ");
        
        $valor = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $valor = $row->dataInicio;
            }
        }
        return $valor;
    }
    
    function buscarDadosLeilao($id) {

        $query = $this->db->query("select l.idLeilao, dataCriacao, dataInicio, dataFim, 
               tempoCronometro, valorLeilao, idConta, idCategoriaLeilao, 
               il.valorProduto, il.valorFrete, il.valorArremate, il.idItemLeilao, il.idProduto, l.publicado, l.freteGratis,
               (select ifnull(max(valor),0) 
               FROM tb_lance
               where idLeilao = $id) as valor,
               
                (SELECT login
                                    FROM tb_lance l
                                    JOIN tb_conta c ON l.idConta = c.idConta
                                    WHERE l.idLeilao = $id
                                    ORDER BY idLance DESC 
                                    LIMIT 0 , 1 ) as login,
                
                (SELECT ifnull(max(data),0)
                                    FROM tb_lance
               where idLeilao = $id) as dataUltLance 
                
               FROM tb_leilao l 
               JOIN tb_itemleilao il on l.idLeilao = il.idLeilao 
               where l.idLeilao = $id ");
        return $query->result();
    }

    function buscarLeilaoPorId($id) {

        $query = $this->db->query("select l.idLeilao, dataCriacao, dataInicio, dataFim, 
               tempoCronometro, valorLeilao, idConta, idCategoriaLeilao, 
               il.valorProduto, il.valorFrete, il.valorArremate, il.idItemLeilao, il.idProduto, l.publicado, l.freteGratis
               FROM tb_leilao l 
               left join tb_itemleilao il on l.idLeilao = il.idLeilao 
               where l.idLeilao = $id ");
        return $query->result();
    }

    /* site */
    
    function listarLeiloesPublicados() {
        
        $sql = "select l.idLeilao, dataCriacao, dataInicio, dataFim, 
            tempoCronometro, valorLeilao, idConta, l.idCategoriaLeilao, il.valorProduto, p.nome
                   from tb_leilao l 
                   left join tb_itemleilao il on l.idLeilao = il.idLeilao
                   join tb_categorialeilao cl on l.idCategoriaLeilao = cl.idCategoriaLeilao
                   left join tb_produto p on il.idProduto = p.idProduto where l.publicado = 1 ";
        
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }

}

?>
