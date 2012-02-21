<?php

class Galeria_model extends CI_Model {
    
    function getAll() {
        $query = $this->db->query("select * from tb_galeria ");
        return $query->result();
    }
    
    function buscarGaleriaPorIdConteudo($id){
        $query = $this->db->query("select * from tb_galeria 
                                    where idConteudo = ".$id." and tipoGaleria = 'imagem'
                                    order by idGaleria desc ");
        return $query->result();
    }
    
    function buscarGaleriaPorIdConteudoETipoVideo($id){
        $query = $this->db->query("select * from tb_galeria 
                                    where idConteudo = ".$id." and tipoGaleria = 'video'
                                    order by idGaleria desc ");
        return $query->result();
    }
    
    function buscarGaleriaPorIdArtigo($id){
        $query = $this->db->query("select * from tb_galeria 
                                    where idMateria = ".$id."
                                    order by idGaleria desc ");
        return $query->result();
    }
    
    // adiciona um anuncio
    function add_record($options = array()) {
        $this->db->insert('tb_galeria', $options);
        return $this->db->insert_id();
    }
    
    function delete($options = array()){
        $this->db->delete('tb_galeria', $options);
    }
    
    function buscarGaleriaPorId($id){
        $this->db->where('idGaleria', $id);
        $query = $this->db->get("tb_galeria");
        return $query->result();
    }
    
}
?>
