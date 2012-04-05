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
    
    function leilaoProntoParaPublicar($id) {
        $query = $this->db->query("select l.idLeilao
               FROM tb_leilao l join tb_itemleilao il on il.idLeilao = l.idLeilao
               where l.idLeilao = $id ");
        
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
    
    function leilaoAtivo($id) {
        $query = $this->db->query("select l.idLeilao
               FROM tb_leilao l
               where l.idLeilao = $id  and l.dataFim is null ");
        
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /*
     * Método para salvar o item do leilão
     */

    function salvarItemLeilao($data = array(), $idItemLeilao = 0) {

        if ($idItemLeilao == 0) {
            $this->db->insert('tb_itemleilao', $data);
            return $this->db->insert_id();
        } else {
            $this->db->where('idItemLeilao', $idItemLeilao);
            $this->db->update('tb_itemleilao', $data);
            return $this->db->affected_rows();
        }
    }

    function getAll() {
        
        $where = "";
        if($this->situacao == "Em andamento"){
            $where = " WHERE l.dataFim is null ";
        }
        else if($this->situacao == "Arrematado"){
            $where =  " WHERE l.dataFim is not null ";
        }
        
        if($this->idCategoriaLeilao != ""){
            $where != "" ? $where .= " AND " : $where = " WHERE ";
            $where.= " l.idCategoriaLeilao = " . $this->idCategoriaLeilao;
        }
        
        $sql = "select l.idLeilao, dataCriacao, dataInicio, dataFim, 
            tempoCronometro, valorLeilao, idConta, l.idCategoriaLeilao, il.valorProduto, p.nome, 
            (select caminho from tb_galeria where idProduto = il.idProduto and isPrincipal = 1) as caminho,
            (select ifnull(count(idLance),0) from tb_lance where idLeilao = l.idLeilao) as qtdeLances,
             (select ifnull(max(valor),0) 
               FROM tb_lance
               where idLeilao = l.idLeilao) as valorArremate,
        (SELECT login
                                    FROM tb_lance la
                                    JOIN tb_conta c ON la.idConta = c.idConta
                                    WHERE la.idLeilao = l.idLeilao
                                    ORDER BY idLance DESC 
                                    LIMIT 0 , 1 ) as login
                   from tb_leilao l 
                   left join tb_itemleilao il on l.idLeilao = il.idLeilao
                   join tb_categorialeilao cl on l.idCategoriaLeilao = cl.idCategoriaLeilao
                   left join tb_produto p on il.idProduto = p.idProduto $where order by l.idLeilao desc ";
        
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
    
    function buscarDadosLeilao($ids) {

        $query = $this->db->query("select l.idLeilao, dataCriacao, dataInicio, dataFim, 
               tempoCronometro, valorLeilao, idConta, idCategoriaLeilao, 
               il.valorProduto, il.valorFrete, l.valorArremate, il.idItemLeilao, il.idProduto, l.publicado, l.freteGratis,
               (select ifnull(max(valor),0) 
               FROM tb_lance
               where idLeilao = l.idLeilao) as valor,
               
                (SELECT login
                                    FROM tb_lance la
                                    JOIN tb_conta c ON la.idConta = c.idConta
                                    WHERE la.idLeilao = l.idLeilao
                                    ORDER BY idLance DESC 
                                    LIMIT 0 , 1 ) as login,
                (SELECT la.idConta
                                    FROM tb_lance la
                                    JOIN tb_conta c ON la.idConta = c.idConta
                                    WHERE la.idLeilao = l.idLeilao
                                    ORDER BY idLance DESC 
                                    LIMIT 0 , 1 ) as idContaArremate,
                
                (SELECT ifnull(max(data),0)
                                    FROM tb_lance
               where idLeilao = l.idLeilao) as dataUltLance, l.idContaArremate as vencedor
                
               FROM tb_leilao l 
               JOIN tb_itemleilao il on l.idLeilao = il.idLeilao 
               where l.idLeilao in ($ids) ");
        return $query->result();
    }

    function buscarLeilaoPorId($id) {

        $query = $this->db->query("select l.idLeilao, dataCriacao, dataInicio, dataFim, 
               tempoCronometro, valorLeilao, idConta, idCategoriaLeilao, 
               il.valorProduto, il.valorFrete, l.valorArremate, il.idItemLeilao, il.idProduto, l.publicado, l.freteGratis,
                (select caminho from tb_galeria where idProduto = il.idProduto and isPrincipal = 1) as caminho, p.nome 
               FROM tb_leilao l 
               left join tb_itemleilao il on l.idLeilao = il.idLeilao 
                left join tb_produto p on il.idProduto = p.idProduto 
               where l.idLeilao = $id ");
        return $query->result();
    }
    
    /* site */
    
    function listarLeiloesPublicados() {
        
        $sql = "select l.idLeilao, dataCriacao, dataInicio, dataFim, 
            tempoCronometro, valorLeilao, idConta, l.idCategoriaLeilao, il.valorProduto, p.nome, 
            (select caminho from tb_galeria where idProduto = il.idProduto and isPrincipal = 1) as caminho 
                   from tb_leilao l 
                   left join tb_itemleilao il on l.idLeilao = il.idLeilao
                   join tb_categorialeilao cl on l.idCategoriaLeilao = cl.idCategoriaLeilao
                   left join tb_produto p on il.idProduto = p.idProduto 
                   where  l.publicado = 1 and l.dataFim is null ";
        
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function listarLeiloesPublicadosEArrematados() {
        
        $sql = "select l.idLeilao, dataCriacao, dataInicio, dataFim, 
            tempoCronometro, valorLeilao, idConta, l.idCategoriaLeilao, il.valorProduto, p.nome, 
            (select caminho from tb_galeria where idProduto = il.idProduto and isPrincipal = 1) as caminho,
            (select ifnull(count(idLance),0) from tb_lance where idLeilao = l.idLeilao and idConta = l.idContaArremate) as qtdeLances,
             (select ifnull(max(valor),0) 
               FROM tb_lance
               where idLeilao = l.idLeilao) as valorArremate,
        (SELECT login
                                    FROM tb_lance la
                                    JOIN tb_conta c ON la.idConta = c.idConta
                                    WHERE la.idLeilao = l.idLeilao
                                    ORDER BY idLance DESC 
                                    LIMIT 0 , 1 ) as login
                   from tb_leilao l 
                   left join tb_itemleilao il on l.idLeilao = il.idLeilao
                   join tb_categorialeilao cl on l.idCategoriaLeilao = cl.idCategoriaLeilao
                   left join tb_produto p on il.idProduto = p.idProduto 
                   where  l.publicado = 1 and l.valorArremate > 0 and l.dataFim is not null order by l.idLeilao desc ";
        
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function buscarLeiloesArrematadosPorIdConta($idConta){
        $sql = "select l.idLeilao, l.dataCriacao, dataInicio, dataFim, 
            tempoCronometro, valorLeilao, l.idConta, l.idCategoriaLeilao, il.valorProduto, p.nome, 
            (select caminho from tb_galeria where idProduto = il.idProduto and isPrincipal = 1) as caminho,
            (select ifnull(count(idLance),0) from tb_lance where idLeilao = l.idLeilao) as qtdeLances,
             (select ifnull(max(valor),0) 
               FROM tb_lance
               where idLeilao = l.idLeilao ) as valorArremate, status, ped.dataCriacao as dataPedido, ifnull(il.valorFrete,0) as frete, ped.idPedido
                   from tb_leilao l 
                   join tb_itemleilao il on l.idLeilao = il.idLeilao
                   join tb_categorialeilao cl on l.idCategoriaLeilao = cl.idCategoriaLeilao
                   join tb_produto p on il.idProduto = p.idProduto 
                   join tb_pedido ped on ped.idLeilao = l.idLeilao
                   where  l.publicado = 1 and l.valorArremate > 0 and l.dataFim is not null and l.idContaArremate = $idConta order by l.idLeilao desc ";
        
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }

}

?>
