<?php

class ItemPedido_model extends CI_Model {

    function salvarItemPedido($options = array()) {
        $this->db->insert('tb_itempedido', $options);
        return $this->db->insert_id();
    }
    
    function atualizarItemPedido($options = array(), $id) {
        $this->db->where('idItemPedido', $id);
        $this->db->update('tb_itempedido', $options);
        return $this->db->insert_id();
    }
    
    function excluirItemPedido($options = array()){
        $this->db->delete('tb_itempedido', $options);
    }
    
    function buscarItemPedidoPorIdPedido($idPedido) {
        $query = $this->db->query("SELECT ip.idProduto, ip.idItemPedido FROM tb_itempedido ip
                                   WHERE ip.idPedido = $idPedido ");
        return $query->result();
    }
}
?>
