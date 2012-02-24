<?php

class Produto_model extends CI_Model {

    function getAll() {
        $query = $this->db->query("select idProduto, p.nome, descricao, p.idCategoria, preco, c.nome as categoria 
            from tb_produto p join tb_categoria c on p.idCategoria = c.idCategoria ");
        return $query->result();
    }

    function add_record($options = array()) {
        $this->db->insert('tb_produto', $options);
        return $this->db->insert_id();
    }
    
    function update_record($options = array(), $id) {
        
        $this->db->where('idProduto', $id);
        $this->db->update('tb_produto', $options);
        return $this->db->insert_id();
    }
    
    function buscarPorId($id) {
        $this->db->where('idProduto', $id);
        $query = $this->db->get("tb_produto");
        return $query->result();
    }
}
?>
