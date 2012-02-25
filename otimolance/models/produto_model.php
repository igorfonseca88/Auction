<?php

class Produto_model extends CI_Model {

    function getAll() {
        $query = $this->db->query("select idProduto, p.nome, descricao, p.idCategoria, preco, c.nome as categoria 
            from tb_produto p join tb_categoria c on p.idCategoria = c.idCategoria ");
        return $query->result();
    }

    function add($options = array()) {
        $this->db->insert('tb_produto', $options);
        return $this->db->insert_id();
    }
    
    function update($options = array(), $id) {
        
        $this->db->where('idProduto', $id);
        $this->db->update('tb_produto', $options);
        return $this->db->insert_id();
    }
    
    function excluirProduto($options = array()){
        $this->db->delete('tb_produto', $options);
    }
    
    function buscarPorId($id) {
        $this->db->where('idProduto', $id);
        $query = $this->db->get("tb_produto");
        return $query->result();
    }
}
?>
