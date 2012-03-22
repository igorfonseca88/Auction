<?php

class Pedido_model extends CI_Model {

    const STATUS_EM_ANDAMENTO = "Em Andamento";
    
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
                                   where p.idConta = $idConta 
                                   and p.status = '$statusPedido' ");
        return $query->result();
    }
    
    function buscarProdutosGaleriaPorIdPedido($idPedido) {
        $query = $this->db->query("SELECT p.nome, g.caminho, p.preco, p.idProduto, ip.quantidade, ip.idItemPedido, (p.preco * ip.quantidade) as subTotal
                                   FROM TB_PRODUTO p JOIN TB_GALERIA g ON (p.idProduto = g.idProduto) 
                                   JOIN TB_ITEMPEDIDO ip ON (ip.idProduto = p.idProduto)
                                   JOIN TB_PEDIDO pe ON (pe.idPedido = ip.idPedido)
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
}
?>
