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
    
    function buscarProdutosPorNomeCategoria($nomeCategoria) {
        $query = $this->db->query("SELECT p.nome, g.caminho, p.preco, p.idProduto FROM TB_PRODUTO p JOIN TB_GALERIA g 
                                   ON (p.idProduto = g.idProduto) JOIN TB_CATEGORIA c ON (p.idCategoria = c.idCategoria)
                                   WHERE c.nome LIKE '$nomeCategoria'
                                   AND g.tipoGaleria = 'imagem' 
                                   AND g.isPrincipal = 1 ");
        return $query->result();
    }
}
?>
