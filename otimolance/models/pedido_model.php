<?php

class Pedido_model extends CI_Model {

    const STATUS_EM_ANDAMENTO = "Em Andamento";
    const STATUS_AGUARD_PAGTO = "Aguardando Pagamento";
    
    function salvar($options = array()) {
        $this->db->insert('tb_pedido', $options);
        return $this->db->insert_id();
    }
    
    function atualizar($options = array(), $id) {
        
        $this->db->where('idPedido', $id);
        $this->db->update('tb_pedido', $options);
        return $this->db->insert_id();
    }
    
    function buscarPorId($id) {
        $this->db->where('idPedido', $id);
        $query = $this->db->get("tb_pedido");
        return $query->result();
    }
    
    function buscarPedidoPorIdContaEStatusPedido($idConta, $statusPedido) {
        $query = $this->db->query("select p.idPedido from tb_pedido p 
                                   where p.idConta = $idConta and p.idLeilao is null
                                   and p.status = '$statusPedido' ");
        return $query->result();
    }
    
    function buscarProdutosGaleriaPorIdPedido($idPedido) {
        $query = $this->db->query("SELECT p.nome, g.caminho, p.preco, p.idProduto, ip.quantidade, ip.idItemPedido, (p.preco * ip.quantidade) as subTotal
                                   FROM tb_produto p JOIN tb_galeria g ON (p.idProduto = g.idProduto) 
                                   JOIN tb_itempedido ip ON (ip.idProduto = p.idProduto)
                                   JOIN tb_pedido pe ON (pe.idPedido = ip.idPedido)
                                   WHERE pe.idPedido = $idPedido
                                   AND g.tipoGaleria = 'imagem' 
                                   AND g.isPrincipal = 1 ");
        return $query->result();
    }
    
    function buscarPedidoPorIdContaEStatusPedidoEIdLeilao($idConta, $statusPedido, $idLeilao) {
        $query = $this->db->query("select p.idPedido from tb_pedido p 
                                   where p.idConta = $idConta 
                                   and p.status = '$statusPedido' and p.idLeilao = $idLeilao ");
        return $query->result();
    }
    
    function buscarPedidoPorStatusPedido($statusPedido) {
        $query = $this->db->query("SELECT p.nome, p.preco, p.idProduto, ip.quantidade, ip.idItemPedido, pe.idPedido, pe.status, 
                                    CASE WHEN lei.valorArremate IS NOT NULL 
                                    THEN lei.valorArremate
                                    ELSE SUM( p.preco * ip.quantidade ) 
                                    END AS valor, sum(ifnull(ilei.valorFrete,0)) as frete
                                    FROM tb_produto p
                                    JOIN tb_itempedido ip ON ( ip.idProduto = p.idProduto ) 
                                    JOIN tb_pedido pe ON ( pe.idPedido = ip.idPedido ) 
                                    LEFT JOIN tb_leilao lei ON pe.idLeilao = lei.idLeilao
                                    LEFT JOIN tb_itemleilao ilei ON ilei.idLeilao = lei.idLeilao
                                    WHERE pe.status =  '$statusPedido'
                                    GROUP BY pe.idPedido ORDER BY pe.idPedido desc ");
        return $query->result();
    }
    
    function buscarPedidoPorId($id) {
        $query = $this->db->query("SELECT pe.idPedido, pe.status,  c.nome as cliente, pe.dataCriacao
                                    FROM tb_pedido pe
                                    LEFT JOIN tb_leilao lei ON pe.idLeilao = lei.idLeilao
                                    LEFT JOIN tb_itemleilao ilei ON ilei.idLeilao = lei.idLeilao
                                    JOIN tb_conta c on c.idConta = pe.idConta
                                    WHERE pe.idPedido =  $id ");
        return $query->result();
    }
    
    function buscarItensPedidoPorIdPedido($idPedido){
        $query = $this->db->query("SELECT p.nome, p.preco, p.idProduto, ip.quantidade, ip.idItemPedido, pe.idPedido, pe.status, 
                                    c.nome as cliente, pe.dataCriacao, CASE WHEN lei.valorArremate IS NOT NULL 
                                    THEN lei.valorArremate
                                    ELSE p.preco * ip.quantidade
                                    END AS valor, ifnull(ilei.valorFrete,0) as frete
                                    FROM tb_produto p
                                    JOIN tb_itempedido ip ON ( ip.idProduto = p.idProduto ) 
                                    JOIN tb_pedido pe ON ( pe.idPedido = ip.idPedido ) 
                                    LEFT JOIN tb_leilao lei ON pe.idLeilao = lei.idLeilao
                                    LEFT JOIN tb_itemleilao ilei ON ilei.idLeilao = lei.idLeilao
                                    JOIN tb_conta c on c.idConta = pe.idConta
                                    WHERE pe.idPedido =  $idPedido ");
        return $query->result();
    }
}
?>
